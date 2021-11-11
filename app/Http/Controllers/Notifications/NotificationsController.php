<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewUser;
// use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notification;
class NotificationsController extends Controller
{
    public function markAllasRead($flag = null)
    {
        if($flag != null)
        {
            Auth::user()->notifications->where('id' , $flag)->markAsRead();
            return redirect(url('users'));
        }
        Auth::user()->unReadNotifications->markAsRead();
        return back();
    }
}
