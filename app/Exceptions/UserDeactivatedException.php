<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserDeactivatedException extends Exception
{

    /**
     * Render an exception into an HTTP response.
     *
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\View\View
     */
    public function render($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = [
                'message' => __('auth.deactivated_title'),
                'errors' => [
                    'email' => [__('auth.deactivated_message')]
                ]
            ];
            return new JsonResponse($data, 403);
        }

        return view('errors.deactivated');
    }
}
