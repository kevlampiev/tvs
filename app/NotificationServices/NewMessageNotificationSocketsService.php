<?php


namespace App\NotificationServices;


use App\Events\NewCommentToTheTaskReceived;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskCommented;

class NewMessageNotificationSocketsService
{

    public static function notify(Message $message)
    {
        $task=$message->task;
        $mess = $message;
        while(!$task) {
            $mess = $mess->parentMessage;
            $task = $mess->task;
        }
        $userId = auth()->user()->id;
        if ($userId !== $task->user_id) $task->user->notify(new TaskCommented($task));
        if ($userId !== $task->task_performer_id) $task->performer->notify(new TaskCommented($task));
    }


}
