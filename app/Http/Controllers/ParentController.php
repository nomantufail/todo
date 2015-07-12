<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ParentController extends Controller
{
    protected $request;
    public function __construct()
    {
        //calling middlewares
        $this->middleware('auth');

        $this->request = new Request();
    }
}
