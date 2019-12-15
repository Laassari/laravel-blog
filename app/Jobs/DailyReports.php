<?php

namespace App\Jobs;

use App\Mail\DailyReport;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DailyReports// implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $new_posts_count = Post::where('created_at', '<', Carbon::now()->subDay())->count();
        $new_users_count = User::where('created_at', '<', Carbon::now()->subDay())->count();
        $admins = config('mailable.admins');
        
        Mail::to($admins)->send(new DailyReport($new_posts_count, $new_users_count));
    }
}
