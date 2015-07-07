<?php

namespace App\Commands;

use App\Commands\Command;
use App\Events\TaskWasCreated;
use App\Task;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Event;

class CreateTaskCommand extends Command implements SelfHandling
{
    public $request;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Request $createTaskRequest)
    {
        $this->request = $createTaskRequest;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        var_dump('creating a task');
        $auth_user = Auth::user();
        $task = new Task($this->request->all());
        $auth_user->tasks()->save($task);
        event(new TaskWasCreated($task));
    }
}
