<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Notifications\DatabaseNotification as Notification;

class ReadNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('notification')) {
            $notification = Notification::find($request->get('notification'));
            if (!is_null($notification)) {
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
