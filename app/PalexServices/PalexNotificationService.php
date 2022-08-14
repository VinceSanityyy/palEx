<?php

namespace App\PalexServices;

use App\Events\PalexNotificationEvent;
use App\Models\PalexNotification;
use App\Models\Order;
use stdClass;

class PalexNotificationService
{

    private $notification_data;
    private $receiver_user_id;
    private $order_data;

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
            'title' => 'New Palex Order!',
            'body' => 'You have received new order from user <b>' . $Order->customer->name . '</b>',
            // 'link' => '/vendor/order/' . $order_data->id,
            'link' => url('/vendor/orders'),
            'link_end_point' => '/vendor/orders',
            'image_link' => $Order->customer->profile_image_link,
            'type' => 'order',
            'other_data' => $json_other_data,
        ];

        $this->create_notification($notif_data, $Order->vendor_id);
    }



    public function create_notification($data, $user_id)
    {
        // $PalexNotification = new PalexNotification();
        $notification_data =  PalexNotification::create($data);
        if ($notification_data->other_data) {
            $notification_data->other_data = json_decode($notification_data->other_data);
        } else {
            $notification_data->other_data = null;
        }
        $this->notification_data = $notification_data;
        $this->receiver_user_id = $user_id;
        $this->send();
    }

    public function send()
    {
        event(new PalexNotificationEvent($this->notification_data, $this->receiver_user_id));
    }
}
