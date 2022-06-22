<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Traits\Notifications\ReceiveRemoteNotifications;

class NotificationsController extends Controller
{
    use ReceiveRemoteNotifications;

    /**
     * NotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index']);
    }

    /**
     * View the users notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->notifications->each->read();

        return view('app.notifications.index', [
            'notifications' => Auth::user()->notifications()->paginate(15),
        ]);
    }
}
