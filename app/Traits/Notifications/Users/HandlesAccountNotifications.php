<?php

namespace App\Traits\Notifications\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Users\AccountSuspended;
use App\Notifications\Users\AccountActivated;
use App\Notifications\Users\AccountDeactivated;
use App\Notifications\Users\AccountUnSuspended;

trait HandlesAccountNotifications
{
    /**
     * Notification the writer his account has been suspended.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function accountSuspended(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Notification::send($user, new AccountSuspended);

        return new JsonResponse(['success' => true, 'message' => 'Notification sent successfully.']);
    }

    /**
     * Notification the writer his suspension has been lifted.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function accountUnSuspended(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Notification::send($user, new AccountUnSuspended);

        return new JsonResponse(['success' => true, 'message' => 'Notification sent successfully.']);
    }

    /**
     * Notification the writer his account has been activated.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function accountActivated(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Notification::send($user, new AccountActivated);

        return new JsonResponse(['success' => true, 'message' => 'Notification sent successfully.']);
    }

    /**
     * Notification the writer his account has been activated.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function accountDeactivated(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        Notification::send($user, new AccountDeactivated);

        return new JsonResponse(['success' => true, 'message' => 'Notification sent successfully.']);
    }
}
