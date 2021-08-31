<?php

namespace App\Mail;

use App\SettingSocialLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $facebook;
    public $twitter;
    public $instagram;
    public $linkedin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
        $links = SettingSocialLink::all();
        $this->facebook = $links[0]->link;
        $this->twitter = $links[1]->link;
        $this->instagram = $links[2]->link;
        $this->linkedin = $links[3]->link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome_user')->with([
            'name' => $this->name,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
        ]);
    }
}
