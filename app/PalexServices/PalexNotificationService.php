<?php

namespace App\PalexServices;

use App\Events\PalexNotificationEvent;
use App\Models\PalexNotification;
use App\Models\Order;
use stdClass;

class PalexNotificationService
{
    public function __construct()
    {
    }

    public function send_order_notification($order_data)
    {

        $Order = Order::find($order_data->id)->load('customer');


        $other_data = new stdClass;
        $other_data->order_id =  $order_data->id;
        $other_data->customer_id =  $order_data->customer_id;
        $other_data->vendor_id =  $order_data->vendor_id;

        $json_other_data = json_encode($other_data);

        $notif_data =   [
            'user_id' => $order_data->vendor_id,
            'title' => 'New Palex Order! OID #' . $order_data->id,
            'body' => 'You have received new order from user <b>' . $Order->customer->name . '</b>.',
            // 'link' => '/vendor/order/' . $order_data->id,
            'link' => url('/vendor/orders'),
            'link_end_point' => '/vendor/orders',
            'image_link' => $Order->customer->profile_image_link,
            'type' => 'order',
            'other_data' => $json_other_data,
        ];

        $this->create_and_send($notif_data, $Order->vendor_id);
    }



    public function create_and_send($data, $receiver_user_id)
    {
        // $PalexNotification = new PalexNotification();
        $notification_data =  PalexNotification::create($data);
        if ($notification_data->other_data) {
            $notification_data->other_data = json_decode($notification_data->other_data);
        } else {
            $notification_data->other_data = null;
        }
        $total_notifications = PalexNotification::where('user_id', $receiver_user_id)->count();
        $total_unseen_notifications =  PalexNotification::where('user_id', $receiver_user_id)->where('seen', 0)->count();
        event(new PalexNotificationEvent(
            $notification_data,
            $receiver_user_id,
            $total_notifications,
            $total_unseen_notifications,
        ));
    }
}
