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
        // $this->message = $message;
        // dump($this->message);
        $this->order_id = 1;
        $this->vendor_id = 1;
    }

    public function broadcastOn()
    {
        // dump('broadcasting');
        $this->vendor_id;
        return ['palex-order-channel-' . $this->vendor_id];
    }

    public function broadcastAs()
    {
        // dump('broadcasting as');
        return 'palex-order-event';
    }
}
