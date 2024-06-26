<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\User;
use App\Models\Closed;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class AtteController extends Controller
{

    public function index() {
        $user = Auth::user();
        $now = Carbon::now();

        return view('index', compact('user', 'now'));
    }

    public function workStart(Request $request) {
        $workStart = $request->only(['user_id', 'date', 'work_start']);
        Time::create($workStart);

        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        $break = Closed::orderBy('id', 'desc')->where('time_id', $work['id'])->first();

        return view('index', compact('user', 'now', 'work', 'break'));
    }

    public function breakStart(Request $request) {
        $breakStart = $request->only(['time_id', 'break_start']);
        Closed::create($breakStart);

        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        $break = Closed::orderBy('id', 'desc')->where('time_id', $work['id'])->first();

        return view('index', compact('user', 'now', 'work', 'break'));
    }

    public function breakEnd(Request $request) {
        $breakEnd = $request->only(['id','time_id', 'break_start', 'break_end']);
        $totalBreak = $request->only(['total_break']);
        $restStart = new Carbon($breakEnd['break_start']);
        $restEnd = new Carbon($breakEnd['break_end']);
        $restTimes = new Carbon($totalBreak['total_break']);

        $breakTotal = $restStart->diffInSeconds($restEnd);
        if($restTimes == '00:00:00') {
            $hours = floor($breakTotal / 3600);
            $minutes = floor(($breakTotal % 3600) / 60);
            $seconds = $breakTotal % 60;
            $breakFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            $total['total_break'] = $breakFormat;
            Time::find($breakEnd['time_id'])->update($total);

            $breakEnd['break_time'] = $breakFormat;
            Closed::find($breakEnd['id'])->update($breakEnd);
        }else{
            $breakFormat = $restTimes->addSeconds($breakTotal);

            $total['total_break'] = $breakFormat;
            Time::find($breakEnd['time_id'])->update($total);

            $hours = floor($breakTotal / 3600);
            $minutes = floor(($breakTotal % 3600) / 60);
            $seconds = $breakTotal % 60;
            $closedFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            $breakEnd['break_time'] = $closedFormat;
            Closed::find($breakEnd['id'])->update($breakEnd);
        }

        $user = Auth::user();
        $now = Carbon::now();
        $work = Time::orderBy('id', 'desc')->where('user_id', $user['id'])->first();
        $break = Closed::orderBy('id', 'desc')->where('time_id', $work['id'])->first();

        return view('index', compact('user', 'now', 'work', 'break'));
    }

    public function workEnd(Request $request) {
        $workEnd = $request->only(['id', 'work_start', 'work_end', 'total_break']);
        $laborStart = new Carbon($workEnd['work_start']);
        $laborEnd = new Carbon($workEnd['work_end']);
        $restTime = new Carbon($workEnd['total_break']);

        $laborTime = $laborStart->diffInSeconds($laborEnd);
        $hours = floor($laborTime / 3600);
        $minutes = floor(($laborTime % 3600) / 60);
        $seconds = $laborTime % 60;
        $laborFormat = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        if($workEnd['total_break'] == '00:00:00') {
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
        if(!empty($workTables['id'])) {
            $workDate = $workTables->first();
        }else{
            $workDate['date'] = $yesterday;
        }

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
        $workDate['date'] = $sub->format('Y-m-d');

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
        $workDate['date'] = $add->format('Y-m-d');

        $subBase = new Carbon($workDate['date']);
        $addBase = new Carbon($workDate['date']);
        $subDate = $subBase->subDay()->format('Y-m-d');
        $addDate = $addBase->addDay()->format('Y-m-d');

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }

    public function allUser() {
        $users = User::paginate(5);

        return view('allUser', compact('users'));
    }

    public function search(Request $request) {
        $keyword = $request->keyword;
        $users = User::where('name', 'like', '%' . $keyword . '%')->paginate(5);

        return view('allUser', compact('users'));
    }

    public function userList(Request $request) {
        $id = $request->id;
        $thisMonth = Carbon::today()->format('Y-m');
        $userName = User::where('id', $id)->first();

        $lists = Time::with('closeds')->where('user_id', $id)->Where('date', 'like', '%' . $thisMonth . '%')->paginate(5);

        $subOriginal = new Carbon($thisMonth);
        $addOriginal = new Carbon($thisMonth);
        $subMonth = $subOriginal->subMonth()->format('Y-m');
        $addMonth = $addOriginal->addMonth()->format('Y-m');

        return view('userPage', compact('lists', 'userName', 'thisMonth', 'subMonth', 'addMonth'));
    }

    public function monthSub(Request $request) {
        $searchSubMonth = $request->only(['subMonth', 'thisMonth']);
        $id = $request->only(['id']);
        $userName = User::where('id', $id)->first();

        if($request->has('search')) {
            $thisMonth = $searchSubMonth['subMonth'];
        }else{
            $thisMonth = $searchSubMonth['thisMonth'];
        }

        $lists = Time::with('closeds')->where('user_id', $id)->Where('date', 'like', '%' . $thisMonth . '%')->paginate(5);

        $subOriginal = new Carbon($thisMonth);
        $addOriginal = new Carbon($thisMonth);
        $subMonth = $subOriginal->subMonth()->format('Y-m');
        $addMonth = $addOriginal->addMonth()->format('Y-m');

        return view('userPage', compact('lists', 'userName', 'thisMonth', 'subMonth', 'addMonth'));
    }

    public function monthAdd(Request $request) {
        $searchAddMonth = $request->only(['addMonth', 'thisMonth']);
        $id = $request->only(['id']);
        $userName = User::where('id', $id)->first();

        if($request->has('search')) {
            $thisMonth = $searchAddMonth['addMonth'];
        }else{
            $thisMonth = $searchAddMonth['thisMonth'];
        }

        $lists = Time::with('closeds')->where('user_id', $id)->Where('date', 'like', '%' . $thisMonth . '%')->paginate(5);

        $subOriginal = new Carbon($thisMonth);
        $addOriginal = new Carbon($thisMonth);
        $subMonth = $subOriginal->subMonth()->format('Y-m');
        $addMonth = $addOriginal->addMonth()->format('Y-m');

        return view('userPage', compact('lists', 'userName', 'thisMonth', 'subMonth', 'addMonth'));
    }
}
