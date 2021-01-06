<?php
namespace App\Http\Traits;
 
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Notification;
 
trait NotificationTrait
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function notify($toUser)
    {
        $message = new Message;
        $message->setAttribute('from', 1);
        $message->setAttribute('to', $toUser->id);
        $message->setAttribute('message', 'A request has been assigned to you!!');
        $message->save();
         
        $fromUser = User::find(1);

        Notification::send($toUser, new NewMessage($fromUser));
    }
}