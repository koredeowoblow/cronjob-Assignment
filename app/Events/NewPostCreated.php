<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewPostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PresenceChannel('posts');
    }

    public function broadcastAs()
    {
        return 'new.post.created';
    }

    public function broadcastWith()
    {
         return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'body' => $this->post->body,
            'user' => $this->post->user->only('id', 'name'),
        ];
    }
}
