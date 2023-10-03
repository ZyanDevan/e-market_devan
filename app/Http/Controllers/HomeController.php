<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function contact(){
        return view('contact');
    }

    public function FAQ(){
        return view('FAQ');
    }
}
