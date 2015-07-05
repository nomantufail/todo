<?php

use Illuminate\Database\Seeder;

class Tasks_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = factory('App\Task', 5000)->make();
        DB::table('tasks')->insert($tasks->toArray());
    }
}
