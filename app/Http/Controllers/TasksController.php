<?php

namespace App\Http\Controllers;

use App\Task;
use App\Zeenom_Helpers\Sort;
use App\Zeenom_Helpers\ZeenomSimpleTable;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class TasksController extends ParentController
{
    private $task;
    private $auth_user;
    public function __construct(Task $task)
    {
        parent::__construct();

        $this->task = $task;
        $this->auth_user = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Task $task)
    {
        $tasks = $this->auth_user->tasks()->sort()->get();

        return view('tasks.all')
                    ->with('tasks_table',new ZeenomSimpleTable($tasks));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\SaveTaskRequest $request)
    {
        $task = new Task($request->all());
        $this->auth_user->tasks()->save($task);
        return Redirect::route('show_tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
