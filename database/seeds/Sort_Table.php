<?php

use Illuminate\Database\Seeder;

class Sort_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sort')->insert(
            [
                [
                    'view'=>'tasks',
                    'order_by'=>'asc',
                    'sort_by'=>'id'
                ],
                [
                    'view'=>'tasks',
                    'order_by'=>'asc',
                    'sort_by'=>'task'
                ]
            ]
        );
    }
}
