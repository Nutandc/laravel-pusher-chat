<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Auth;
use App\Events\ChatMessage;

class ChatController extends Controller
{
    public function index(){
        return view('chat');     //   will render the chat view
    }

    public function get_users(){
        return User::all()->except(Auth::id());   // this will return all users except logged in user
    }

    public function online_users(Request $request){
        $users = User::all()->except(Auth::user()->id); 
        return  $users; // this will return all users except logged users and this function will keep getting called from the vue instance
    }

    public function get_user(){
        return Auth::user()->id;  // this function will return the user id of the current logged in user
    }

    // savemessage function would save the message in the database and would broadcast on the ChatMessage event on the private channel named chat-channel.
    public function savemessage(Request $request){
        $user = Auth::user();
        $message = Message::create([
            'to_user' => $request->to_user,
            'from_user' => $request->user,
            'message' => $request->msg
        ]);
       broadcast(new ChatMessage($user,$message))->toOthers();        
       return $request;
    }

    // get_messages function will return the messages between logged in the user and the selected user (from the list of users).
    public function get_messages(Request $request){
        $messages = Message::select('to_user','from_user','message')->where([['to_user','=',Auth::user()->id],['from_user','=',$request->to_user]])->orWhere([['from_user','=',Auth::user()->id],['to_user','=',$request->to_user]])->get();
     //   $messages = Message::select('to_user','from_user','message')->where('to_user',Auth::user()->id)->orWhere('from_user',Auth::user()->id)->get();
        return $messages;
    }
}
