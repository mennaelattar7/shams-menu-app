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

    public function markAsRead ($locale,$notification_id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id',$notification_id)->first();
        if(!$notification)
        {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found'
            ], 404);
        }
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read'
        ],200);
    }

    public function count()
    {
        $user = Auth::user();
        $all_notifications_count = $user->notifications()->count();
        $unread_notifications_count = $user->unreadNotifications()->count();
        $read_notifications_count = $user->readNotifications()->count();
        return response()->json([
            'success' =>true,
            'message' =>'get Notification Count Successfuly',
            'data' => [
                'all_notifications_count' => $all_notifications_count,
                'unread_notifications_count' =>$unread_notifications_count,
                'read_notifications_count' =>$read_notifications_count
            ]
        ],200);
    }
}
