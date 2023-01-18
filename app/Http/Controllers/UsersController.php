<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index() {
        $akun_user = DB::select('select * from users');
        return view('admin/dataUser',['users'=>$akun_user]);
     }
}
