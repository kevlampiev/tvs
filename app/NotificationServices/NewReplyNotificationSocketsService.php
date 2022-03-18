<?php


namespace App\NotificationServices;


use App\Events\NewCommentToTheTaskReceived;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;

class NewReplyNotificationSocketsService extends NewCommentNotificationSocketsService
{

    public function __construct(Message $message)
    {
        $task = $message->task;
        while(!$task) {
            $message = Message::findOrFail($message->reply_to_message_id);
            $task = $message->task;
        }
        parent::__construct($task);
    }


}
