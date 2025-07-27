<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Post;
use App\Models\User;

class FanPostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;
    protected $author;

    public function __construct(Post $post,User $author )
    {
        $this->post = $post;
        $this->author = $author;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Post from ' . $this->author->name)
            ->line($this->author->name . ' just posted a new update!')
            ->line('"' . $this->post->body . '"')
            ->action('View Post', url('/posts/' . $this->post->id))
            ->line('Thanks for following!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'author' => $this->post->user->name,
            'title' => $this->post->title,
            'body' => $this->post->body,
        ];
    }
}
