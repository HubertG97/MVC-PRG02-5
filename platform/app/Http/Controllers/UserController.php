<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){


        $all_users = User::all();


        return view('Users.all', compact('all_users'));
    }

    public function update(){

    }
}
