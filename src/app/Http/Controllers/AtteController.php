<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Time;
use App\Models\Closed;
use Carbon\Carbon;

class AtteController extends Controller
{

    public function index() {
        $user = Auth::user();
        $now = Carbon::now();

        if(session('redirect_key') === 'method') {
            $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
            $break = Closed::orderBy('id', 'desc')->where('time_id', $work['id'])->first();

            return view('index', compact('user', 'now', 'work', 'break'));
        }else{
            return view('index', compact('user', 'now'));
        }
    }

    public function workStart(Request $request) {
        $workStart = $request->only(['user_id', 'date', 'work_start']);
        Time::create($workStart);

        return redirect('/')->with('redirect_key', 'method');
    }

    public function breakStart(Request $request) {
        $breakStart = $request->only(['time_id', 'break_start']);
        Closed::create($breakStart);

        return redirect('/')->with('redirect_key', 'method');
    }

    public function breakEnd(Request $request) {
        $breakEnd = $request->only(['id','time_id', 'break_start', 'break_end']);
        $totalBreak = $request->only(['total_break']);
        $restStart = new Carbon($breakEnd['break_start']);
        $restEnd = new Carbon($breakEnd['break_end']);
        $restTimes = new Carbon($totalBreak['total_break']);

        $breakTotal = $restStart->diffInSeconds($restEnd);
        if($restTimes == '00:00:00') {
            $total['total_break'] = Time::formatTime($breakTotal);
        }else{
            $total['total_break'] = $restTimes->addSeconds($breakTotal);
        }
        Time::find($breakEnd['time_id'])->update($total);

        $breakEnd['break_time'] = Time::formatTime($breakTotal);
        Closed::find($breakEnd['id'])->update($breakEnd);

        return redirect('/')->with('redirect_key', 'method');
    }

    public function workEnd(Request $request) {
        $workEnd = $request->only(['id', 'work_start', 'work_end', 'total_break']);
        $laborStart = new Carbon($workEnd['work_start']);
        $laborEnd = new Carbon($workEnd['work_end']);
        $restTime = new Carbon($workEnd['total_break']);

        $laborTime = $laborStart->diffInSeconds($laborEnd);
        $laborFormat = Time::formatTime($laborTime);

        if($workEnd['total_break'] == '00:00:00') {
            $workFormat = $laborFormat;
        }else{
            $workTime = $restTime->diffInSeconds($laborFormat);
            $workFormat = Time::formatTime($workTime);
        }

        $workEnd['work_time'] = $workFormat;
        Time::find($workEnd['id'])->update($workEnd);

        return redirect('/');
    }
}
