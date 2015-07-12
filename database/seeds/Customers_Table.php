<?php

use Illuminate\Database\Seeder;

class Customers_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = factory('App\Customer', 40)->make();
        DB::table('customers')->insert($customer->toArray());
    }
}
