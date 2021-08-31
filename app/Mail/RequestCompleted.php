<?php

namespace App\Mail;

use App\RequestDetail;
use App\SettingSocialLink;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $facebook;
    public $twitter;
    public $instagram;
    public $linkedin;
    public $user;
    public $talent;
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uid, $tid, $request_id)
    {
        $links = SettingSocialLink::all();
        $this->facebook = $links[0]->link;
        $this->twitter = $links[1]->link;
        $this->instagram = $links[2]->link;
        $this->linkedin = $links[3]->link;
        $this->user = User::find($uid);
        $this->talent = User::join('talent_infos', 'users.id', '=', 'talent_infos.user_id')->join('categories', 'talent_infos.category_id', '=', 'categories.id')->where('users.id', $tid)->first();
        $this->request = RequestDetail::find($request_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.request_completed')->with([
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'user' => $this->user,
            'talent' => $this->talent,
            'request' => $this->request,
        ]);
    }
}
