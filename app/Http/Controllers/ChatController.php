<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 1) {
            // إذا كان المستخدم الحالي لديه role=1، نعرض جميع المستخدمين الذين لديهم role=0
            $doctors = User::where('role', 0)->get();
        } else {
            // إذا لم يكن المستخدم الحالي لديه role=1، نعرض البيانات حسب احتياجك
            // هنا يمكنك وضع الشروط الأخرى أو إرجاع بيانات مختلفة
            $doctors = User::where('role', 1)->get();
        }
        
        return view('Chat.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'message' => 'nullable|string|max:1000',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:2048',
            ]);

            $messageData = [
                'sender_id'   => auth()->id(),
                'receiver_id' => $request->receiver_id,
                'message'     => $request->message,
            ];

            // لو فيه ملف مرفوع
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('chat_files', 'public');
                $messageData['file_path'] = $path;
            }

            $message = Message::create($messageData);

            return response()->json([
                'id'          => $message->id,
                'sender_id'   => $message->sender_id,
                'receiver_id' => $message->receiver_id,
                'message'     => $message->message,
                'file_path'   => $message->file_path,
                'created_at'  => $message->created_at->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'حدث خطأ أثناء إرسال الرسالة: ' . $e->getMessage()
            ], 500);
        }
    }




    /**
     * Display the specified resource.
     */
//     public function show($doctorId)
// {
//     $doctor = User::findOrFail($doctorId);

//     return view('Chat.chat',compact('doctor'));
// }
public function show($userId)
{
    $receiver = User::findOrFail($userId);
    $sender = auth()->user();

    // جلب الرسائل المشتركة فقط بين المستخدم الحالي والـ receiver
    $messages = Message::where(function($query) use ($sender, $receiver) {
            $query->where('sender_id', $sender->id)
                  ->where('receiver_id', $receiver->id);
        })
        ->orWhere(function($query) use ($sender, $receiver) {
            $query->where('sender_id', $receiver->id)
                  ->where('receiver_id', $sender->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return view('Chat.chat', compact('receiver', 'messages'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function markAsRead($receiverId)
    {
        \App\Models\Message::where('sender_id', $receiverId)
            ->where('receiver_id', auth()->id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
    
        return response()->json(['status' => 'success']);
    }
    
// في ChatController.php
public function unreadCount()
{
    $userId = auth()->id();

    $count = \DB::table('messages')
        ->where('receiver_id', $userId)
        ->where('is_read', 0)
        ->count();

    return response()->json(['count' => $count]);
}

}
