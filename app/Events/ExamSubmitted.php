<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamSubmitted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notify;

    public function __construct($notify)
    {
        $this->notify = $notify;
    }

    public function broadcastOn()
    {
        return new Channel('exam-channel');
    }

    public function broadcastAs()
    {
        return 'exam-event';
    }
}
