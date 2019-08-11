<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->name =  $user->name;
        $this->email = $user->email;
        $this->act_token = $user->activation_token;
        $this->user_id = $user->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.activation')
            ->with('email', $this->email)
            ->with('user_id', $this->user_id)
            ->with('act_token', $this->act_token)
            ->with('name',$this->name);
    }
}
