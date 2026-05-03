<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;

class ClinicChat extends Component
{
    public $messages = [];
    public $newMessage;
    public $file;
    public $doctorId;

    public function mount($doctorId)
    {
        $this->doctorId = $doctorId;
        $this->messages = Message::where('doctor_id', $doctorId)->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);
        
        if ($this->file) {
            $path = $this->file->store('uploads', 'public');
            Message::create([
                'file_path' => $path,
                'doctor_id' => $this->doctorId,
                'user_id' => auth()->id(),
                'content' => null
            ]);
        } else {
            Message::create([
                'content' => $this->newMessage,
                'doctor_id' => $this->doctorId,
                'user_id' => auth()->id(),
                'file_path' => null
            ]);
        }

        $this->newMessage = '';
        $this->file = null;
        $this->messages = Message::where('doctor_id', $this->doctorId)->get();
    }

    public function render()
    {
        return view('livewire.clinic-chat');
    }
}