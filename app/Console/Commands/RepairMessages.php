<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class RepairMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:repair';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and repair message records';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $messages = Message::query()
            ->where('task_id','=', null)
            ->where('reply_to_message_id','<>', null)
            ->get();
        foreach ($messages as $message)
        {
            $parrent = Message::find($message->reply_to_mesage_id);
            while (!$parrent->task_id) {
                $parrent=Message::find($parrent->reply_to_mesage_id);
            }
            $message->task_id = $parrent->task_id;
            $message->save();
        }
        return 0;
    }
}
