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

    public function __construct($data, $receiver_user_id)
    {
        $this->notification_data = $data;
        $this->receiver_user_id = $receiver_user_id;
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
