<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/2/2015
 * Time: 3:08 AM
 */ ?>

 <!-- resources/views/auth/login.blade.php -->

 <form method="POST" action="/auth/login">
     {!! csrf_field() !!}

     <div>
         Email
         <input type="email" name="email" value="{{ old('email') }}">
     </div>

     <div>
         Password
         <input type="password" name="password" id="password">
     </div>

     <div>
         <input type="checkbox" name="remember"> Remember Me
     </div>

     <div>
         <button type="submit">Login</button>
     </div>
 </form>