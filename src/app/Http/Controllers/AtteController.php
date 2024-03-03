<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;

class AtteController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function login() {
        return view('auth.login');
    }

    public function attendance() {
        return view('attendance');
    }

    public function index() {
        return view('index');
    }
}
