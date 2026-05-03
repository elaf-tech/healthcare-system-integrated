<div class="chat-container">
    <div class="chat-header">
        <h4>الدردشة مع {{ $receiver->name }}</h4>
    </div>
    
    <div class="chat-messages" id="chat-messages">
        @foreach($messages as $message)
            <div class="message @if($message->sender_id == $sender->id) sent @else received @endif">
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
    
    <div class="chat-input">
        <form wire:submit.prevent="sendMessage">
            <input type="text" wire:model="message" placeholder="اكتب رسالتك هنا..." autocomplete="off">
            <button type="submit">إرسال</button>
        </form>
    </div>
</div>