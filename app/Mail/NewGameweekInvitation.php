<?php

namespace App\Mail;

use App\Models\Fixture;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewGameweekInvitation extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $fixture;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Fixture $fixture)
    {
        $this->user = $user;
        $this->fixture = $fixture;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('kaungsan.dev@gmail.com',config('app.name'))
        ->view('mail.newgameweekinvitation');
    }
}
