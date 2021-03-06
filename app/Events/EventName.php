<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class EventName extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = array(
            'instagram'=>$data->images->standard_resolution->url,
            'tag'=> $data->tags
            //'power'=> '10'
        );
        

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['test-channel'];
    }
}
