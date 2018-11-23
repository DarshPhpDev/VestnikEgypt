<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Post;
use App\Comment;
use Auth;
use App;
use Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;
    	$news = Post::query();

        if (!empty($keyword)) {
            $news = $news->whereHas('translations',function($q)use($keyword){
                $q->where('title', 'LIKE', "%$keyword%")->orWhere('body', 'LIKE', "%$keyword%");
            })
                ->paginate($perPage);
        } else {
            $news = $news->paginate($perPage);
        }
        return view('admin.news.index',compact('news'));
    }

    public function edit($id){
        $new = Post::findOrFail($id);
        $cats = \App\Category::all();
        return view('admin.news.edit',compact('new','cats'));
    }

    public function update(Request $request, $id){
        $requestData = $request->all();
        $post = Post::findOrFail($id);
        
        $validatedData = $request->validate([
            'subject_ar' => 'required',
            'subject_ru' => 'required',
            'body_ar' => 'required',
            'body_ru' => 'required',
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
            $post->update(['slider'=>$slider, 'urgent'=> $urgent, 'user_id'=>Auth::id(), 'category_id'=>$requestData['category_id']]);

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
            $post->translateOrNew('ar')->title = $requestData['subject_ar'];
            $post->translateOrNew('ar')->body = $requestData['body_ar'];
            $post->save();
            $post->translateOrNew('ru')->title = $requestData['subject_ru'];
            $post->translateOrNew('ru')->body = $requestData['body_ru'];
            $post->save();
            return redirect(route('news.index'))->with('message-success', 'تم تعديل الخبر');
        }
    }

    public function destroy(Request $request){
        Post::findOrFail($request->id)->delete();
        return "done";
    }

    public function Home(){
            $locale = session()->has('locale') ? session()->get('locale') : auth()->user()['language'];
            if(empty($locale)){
              $locale = 'ar';
            }
            app()->setLocale($locale);

            $slider_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('slider',1)->get();
            $urgent_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('urgent',1)->get();
            $recent_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->orderBy('id','DESC')->take(10)->get();
            $post_cat_2   = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('category_id',2)->orderBy('id','ASC')->first();
            $post_cat_3   = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('category_id',3)->orderBy('id','ASC')->first();
            
            $random_three_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('slider','!=',1)->inRandomOrder()->take(3)->get();
            $cat1_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('category_id',1)->get();
            $cat2_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('category_id',2)->orderBy('id','DESC')->take(4)->get();
            $cat3_posts = Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->where('category_id',3)->orderBy('id','DESC')->take(4)->get();
        
        
        return view('index',compact('slider_posts','urgent_posts','random_three_posts','cat1_posts','post_cat_2','post_cat_3','recent_posts','cat2_posts','cat3_posts'));
    }
    
    public function urgent(Request $request){
        $urgent_news = Post::query();
        $keyword = $request->get('search');
        if (!empty($keyword)) {
            $urgent_news = $urgent_news->whereHas('translations',function($q)use($keyword){
                $q->where('title', 'LIKE', "%$keyword%")->orWhere('body', 'LIKE', "%$keyword%");
            });
        }
        $urgent_news = $urgent_news->paginate(15);
        return view('admin.news.urgent',compact('urgent_news'));
    }
    
    public function change_urgent(Request $request){
        $post = Post::findOrFail($request->id);
        $done = $post->urgent == 0 ? $post->update(['urgent'=>1]) : $post->update(['urgent'=>0]);
        return 'done';
    }
}
