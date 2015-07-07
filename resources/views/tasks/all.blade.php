<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/2/2015
 * Time: 4:52 AM
 */
 ?>
 @extends('parent')

 @section('site-content')

 <h1 style="text-align: center">All Tasks</h1>

  {{$tasks_table->draw()}}

@endsection
