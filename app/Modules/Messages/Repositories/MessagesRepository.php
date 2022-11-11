<?php


namespace Messages\Repositories;

use App\ModuleChat;
use App\ModuleChatMessage;
use File;
use Messages\Models\Chat;
use Messages\Models\Messages;
use Illuminate\Support\Facades\Validator;

class MessagesRepository implements MessagesRepositoryInterface
{
    public function allData(){
        return Chat::all();
    }

    public function myChats(){
        $my_chats = Chat::select('id')->where('send',auth()->user()->id)->orWhere('receive',auth()->user()->id)->get()->toArray();
        $people_chat_with_me = Messages::whereIn('chat_id',$my_chats)->get();
        return $people_chat_with_me;

    }

    public function getDataId($id){
        return Chat::findOrfail($id);
    }

    public function getChatMessages($chatId)
    {
        return Messages::where('chat_id',$chatId)->get();
    }

    public function deleteData($id)
    {
        Chat::findOrfail($id)->delete();
    }

    public function sendMessage($request,$chatId)
    {
        $user = auth()->user();
        $chat = Chat::where('id',$chatId)->first();
        $message = new Messages();

        $message->receive = $chat->receive->id;
        $message->send = $user->id;
        $message->message = $request->message;
        $message->chat_id = $chat->id;

        $pathImage = public_path().'/uploads/backend/chats/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            $request->image->move($pathImage, $imageName);
            $message->image = $imageName;
        }

        $message->save();
    }
}
