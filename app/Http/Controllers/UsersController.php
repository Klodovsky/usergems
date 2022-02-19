<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){

        $users = User::all()->except(auth()->user());
        return Inertia::render('Users/index',[
            'users' => $users
        ]);
    }
}
