<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 7/7/2015
 * Time: 6:10 AM
 */

namespace App;

class CurrentUserTasksCollection {

    public $user;
    private $tasks = [];

    public function __construct(User $user)
    {
        $this->tasks = $user->tasks()->sort()->get();
    }

    public function get()
    {
        return $this->tasks;
    }
} 