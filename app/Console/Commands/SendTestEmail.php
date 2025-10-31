<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class SendTestEmail extends Command
{
    protected $signature = 'send:test-email';
    protected $description = 'Send a simple test email using task scheduler';

    public function handle()
    {
        Mail::to('admin@example.com')->send(new TestEmail());
        $this->info('✅ Test email sent successfully!');
    }
}
