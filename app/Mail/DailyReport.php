<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;
    protected $users_count;
    protected $posts_count;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($posts_count, $users_count)
    {
        $this->posts_count = $posts_count;
        $this->users_count = $users_count;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.daily-report')->with([
            'users_count' => $this->users_count,
            'posts_count' => $this->posts_count,
        ]);
    }
}
