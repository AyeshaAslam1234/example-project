<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Mail\PostDeletedMail;
use Illuminate\Support\Facades\Mail;
class deletedata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deletedata';
    protected $description = 'this command delete data and send an email notifications';


    /**
     * The console command description.
     *
     * @var string
     */
 
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('title', 'cesfrrrg')->take(2)->get();

        // dd($posts);

        if($posts->isEmpty()) {
            $this->info('there is nothing in the post table');
            return;
        }

        $deletecount=0;

        foreach($posts as $post){
            $post->delete();
            $deletecount++;
        }
        
        Mail::to('admin@example.com')->send(new PostDeletedMail($deletecount));

        $this->info($deletecount .' ,post are deleted,now you are happy');
    }
}
