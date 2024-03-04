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
        $workStart = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'workStart'));
    }

    public function workStart(Request $request) {
        $workStart = $request->only(['user_id', 'date', 'work_start']);
        Time::create($workStart);
        $user = Auth::user();
        $now = Carbon::now();
        $workStart = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        return view('index', compact('user', 'now', 'workStart'));
    }

    public function workEnd(Request $request) {
        $workEnd = $request->only(['id', 'user_id', 'date', 'work_start', 'work_end', 'break_time']);
        Time::find($workEnd['id'])->update($workEnd);
        $user = Auth::user();
        $now = Carbon::now();
        return view('index', compact('user', 'now'));
    }

    public function attendance() {
        return view('attendance');
    }
}
