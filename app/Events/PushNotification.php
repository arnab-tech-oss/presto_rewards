<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $push_notification;
    public $cus_id;
    public $responsedata;
    public $firebaseToken;
    public $noti_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($push_notification,$cus_id,$noti_id)
    {
        //
        $this->push_notification = $push_notification;
        $this->cus_id = $cus_id;
        $this->noti_id = $noti_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
