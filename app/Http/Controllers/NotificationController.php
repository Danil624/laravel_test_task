<?php
 namespace App\Http\Controllers;
 
 use App\Http\Controllers\Controller;
 use App\Models\Message;
 use App\Models\User;
 use App\Notifications\NewMessage;
 use Illuminate\Support\Facades\Notification;
 
 class NotificationController extends Controller
 {
     public function __construct()
     {
         $this->middleware('auth');
     }
 
     public function index()
     {
         // пользователь 2 отправляет сообщение пользователю 1
         $message = new Message;
         $message->setAttribute('from', 2);
         $message->setAttribute('to', 1);
         $message->setAttribute('message', 'Demo message from user 2 to user 1.');
         $message->save();
         
         $fromUser = User::find(2);
         $toUser = User::find(1);
         
// отправляем уведомление по модели "пользователь", когда пользователь получает новое сообщение         $toUser->notify(new NewMessage($fromUser));
         
         // отправить уведомление с помощью фасада «Уведомление»
         Notification::send($toUser, new NewMessage($fromUser));
     }
 }