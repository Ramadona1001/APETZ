<?php

namespace Messages\Controllers;

use App\Http\Controllers\Controller;
use Messages\Repositories\MessagesRepository;
use Messages\Requests\MessagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    public $path;
    private $messagesRepository;

    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->middleware('auth');
        $this->path = 'Messages::';
        $this->messagesRepository = $messagesRepository;
    }

    public function index()
    {
        hasPermissions('show_chats');
        $title = transWord('Chats');
        $pages = [
            [transWord('Chats'),'chats']
        ];
        $chats = $this->messagesRepository->allData();
        return view($this->path.'index',compact('chats','pages','title'));
    }

    public function myChats()
    {
        hasPermissions('my_chats');
        $title = transWord('My Chats');
        $pages = [
            [transWord('My Chats'),'my_chats']
        ];
        $chats = $this->messagesRepository->myChats();
        return view($this->path.'my-chats',compact('chats','pages','title'));
    }

    public function openMyChat($chat_id)
    {
        hasPermissions('my_chats');
        $chat = $this->messagesRepository->getDataId($chat_id);
        $title = transWord('My Chats');
        $pages = [
            [$title,'my_chats']
        ];
        $chats = $this->messagesRepository->myChats();
        $messages = $this->messagesRepository->getChatMessages($chat->id);
        return view($this->path.'open-my-chat',compact('chat','pages','title','messages','chats'));
    }

    public function show($id)
    {
        hasPermissions('show_chats');
        $id = Crypt::decrypt($id);
        $chat = $this->messagesRepository->getDataId($id);
        $messages = $this->messagesRepository->getChatMessages($chat->id);

        $title = transWord('Show Chat Details');
        $pages = [
            [transWord('Chat'),'chats'],
        ];
        return view($this->path.'.show',compact('chat','title','pages','messages',));
    }

    public function destroy($id){
        hasPermissions('delete_chats');
        $id = Crypt::decrypt($id);
        $this->messagesRepository->deleteData($id);
        return back()->with('success','');
    }

    public function sendMessage(Request $request,$chat)
    {
        if ($request->image != null || $request->message != null) {
            $this->messagesRepository->sendMessage($request,$chat);
        }else{
            return back()->with('failedprocess','You Should Write Message OR Upload Image');
        }
        return back()->with('success','');
    }
}
