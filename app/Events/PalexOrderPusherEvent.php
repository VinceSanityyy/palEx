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

class PalexOrderPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user_id;

    public function __construct($message)
    {
        // dump($this->message);
        $this->message = $message;
        // dump($this->message);

        $this->user_id = 1;
    }

    public function broadcastOn()
    {
        // dump('broadcasting');
        $this->user_id;
        return ['palex-order-channel-' . $this->user_id];
    }

    public function broadcastAs()
    {
        // dump('broadcasting as');
        return 'palex-order-event';
    }
}
