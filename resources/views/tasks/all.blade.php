<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/2/2015
 * Time: 4:52 AM
 */
 ?>
 <h1 style="text-align: center">All Tasks</h1>
 <?php

       $table = new \App\Zeenom_Helpers\ZeenomSimpleTable($tasks);
       $table->draw();