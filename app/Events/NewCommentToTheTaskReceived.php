<?php

namespace App\Events;

use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewCommentToTheTaskReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel;
    public $message;
    public $routeToRedirect;
    public $task;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Task $task
     */
    public function __construct(string $channel, Task $task)
    {
        $this->channel = $channel;
        $this->task = $task;
        $this->message =  "Поступил комментарий по задаче ".$task->subject;
        $this->routeToRedirect = route('admin.taskCard', ['task' =>$task]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel($this->channel);
    }

    public function broadcastAs()
    {
        return 'task.commented';
    }
}
