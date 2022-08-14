<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PalexNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification_data;
    public $receiver_user_id;
    public $total_notifications;
    public $total_unseen_notifications;


    public function __construct($data, $receiver_user_id, $total_notifications, $total_unseen_notifications)
    {
        $this->notification_data = $data;
        $this->receiver_user_id = $receiver_user_id;
        $this->total_notifications = $total_notifications;
        $this->total_unseen_notifications = $total_unseen_notifications;
    }

    public function broadcastOn()
    {
        return ['palex-notification-channel-' . $this->receiver_user_id];
    }

    public function broadcastAs()
    {
        return 'palex-notification-event';
    }
}
