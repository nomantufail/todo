<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/2/2015
 * Time: 4:52 AM
 */
 ?>

<h1 style="text-align: center">Create New Task</h1>

 {!! Form::open(array('route' => 'save_task')) !!}

<textarea name="task"></textarea>
<br>
<input type="date" name="start_date">
<input type="date" name="end_date">
<input type="submit">

{!! Form::close() !!}

@if ($errors->any())
<div style="color: red">
    {{ var_dump($errors->all()) }}
</div>
@endif