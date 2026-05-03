<div>
    <div class="messages">
        @foreach($messages as $message)
            <div class="message">
                @if($message->content)
                    <p>{{ $message->content }}</p>
                @endif
                @if($message->file_path)
                    <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank">Download File</a>
                @endif
            </div>
        @endforeach
    </div>

    <div class="input-area">
        <input type="text" wire:model="newMessage" placeholder="اكتب رسالتك هنا..." />
        <input type="file" wire:model="file" />
        <button wire:click="sendMessage">إرسال</button>
    </div>

    <style>
        .messages {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .message {
            margin-bottom: 10px;
        }

        .input-area {
            display: flex;
            gap: 10px;
        }
    </style>
</div>