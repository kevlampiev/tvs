<?php


namespace App\DataServices\Admin;


use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesDataservice
{
    public static function provideData(): array
    {
        return [];
    }

    public static function createReply(Request $request, Message $message): Message
    {
        $m = new Message();
        $m->reply_to_message_id = $message->id;
        $m->task_id = $message->task_id;
        $m->user_id = Auth::user()->id;
        if (!empty($request->old())) $m->fill($request->old());
        return $m;
    }

    public static function saveChanges(MessageRequest $request, Message $message)
    {
        $message->fill($request->all());
        if (!$message->user_id) $message->user_id = Auth::user()->id;
        if ($message->id) $message->updated_at = now();
        else $message->created_at = now();
        $message->save();
    }

    public static function store(MessageRequest $request)
    {
        try {
            $message = new Message();
            self::saveChanges($request, $message);
            session()->flash('message', 'Добавлено новое сообщение');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось добавить новое сообщение');
        }

    }


    public static function edit(Request $request, Message $message)
    {
        if (!empty($request->old())) $message->fill($request->old());
    }

    public static function update(MessageRequest $request, Message $message)
    {
        try {
            self::saveChanges($request, $message);
            session()->flash('message', 'Сообщение обновлено');
        } catch (Error $err) {
            session()->flash('error', 'Не удалось обновить сообщение');
        }
    }


}
