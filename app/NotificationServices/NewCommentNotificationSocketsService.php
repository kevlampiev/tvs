<?php


namespace App\NotificationServices;


use App\Events\NewCommentToTheTaskReceived;
use App\Models\Task;

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
//        if (auth()->user()->id != $this->task->user_id) $result[] = "user.{$this->task->user->id}";
//        if (auth()->user()->id != $this->task->task_performer_id) $result[] = "user.{$this->task->performer->id}";
        $result[] = "user.1";
        return $result;
    }

    public function handle()
    {

        foreach($this->getChannelList() as $channel) {
            NewCommentToTheTaskReceived::dispatch($channel, $this->task);
        }
    }
}
