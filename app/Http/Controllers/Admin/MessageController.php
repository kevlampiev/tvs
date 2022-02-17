<?php

namespace App\Http\Controllers\Admin;

use App\DataServices\Admin\MessagesDataservice;
use App\Events\NewCommentToTheTaskReceived;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
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

        //TODO Пеоренести этого говнокод в отдельный сервис. Подумать о стркутуре таких сервисов
        //оповещаем только того юзера, который НЕ ОСТАВЛЯЛ этот комментарий
//        $task=$message->task;
//        while(!$task) {
//            $message = $message->reply_o
//            $task = $m->task;
//        }
//        if (auth()->user()->id != $task->user->id) {
//            NewCommentToTheTaskReceived::dispatch($task->user, $task);
//        }
//        if (auth()->user()->id != $task->performer->id) {
//            NewCommentToTheTaskReceived::dispatch($task->performer, $task);
//        }
        //а еще могут быть подписчики ..... и их тоже надо уведомить
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
