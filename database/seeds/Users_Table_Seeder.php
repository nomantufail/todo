<?php

use Illuminate\Database\Seeder;

class Users_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory('App\User', 25)->make();
        DB::table('users')->insert($users->toArray());
    }
}
