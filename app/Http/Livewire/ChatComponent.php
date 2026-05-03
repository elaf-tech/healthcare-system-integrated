<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Auth;

class ChatComponent extends Component
{
    public $message = '';
    public $messages = [];
    public $receiver;
    public $sender;
    public $channel;

    protected $listeners = ['messageReceived' => 'refreshMessages'];

    public function mount($receiverId)
    {
        $this->sender = Auth::user();
        $this->receiver = User::findOrFail($receiverId);
        $this->channel = $this->getChannelName();
        $this->loadMessages();
    }

    public function getChannelName()
    {
        $ids = [$this->sender->id, $this->receiver->id];
        sort($ids);
        return 'chat.'.implode('.', $ids);
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function($query) {
            $query->where('sender_id', $this->sender->id)
                  ->where('receiver_id', $this->receiver->id);
        })->orWhere(function($query) {
            $query->where('sender_id', $this->receiver->id)
                  ->where('receiver_id', $this->sender->id);
        })->orderBy('created_at', 'asc')->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string|max:1000',
        ]);

        $newMessage = Message::create([
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
            'message' => $this->message,
        ]);

        $this->message = '';
        $this->loadMessages();
        
        broadcast(new \App\Events\NewMessage($newMessage))->toOthers();
    }

    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}