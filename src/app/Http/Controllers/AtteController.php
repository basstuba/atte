<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;

class AtteController extends Controller
{

    public function index() {
        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'work'));
    }

    public function workStart(Request $request) {
        $workStart = $request->only(['user_id', 'date', 'work_start']);
        Time::create($workStart);
        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'work'));
    }

    public function breakStart(Request $request) {
        $breakStart = $request->only(['id', 'break_start']);
        Time::find($breakStart['id'])->update($breakStart);
        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'work'));
    }

    public function breakEnd(Request $request) {
        $breakEnd = $request->only(['id', 'break_start', 'break_end']);
        Time::find($breakEnd['id'])->update($breakEnd);
        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'work'));
    }

    public function workEnd(Request $request) {
        $workEnd = $request->only(['id', 'work_end']);
        Time::find($workEnd['id'])->update($workEnd);
        $user = Auth::user();
        $now = Carbon::now();
        return view('index', compact('user', 'now'));
    }

    public function attendance() {
        return view('attendance');
    }
}
