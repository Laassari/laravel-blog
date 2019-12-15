<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $post;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.post-created', [
            'user' => $this->user['name'],
            'post_title' => $this->post['title'],
            'post_id' => $this->post['id'],
        ] );
    }
}
