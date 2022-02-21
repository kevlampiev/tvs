<?php


namespace App\NotificationServices;


use App\Events\NewCommentToTheTaskReceived;
use App\Models\Task;
use App\Models\User;

class NewCommentNotificationSocketsService implements NotificationSocketInterface
{
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getChannelList():array
    {
        $result = [];
        $pId = auth()->user()->id;
        if ($pId !== $this->task->user->id) $result[] = "user.{$this->task->user->id}";
        if ($pId !== $this->task->performer->id) $result[] = "user.{$this->task->performer->id}";
        return $result;
    }

    public function handle()
    {
        foreach($this->getChannelList() as $channel) {
            NewCommentToTheTaskReceived::dispatch($channel, $this->task);
        }
    }
}
