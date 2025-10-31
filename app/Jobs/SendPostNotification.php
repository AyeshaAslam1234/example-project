<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreatedMail;

class SendPostNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $postTitle;

    public function __construct($postTitle)
    {
        $this->postTitle = $postTitle;
    }

    public function handle(): void
    {
        //  Correct variable name and mail import
        Mail::to('admin@example.com')->send(new PostCreatedMail($this->postTitle));

        \Log::info("Email notification sent for post: " . $this->postTitle);
    }
}
