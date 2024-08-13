<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Time;
use Carbon\Carbon;

class DailyController extends Controller
{
    public function attendance() {
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $workTables = Time::with('User')->where('date', $yesterday)->paginate(5);
        if(!empty($workTables['id'])) {
            $workDate = $workTables->first();
        }else{
            $workDate['date'] = $yesterday;
        }

        $subDate = Time::getPreviousDate($yesterday);
        $addDate = Time::getNextDate($yesterday);

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }

    public function searchSub(Request $request) {
        $searchSub = $request->only(['subDay', 'today']);

        if($request->has('search')) {
            $sub = new Carbon($searchSub['subDay']);
        }else{
            $sub = new Carbon($searchSub['today']);
        }

        $workTables = Time::with('User')->where('date', $sub)->paginate(5);
        $workDate['date'] = $sub->format('Y-m-d');

        $subDate = Time::getPreviousDate($workDate['date']);
        $addDate = Time::getNextDate($workDate['date']);

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }

    public function searchAdd(Request $request) {
        $searchAdd = $request->only(['addDay', 'today']);

        if($request->has('search')) {
            $add = new Carbon($searchAdd['addDay']);
        }else{
            $add = new Carbon($searchAdd['today']);
        }

        $workTables = Time::with('User')->where('date', $add)->paginate(5);
        $workDate['date'] = $add->format('Y-m-d');

        $subDate = Time::getPreviousDate($workDate['date']);
        $addDate = Time::getNextDate($workDate['date']);

        return view('attendance', compact('workTables', 'workDate', 'subDate', 'addDate'));
    }
}
