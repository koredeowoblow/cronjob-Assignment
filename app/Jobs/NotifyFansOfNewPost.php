<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Post;
use App\Notifications\FanPostNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyFansOfNewPost implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    protected $author;

    public function __construct(Post $post, User $author)
    {
        $this->post = $post;
        $this->author = $author;
    }

    public function handle()
    {
        $fans = $this->author->fans;

        foreach ($fans as $fan) {
            $fan->notify(new FanPostNotification($this->post, $this->author));
        }
    }
}
