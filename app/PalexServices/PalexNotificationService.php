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

    public function send_feeds_notification($title, $userId)
    {
        $other_data = new stdClass;
        $other_data->title = $title;
        $data = [
            'title' => 'Admin posted a new update',
            'body' => 'Check the newsfeed page for more info',
            'type' => 'news',
            'link' => url('/customer/feeds'),
            'link_end_point' => '/customer/feeds',
            'user_id' => $userId,
            'image_link' => '/img/update.png'
        ];
            $this->create_and_send($data, $userId);
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


    public function send_order_update_notif_to_customer($order_data, $status)
    {

        $Order = Order::find($order_data->id)->load('vendor');


        $other_data = new stdClass;
        $other_data->order_id =  $order_data->id;
        $other_data->customer_id =  $order_data->customer_id;
        $other_data->vendor_id =  $order_data->vendor_id;

        $json_other_data = json_encode($other_data);

        $notif_data =   [
            'user_id' => $order_data->customer_id,
            'title' => 'Order Reserved. #' . $order_data->id,
            'body' => 'Your Order is now marked as '.$status.' by <b>' . $Order->vendor->name . '</b>.',
            // 'link' => '/vendor/order/' . $order_data->id,
            'link' => url('/customer/orders/' . $order_data->id,),
            'link_end_point' => '/customer/orders/' . $order_data->id,
            'image_link' => $Order->vendor->profile_image_link,
            'type' => 'order',
            'other_data' => $json_other_data,
        ];

        $this->create_and_send($notif_data, $Order->customer_id);
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
