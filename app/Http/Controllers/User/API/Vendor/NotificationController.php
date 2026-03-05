<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notificationresource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends BaseController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest();
        if($request->type == "unread")
        {
            $notifications = $user->unreadNotifications()->latest();
        }
        if($request->type == "read")
        {
            $notifications = $user->readNotifications()->latest();
        }
        if($request->per_page != null)
        {
            $notifications = $notifications->paginate($request->per_page);

            return Notificationresource::collection($notifications)
            ->additional([
                'success' => true,
                'message' => 'Get Notification Successfully'
            ])
            ->response()
            ->setStatusCode(200);
        }

        $notifications = $notifications->get();
        return response()->json([
            'success' => true,
            'message' =>'Get Notification Successfully',
            'data' => Notificationresource::collection($notifications)
        ]);
    }
}
