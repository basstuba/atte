<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

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
        $breakStart['break_end'] = null;
        Time::find($breakStart['id'])->update($breakStart);

        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();

        return view('index', compact('user', 'now', 'work'));
    }

    public function breakEnd(Request $request) {
        $breakEnd = $request->only(['id', 'break_start', 'break_end', 'break_time']);
        $restStart = new Carbon($breakEnd['break_start']);
        $restEnd = new Carbon($breakEnd['break_end']);
        $restTimes = new Carbon($breakEnd['break_time']);

        $breakTime = $restStart->diffInSeconds($restEnd);
        if($restTimes == '00:00:00') {
            $hours = floor($breakTime / 3600);
            $minutes = floor(($breakTime % 3600) / 60);
            $seconds = $breakTime % 60;
            $breakFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }else{
            $breakFormat = $restTimes->addSeconds($breakTime);
        }

        $breakEnd['break_time'] = $breakFormat;
        Time::find($breakEnd['id'])->update($breakEnd);

        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();

        return view('index', compact('user', 'now', 'work'));
    }

    public function workEnd(Request $request) {
        $workEnd = $request->only(['id', 'work_start', 'work_end', 'break_time']);
        $laborStart = new Carbon($workEnd['work_start']);
        $laborEnd = new Carbon($workEnd['work_end']);
        $restTime = new Carbon($workEnd['break_time']);

        $laborTime = $laborStart->diffInSeconds($laborEnd);
        $hours = floor($laborTime / 3600);
        $minutes = floor(($laborTime % 3600) / 60);
        $seconds = $laborTime % 60;
        $laborFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        if($workEnd['break_time'] == '00:00:00') {
            $workFormat = $laborFormat;
        }else{
            $workTime = $restTime->diffInSeconds($laborFormat);
            $hours = floor($workTime / 3600);
            $minutes = floor(($workTime % 3600) / 60);
            $seconds = $workTime % 60;
            $workFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        $workEnd['work_time'] = $workFormat;
        Time::find($workEnd['id'])->update($workEnd);

        $user = Auth::user();
        $now = Carbon::now();

        return view('index', compact('user', 'now'));
    }

    public function attendance() {
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $workTables = Time::with('User')->where('date', $yesterday)->paginate(5);
        $workDate = $workTables->first();

        $subBase = new Carbon($yesterday);
        $addBase = new Carbon($yesterday);
        $subDate = $subBase->subDay()->format('Y-m-d');
        $addDate = $addBase->addDay()->format('Y-m-d');

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }

    public function searchSub(Request $request) {
        $searchSub = $request->only(['subDay', 'today']);

        if($request->has('search')) {
            $sub = new Carbon($searchSub['subDay']);
        }else{
            $sub = new Carbon($searchSub['today']);
        }

        $sub->format('Y-m-d');
        $workTables = Time::with('User')->where('date', $sub)->paginate(5);
        $workDate = $workTables->first();

        $subBase = new Carbon($workDate['date']);
        $addBase = new Carbon($workDate['date']);

        $subDate = $subBase->subDay()->format('Y-m-d');
        $addDate = $addBase->addDay()->format('Y-m-d');

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }

    public function searchAdd(Request $request) {
        $searchAdd = $request->only(['addDay', 'today']);

        if($request->has('search')) {
            $add = new Carbon($searchAdd['addDay']);
        }else{
            $add = new Carbon($searchAdd['today']);
        }

        $add->format('Y-m-d');
        $workTables = Time::with('User')->where('date', $add)->paginate(5);
        $workDate = $workTables->first();

        $subBase = new Carbon($workDate['date']);
        $addBase = new Carbon($workDate['date']);

        $subDate = $subBase->subDay()->format('Y-m-d');
        $addDate = $addBase->addDay()->format('Y-m-d');

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }
}
