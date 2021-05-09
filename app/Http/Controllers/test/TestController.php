<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(){
         require_once app_path("lib\DBPDO.php");
          //$db=new \DBPDO();
          //$res=$db->insert("insert into user(username) values(?)",["ding"]);
         // $arr=(array)$res;
          $res=\DBPDO::select("select * from user where id=?",[1]);
       print_r($res);

    }
}
