<?php

namespace App\Listeners;

use App\Commands\SendEmailCommand;
use App\Events\TaskWasCreated;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SendEmailToUser
{
    use DispatchesJobs;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TaskWasCreated  $event
     * @return void
     */
    public function handle(TaskWasCreated $event)
    {
        $this->dispatch(new SendEmailCommand());
    }
}
