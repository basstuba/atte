<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Time;
use App\Models\User;
use Carbon\Carbon;

class AllUserController extends Controller
{
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
