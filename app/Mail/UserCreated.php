<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Admin.emails.new-user-created', ['user' => $this->user])
            ->subject('Вам поставлена новая задача');
    }
//    public function build()
//    {
//        $view=$this->view('Admin.emails.new-user-created', ['user' => $this->user]);
//        dd($view);
//        return $this->view('Admin.emails.new-user-created', ['user' => $this->user])
//            ->subject('Вы подключены к порталу Кузбасс Майнинг');;
//    }
}
