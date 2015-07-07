<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Event;
use App\Events\EmailWasSent;

class SendEmailCommand extends Command implements SelfHandling
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        var_dump("sending an email");

        Event::fire(new EmailWasSent);
    }
}
