<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $response = [];
        foreach ($user->Messages() as $Message) {
            array_push($response,array(
                'id' => $Message->id,
                'receiver_id' => $Message->receiver_id,
                'sender_id'=>$Message->sender_id,
                'body'=>$Message->body,
                'receiver'=>$Message->receiver,
                'sender'=>$Message->sender
            ));
        }
        return response()->json($response);
    }

    public function getMessageDetails(request $request)
    {
        $request->validate(['id' => 'Numeric|required']);
        $Message = Message::find($request->id);
        if ($Message) {
            return response()->json(array(
                'senderId'=>$Message->sender->id,
                'senderName' => $Message->sender->name,
                'receiverName' => $Message->receiver->name,
                'sender' => $Message->sender,
                'receiver' => $Message->receiver,
                'body' => $Message->body,
                'date' => $Message->created_at,
            ));
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['receiver_id' => 'required', 'body' => 'required']);
        $user = Auth::user();
        $msg = $user->sendedMessages()->create(['receiver_id' => $request->receiver_id, 'body' => $request->body]);
        return response()->json($msg);
    }

    public function getDisscussion(Request $request){
        $request->validate(['withUserId'=>'required']);
        $user = Auth::user();
        return response()->json($user->discussion($request->withUserId));
    }
}
