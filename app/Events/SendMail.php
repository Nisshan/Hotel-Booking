<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendMail
 * @package App\Events
 */
class SendMail
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public Mixed $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Mixed $response)
    {
        $this->response = $response;
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
