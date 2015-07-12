<?php

namespace App\Http\Controllers;


use App\Zeenom_Helpers\Sort;
use App\Zeenom_Helpers\ZeenomSimpleTable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mockery\CountValidator\Exception;

use App\ Customer;

class CustomersController extends ParentController
{
    public $customer;
    public function __construct(Customer $customer)
    {
        parent::__construct();

        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('customers.all')
                ->with('customers_table',new ZeenomSimpleTable(Customer::sort()->get()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        try
        {
            Customer::destroy($id);
            return Redirect::route('show_customers');
        }
        catch(ModelNotFoundException $e)
        {
            return Redirect::route('show_customers');
        }
    }
}
