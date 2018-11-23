<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Message;
use Auth;
use App;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = \App\Category::all();
        return view('create',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'category_id' => 'required',
            'main_image' => 'required|mimes:jpeg,gif,png',
        ]);
        if($validatedData){
            $requestData = $request->all();
            $slider = 0;
            $urgent = 0;
            if(isset($requestData['slider'])){
                $slider = 1;
            }
            if(isset($requestData['urgent'])){
                $urgent = 1;
            }
            
            $post = Post::create(['slider'=>$slider, 'urgent'=> $urgent, 'user_id'=>Auth::id(), 'category_id'=>$requestData['category_id'], 'author_name' => $requestData['author'] ?? null,'author_gender' => $requestData['author_gender']??null]);

            //add media
            try{
                $file = $request->main_image;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                if(Storage::disk('media')->put($filename, file_get_contents($file))){
                    $pathToFile = Storage::disk('media')->url($filename);
                    $post->addMedia(base_path().'/'.$pathToFile)->toMediaCollection('images');
                }
            }catch(\Exception $e){
                //
            }
           
            //translations
            if($requestData['subject_ar']!=null){
                $post->translateOrNew('ar')->title = $requestData['subject_ar'];
                $post->translateOrNew('ar')->body = $requestData['body_ar'];
                $post->save();
            }
            if($requestData['subject_ru']!=null){
                $post->translateOrNew('ru')->title = $requestData['subject_ru'];
                $post->translateOrNew('ru')->body = $requestData['body_ru'];
                $post->save();
            }
            
            return redirect()->back()->with('message-success', 'تم اضافة الخبر بنجاح');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $locale = App::getLocale();
if($post->translateOrNew($locale) == null)
	return redirect()->to(route('homepage'));
        
        $seens = (int) $post->seen;
        $seens++;
        $post->update(['seen'=>$seens]);
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats = \App\Category::all();
        $post = Post::find($id);
        return view('edit',compact('post','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $post = Post::findOrFail($id);
        
        $validatedData = $request->validate([
            'category_id' => 'required',
            'main_image' => 'required|mimes:jpeg,gif,png',
        ]);
        if($validatedData){
            $requestData = $request->all();
            $slider = 0;
            $urgent = 0;
            if(isset($requestData['slider'])){
                $slider = 1;
            }
            if(isset($requestData['urgent'])){
                $urgent = 1;
            }
            $post->update(['slider'=>$slider, 'urgent'=> $urgent, 'user_id'=>Auth::id(), 'category_id'=>$requestData['category_id'], 'author_name' => $requestData['author'] ?? null,'author_gender' => $requestData['author_gender']??null]);

            //add media
            try{
                $file = $request->main_image;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                if(Storage::disk('media')->put($filename, file_get_contents($file))){
                    $pathToFile = Storage::disk('media')->url($filename);
                    $post->addMedia(base_path().'/'.$pathToFile)->toMediaCollection('images');
                }
            }catch(\Exception $e){
                //
            }

            //translations
            if($requestData['subject_ar']!=null){
                $post->translateOrNew('ar')->title = $requestData['subject_ar'];
                $post->translateOrNew('ar')->body = $requestData['body_ar'];
                $post->save();
            }
            if($requestData['subject_ru']!=null){
                $post->translateOrNew('ru')->title = $requestData['subject_ru'];
                $post->translateOrNew('ru')->body = $requestData['body_ru'];
                $post->save();
            }
            return redirect()->back()->with('message-success', 'تم تعديل الخبر بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Post::findOrFail($id)->delete();
            return redirect(route('homepage'))->with('message-success', 'تم مسح الخبر');
        }catch(\Exception $e){
            //
        }
    }

    public function comment(Request $request, $post_id){
        $checkPost = Post::find($post_id);
        if($checkPost != null){
            $requestData = $request->all();
            if(Auth::user()){
                Comment::create(['body' => $requestData['body'], 'post_id'=>$post_id, 'user_id' => Auth::id()]);
            }else{
                Comment::create(['author'=>$requestData['author'], 'body' => $requestData['body'], 'post_id'=>$post_id]);
            }
        }
        return redirect()->back();
    }

    public function post_by_category($id){
        $locale = session()->has('locale') ? session()->get('locale') : auth()->user()['language'];
            if(empty($locale)){
              $locale = 'ar';
            }
        app()->setLocale($locale);
        
        $posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->whereHas('category',function($q) use ($id){
            $q->where('id',$id);
        })->paginate(10);
        return view('category',compact('posts'));
    }

    public function contactus(){
        return view('contactus');
    }

    public function contactus_send(Request $request){
            $requestData = $request->all();
            if(Auth::user()){
                Message::create(['body' => $requestData['body'], 'title'=>$requestData['title'], 'email'=>Auth::user()->email, 'user_id' => Auth::id(), 'seen'=>0]);
            }else{
                Message::create(['author'=>$requestData['author'], 'body' => $requestData['body'], 'title'=>$requestData['title'], 'email'=>$requestData['email'] , 'seen' => 0]);
            }
            return redirect()->back()->with('message-success',__('Thank You For Your Feedback'));
    }

    public function images(Request $request){
        if($request->isMethod('post')){
            $requestData = $request->all();
            $media = \App\Media::create($requestData);
            //add media
            try{
                $files = $request->images;

                if(is_array($files)){
                    $i = 0;
                    foreach ($files as $file) {
                        $filename = time() . $i . '.' . $file->getClientOriginalExtension();
                        if(Storage::disk('media')->put($filename, file_get_contents($file))){
                            $pathToFile = Storage::disk('media')->url($filename);
                            $media->addMedia(base_path().'/'.$pathToFile)->toMediaCollection('images');
                        }
                        $i++;
                    }
                }else{
                    $filename = time() . '.' . $files->getClientOriginalExtension();
                    if(Storage::disk('media')->put($filename, file_get_contents($files))){
                            $pathToFile = Storage::disk('media')->url($filename);
                            $media->addMedia(base_path().'/'.$pathToFile)->toMediaCollection('images');
                    }
                }
                return redirect()->back();
            }catch(\Exception $e){
                //
            }
        }else{
            $media = \App\Media::whereHas('media')->get();
            return view('images',compact('media'));
        }
    }


    public function delete_images($id){
        try{
            \Spatie\MediaLibrary\Media::destroy($id);
            return redirect()->back();   
        }catch(\Exception $e){
                //
        }
    }


    public function videos(Request $request){
        if($request->isMethod('post')){
            $requestData = $request->all();
            //add media
            try{
                $media = \App\Media::create(['title_ar' =>$requestData['title_ar'] ,'title_ru' =>$requestData['title_ar'] , 'body_ar' =>$requestData['video_url'] , 'body_ru' =>$requestData['video_url'] ,'type' => 1]);
                return redirect()->back();
        }catch(\Exception $e){
                //
        }
    }else{
            $media = \App\Media::where('type',1)->get();
            return view('videos',compact('media'));
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $posts = Post::query();
        if(!empty($keyword)){
            $posts = $posts->whereHas('translations',function($q)use($keyword){
                $q->where('title','LIKE',"%$keyword%");
                // $q->orWhere('body','LIKE',"%$keyword%");
            });
        }

        $posts = $posts->paginate(10);
        return view('search',compact('posts'));
    }

    public function commentDelete($id){
        try{
            Comment::find($id)->delete();
            return redirect()->back();
        }catch(\Exception $e){
            //
        }
    }
    
    public function about(){
        return view('about');
    }

}
