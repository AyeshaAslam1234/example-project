<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $postTitle;

    public function __construct($postTitle)
    {
        $this->postTitle = $postTitle;
    }

    public function build()
    {
        return $this->subject('New Post Created!')
                    ->view('emails.post_created')
                    ->with(['title' => $this->postTitle]);
    }
}
