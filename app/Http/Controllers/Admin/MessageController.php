<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\MessagesDataservice;
use App\Events\NewCommentToTheTaskReceived;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Notifications\TaskCommented;
use App\NotificationServices\NewMessageNotificationSocketsService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public static function createTaskMessage(Request $request)
    {

    }

    public function createReply(Request $request, Message $message)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        $message = MessagesDataservice::createReply($request, $message);
        return view('Admin.messages.reply-edit',
            ['message' => $message]);
    }

    public function store(MessageRequest $request, Message $message): \Illuminate\Http\RedirectResponse
    {
        MessagesDataservice::store($request);
    //        try {
    //            (new NewMessageNotificationSocketsService($message))->handle();
    //        } catch (Error $e) {
    //            session()->flash('error', 'Не удалось отправить сообщение о новом комментарии к  задаче получателю');
    //        }
//        $task=$message->task;
//        $mess = $message;
//        while(!$task) {
//            $mess = $mess->parentMessage;
//            $task = $mess->task;
//        }
//
//        if ($message->user_id !== $task->user_id) $task->user->notify(new TaskCommented($task));
//        if ($message->user_id !== $task->task_performer_id) $task->performer->notify(new TaskCommented($task));
        NewMessageNotificationSocketsService::notify($message);
        $route = session('previous_url');
        return redirect()->to($route);
    }

    public function edit(Request $request, Message $message)
    {
        if (url()->previous() !== url()->current()) session(['previous_url' => url()->previous()]);
        MessagesDataservice::edit($request, $message);
        if ($message->reply_to_message_if) {
            return view('Admin.messages.reply-edit',
                MessagesDataservice::provideEditor($message));
        } else {
            return view('Admin.messages.message-edit',
                MessagesDataservice::provideEditor($message));
        }

    }

    public function update(MessageRequest $request, Message $message): \Illuminate\Http\RedirectResponse
    {
        MessagesDataservice::update($request, $message);
        $route = session('previous_url');
        return redirect()->to($route);
    }


    public function delete(Message $message): \Illuminate\Http\RedirectResponse
    {
        MessagesDataservice::delete($message);
        return redirect()->back();
    }
}
