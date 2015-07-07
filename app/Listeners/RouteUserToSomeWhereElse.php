<?php

namespace App\Listeners;

use App\Events\EmailWasSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RouteUserToSomeWhereElse
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
     * @param  EmailWasSent  $event
     * @return void
     */
    public function handle(EmailWasSent $event)
    {
        var_dump('route_user_to_some_where _else');
    }
}
