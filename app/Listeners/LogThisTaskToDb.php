<?php

namespace App\Listeners;

use App\Events\TaskWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogThisTaskToDb
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskWasCreated  $event
     * @return void
     */
    public function handle(TaskWasCreated $event)
    {
        var_dump("Logging to Db For Task: ".$event->task->task);
    }
}
