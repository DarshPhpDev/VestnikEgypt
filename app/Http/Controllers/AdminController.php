<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Post;
use App\Comment;
use App\Message;
use App\Mail\SendMail;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
    	$users_count = User::count();
    	$news_count = Post::count();
    	$urgent_news_count = Post::where('urgent',1)->count();
        $comments_count = Comment::count();
    	$messages_count = Message::count();
        return view('admin.home',compact('users_count', 'news_count', 'urgent_news_count', 'comments_count','messages_count'));
    }
    public function inbox(Request $request){
        $messages = \App\Message::orderBy('id','DESC')->get();
        return view('admin.inbox.index',compact('messages'));
    }

    public function show($id){
        $message = \App\Message::find($id);
        $message->update(['seen' => 1]);
        return view('admin.inbox.show',compact('message'));
    }

    public function replyMessage(Request $request,$id){
        if($request->isMethod('post')){
            $msg = \App\Message::find($id);
            $reply = $request->reply;
            try{
                \Mail::to($msg->email)->send(new SendMail($msg));
            }catch(\Exception $e){
                return $e->getMessage();
            }
            return redirect(route('messages.inbox'))->with('success','Reply Sent to email Successfully');
        }else{
            $msg = \App\Message::find($id);
            return view('admin.inbox.message_reply',compact('msg'));
        }

    }

    public function destroy($id){
        \App\Message::find($id)->delete();
        return redirect(route('messages.inbox'));
    }
}
