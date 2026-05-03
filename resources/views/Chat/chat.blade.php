@extends('User.master')
<base href="/public">
@section('content')
<div class="whatsapp-container">
    <!-- Header -->
    <div class="chat-header">
        <a href="{{ route('chat.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="user-info">
            <img src="User/img/p.png"  loading="lazy">
          <div>
                <h4 style="color: white">{{ $receiver->name }}</h4>
                {{-- <small class="status">
                    <span class="online-dot"></span> متصل الآن
                </small> --}}
            </div>
        </div>
        <div class="header-actions">
            {{-- <i class="fas fa-phone"></i>
            <i class="fas fa-video"></i>
            <i class="fas fa-ellipsis-v"></i> --}}
        </div>
    </div>

    <!-- Messages -->
    <div class="messages-container" id="messages-container">
        @php
            $currentDate = null;
            $timezone = new DateTimeZone('Asia/Aden');
            $today = now($timezone)->format('Y-m-d');
            $yesterday = now($timezone)->subDay()->format('Y-m-d');
            $hasTodayLabel = false;
        @endphp
        
        @foreach($messages as $message)
            @php
                $messageTime = $message->created_at->setTimezone($timezone);
                $messageDate = $messageTime->format('Y-m-d');
                
                if ($messageDate == $today && !$hasTodayLabel) {
                    $dateLabel = 'اليوم';
                    $hasTodayLabel = true;
            @endphp
                    <div class="message-date" data-date="{{ $messageDate }}">
                        <span>{{ $dateLabel }}</span>
                    </div>
            @php
                } elseif ($messageDate != $today && $messageDate != $currentDate) {
                    $dateLabel = $messageDate == $yesterday ? 'أمس' : $messageTime->format('d/m/Y');
            @endphp
                    <div class="message-date" data-date="{{ $messageDate }}">
                        <span>{{ $dateLabel }}</span>
                    </div>
            @php
                    $currentDate = $messageDate;
                }
            @endphp
            

            @php
    static $unreadMarkerShown = false;
@endphp

@if(!$unreadMarkerShown && $message->is_read == 0 && $message->receiver_id == auth()->id())
    <div class="unread-marker">
        <span>رسائل غير مقروءة</span>
    </div>
    @php $unreadMarkerShown = true; @endphp
@endif

            <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                @if($message->file_path)
                    <div class="file-message">
                        @if(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('storage/' . $message->file_path) }}" alt="ملف مرفق">
                        @else
                            <a href="{{ route('chat.download', $message->id) }}" class="file-download">
                                <i class="fas fa-file-download"></i> تحميل الملف
                            </a>
                        @endif
                    </div>
                @endif
                <div class="message-content">
                    <p>{{ $message->message }}</p>
                    <div class="message-meta">
                        <span>{{ $messageTime->format('h:i A') }}</span>
                        @if($message->sender_id == auth()->id())
                            <span class="read-status">
                                {{-- @if($message->read_at)
                                    <i class="fas fa-check-double" style="color: #4fc3f7"></i>
                                @else
                                    <i class="fas fa-check"></i>
                                @endif --}}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input -->
    <div class="message-input">
        <form id="chat-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <div class="input-group">
                {{-- <button type="button" class="emoji-btn">
                    <i class="far fa-smile"></i>
                </button> --}}
                <input type="text" name="message" placeholder="اكتب رسالة..." autocomplete="off">
                <label for="file-upload" class="file-upload-label">
                    <i class="fas fa-paperclip"></i>
                </label>
                <input type="file" id="file-upload" name="file" style="display: none;">
                <button type="submit" class="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>

.unread-marker {
    text-align: center;
    margin: 15px 0;
}

.unread-marker span {
    background: #ff9800;
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 13px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    display: inline-block;
}

/* التصميم الجديد المعدل */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    height: 100vh;
    color: #333;
}

.whatsapp-container {
    max-width: 500px;
    margin: 0 auto;
    height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #f8f9fa;
    box-shadow: 0 0 30px rgba(0,0,0,0.3);
    position: relative;
    overflow: hidden;
}

.chat-header {
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 10;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.back-btn {
    color: white;
    font-size: 22px;
    margin-right: 10px;
    background: none;
    border: none;
    cursor: pointer;
    transition: transform 0.2s;
}

.back-btn:hover {
    transform: scale(1.1);
}

.user-info {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.user-info img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-left: 15px;
    object-fit: cover;
    border: 2px solid rgba(255,255,255,0.3);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.user-info h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.status {
    font-size: 13px;
    opacity: 0.9;
    margin-top: 3px;
    display: flex;
    align-items: center;
}

.online-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    background: #4CAF50;
    border-radius: 50%;
    margin-left: 8px;
    box-shadow: 0 0 5px #4CAF50;
}

.header-actions i {
    margin-right: 20px;
    font-size: 20px;
    cursor: pointer;
    color: white;
    transition: all 0.2s;
}

.header-actions i:hover {
    transform: scale(1.1);
    color: #4CAF50;
}

.messages-container {
    flex-grow: 1;
    padding: 20px;
    overflow-y: auto;
    background-color: #e5ddd5;
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%239C92AC' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    position: relative;
}

.message {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.message-date {
    text-align: center;
    margin: 20px 0;
    position: relative;
}

.message-date::before, .message-date::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 30%;
    height: 1px;
    background: rgba(0,0,0,0.1);
}

.message-date::before {
    left: 0;
}

.message-date::after {
    right: 0;
}

.message-date span {
    background-color: rgba(0, 0, 0, 0.1);
    color: #333;
    padding: 6px 18px;
    border-radius: 20px;
    font-size: 13px;
    display: inline-block;
    font-weight: 500;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.message-content {
    max-width: 75%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
    word-wrap: break-word;
    margin-bottom: 8px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    line-height: 1.5;
}

.sent {
    align-items: flex-end;
}

.sent .message-content {
    background-color: #dcf8c6;
    border-top-right-radius: 4px;
    margin-right: 15px;
    color: #0a3d19;
}

.received {
    align-items: flex-start;
}

.received .message-content {
    background-color: white;
    border-top-left-radius: 4px;
    margin-left: 15px;
    color: #333;
}

.message-meta {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
    display: flex;
    align-items: center;
}

.sent .message-meta {
    justify-content: flex-end;
    margin-right: 15px;
    color: #4a8a5e;
}

.received .message-meta {
    justify-content: flex-start;
    margin-left: 15px;
}

.file-message img {
    max-width: 100%;
    max-height: 250px;
    border-radius: 12px;
    margin-bottom: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.3s;
    cursor: pointer;
}

.file-message img:hover {
    transform: scale(1.02);
}

.message-input {
    background-color: #f0f0f0;
    padding: 15px;
    border-top: 1px solid #ddd;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
}

.input-group {
    display: flex;
    align-items: center;
    background-color: white;
    border-radius: 25px;
    padding: 8px 20px;
    box-shadow: 0 1px 5px rgba(0,0,0,0.1);
}

.input-group input[type="text"] {
    flex-grow: 1;
    padding: 10px 15px;
    border: none;
    background: transparent;
    outline: none;
    font-size: 15px;
    color: #333;
}

.emoji-btn, .file-upload-label, .send-btn {
    background: none;
    border: none;
    font-size: 22px;
    color: #666;
    cursor: pointer;
    margin: 0 8px;
    transition: all 0.2s;
}

.send-btn {
    color: #075e54;
    background: linear-gradient(135deg, #075e54 0%, #128C7E 100%);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.send-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 8px rgba(0,0,0,0.3);
}

.emoji-btn:hover, .file-upload-label:hover {
    color: #075e54;
    transform: scale(1.1);
}

.file-upload-label input[type="file"] {
    display: none;
}

/* شريط التمرير */
.messages-container::-webkit-scrollbar {
    width: 8px;
}

.messages-container::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 4px;
}

.messages-container::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0,0,0,0.3);
}

/* رسائل الوسائط */
.file-message {
    max-width: 280px;
    margin-bottom: 8px;
}

.file-download {
    color: #075e54;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    padding: 10px 15px;
    background: rgba(255,255,255,0.8);
    border-radius: 8px;
    transition: all 0.2s;
}

.file-download:hover {
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.file-download i {
    font-size: 18px;
}

/* تأثيرات خاصة */
.chat-header::after {
    content: "";
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(to bottom, rgba(26,42,58,0.3) 0%, transparent 100%);
    z-index: -1;
}

/* رسائل متحركة عند الإرسال */
.message.sent {
    animation: slideInRight 0.3s ease-out;
}

.message.received {
    animation: slideInLeft 0.3s ease-out;
}

@keyframes slideInRight {
    from { transform: translateX(20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideInLeft {
    from { transform: translateX(-20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* تأثيرات اللمس على الأزرار */
button, .file-upload-label {
    -webkit-tap-highlight-color: transparent;
}

/* تحسينات للهواتف */
@media (max-width: 500px) {
    .whatsapp-container {
        max-width: 100%;
        border-radius: 0;
    }
    
    .chat-header {
        padding: 12px 15px;
    }
    
    .messages-container {
        padding: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('chat-form');
    const messagesContainer = document.getElementById('messages-container');

    scrollToBottom();

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("{{ route('chat.store') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // تحويل التاريخ لوقت اليمن قبل العرض
            const messageDate = new Date(data.created_at);
            const options = { timeZone: 'Asia/Aden' };
            const localDate = new Date(messageDate.toLocaleString('en-US', options));
            
            // تعديل بيانات التاريخ قبل إضافتها
            data.created_at = localDate.toISOString();
            addMessageToChat(data, true);
            form.reset();
            scrollToBottom();
        });
    });

    function addMessageToChat(message, isSent) {
        // استخدام توقيت اليمن
        const timezone = 'Asia/Aden';
        const messageDate = new Date(message.created_at);
        const options = { timeZone: timezone };
        
        // الحصول على التاريخ المحلي
        const localDateStr = messageDate.toLocaleDateString('en-CA', options);
        const localTimeStr = messageDate.toLocaleTimeString('ar-EG', {
            hour: '2-digit',
            minute: '2-digit',
            timeZone: timezone
        });
        
        // الحصول على تواريخ اليوم والأمس
        const now = new Date();
        const todayStr = now.toLocaleDateString('en-CA', options);
        const yesterday = new Date(now);
        yesterday.setDate(yesterday.getDate() - 1);
        const yesterdayStr = yesterday.toLocaleDateString('en-CA', options);
        
        // التحقق مما إذا كان هناك تاريخ اليوم موجود بالفعل
        const todayLabelExists = messagesContainer.querySelector('.message-date[data-date="' + todayStr + '"]');
        
        // إضافة تاريخ اليوم إذا لم يكن موجودًا وكانت الرسالة من اليوم
        if (localDateStr === todayStr && !todayLabelExists) {
            const dateDiv = document.createElement('div');
            dateDiv.className = 'message-date';
            dateDiv.setAttribute('data-date', todayStr);
            dateDiv.innerHTML = '<span>اليوم</span>';
            messagesContainer.appendChild(dateDiv);
        }
        // إضافة تاريخ جديد إذا كان مختلفًا عن اليوم والأمس ولم يكن موجودًا
        else if (localDateStr !== todayStr && localDateStr !== yesterdayStr) {
            const lastDateElement = messagesContainer.querySelector('.message-date:last-child');
            const lastDate = lastDateElement ? lastDateElement.getAttribute('data-date') : null;
            
            if (localDateStr !== lastDate) {
                const dateLabel = messageDate.toLocaleDateString('ar-EG', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    timeZone: timezone
                });
                
                const dateDiv = document.createElement('div');
                dateDiv.className = 'message-date';
                dateDiv.setAttribute('data-date', localDateStr);
                dateDiv.innerHTML = `<span>${dateLabel}</span>`;
                
                messagesContainer.appendChild(dateDiv);
            }
        }
        
        const messageClass = isSent ? 'sent' : 'received';
        let messageContent = '';

        if (message.file_path) {
            const fileExt = message.file_path.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                messageContent = `
                    <div class="file-message">
                        <img src="/storage/${message.file_path}" alt="ملف مرفق">
                    </div>
                `;
            } else {
                messageContent = `
                    <div class="file-message">
                        <a href="/chat/download/${message.id}" class="file-download">
                            <i class="fas fa-file-download"></i> تحميل الملف
                        </a>
                    </div>
                `;
            }
        }

        messageContent += `
            <div class="message-content">
                <p>${message.message || ''}</p>
                <div class="message-meta">
                    <span>${localTimeStr}</span>
                    ${isSent ? '<span class="read-status"><i class="fas fa-check"></i></span>' : ''}
                </div>
            </div>
        `;

        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${messageClass}`;
        messageDiv.innerHTML = messageContent;

        messagesContainer.appendChild(messageDiv);
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
//     window.addEventListener('beforeunload', function (e) {
//     fetch("{{ route('chat.markAsRead', $receiver->id) }}", {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': "{{ csrf_token() }}",
//             'Accept': 'application/json'
//         }
//     });
// });
document.addEventListener('visibilitychange', function () {
    if (document.visibilityState === 'hidden') {
        const data = new FormData();
        data.append('_token', "{{ csrf_token() }}");

        navigator.sendBeacon("{{ route('chat.markAsRead', $receiver->id) }}", data);
    }
});

    // تأثيرات إضافية عند النقر على الأزرار
    const buttons = document.querySelectorAll('button, .file-upload-label');
    buttons.forEach(button => {
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.95)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = '';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});
</script>
@endpush
@endsection