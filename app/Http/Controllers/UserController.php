<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard(){
        return view('backend.admin.dashboard');
    }
    public function getList(){
        $users= DB::table('users')->get();
        return view('backend.user.list',compact('users'));
    }
}
