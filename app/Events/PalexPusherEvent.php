<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PalexPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        dump($this->message);
        $this->message = $message;
        dump($this->message);
    }

    public function broadcastOn()
    {
        // dump('broadcasting');
        return ['palex-channel'];
    }

    public function broadcastAs()
    {
        // dump('broadcasting as');
        return 'palex-pusher-event';
    }
}
