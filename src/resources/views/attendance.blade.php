@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}"/>
@endsection

@section('nav')
<nav class="header-nav">
    <div class="header-nav__item">
        <a class="header-nav__item-link" href="{{ route('index') }}">ホーム</a>
    </div>
    <div class="header-nav__item">
        <a class="header-nav__item-link" href="{{ route('attendance') }}">日付一覧</a>
    </div>
    <div class="header-nav__item">
        <a class="header-nav__item-link" href="{{ route('allUser') }}">社員一覧</a>
    </div>
    <div class="header-nav__item">
        <form class="form-logout" action="/logout" method="post">
            @csrf
            <button class="form-logout__button" type="submit">ログアウト</button>
        </form>
    </div>
</nav>
@endsection

@section('content')
<div class="main">
    <div class="search">
        <div class="search-item__sub">
            <form class="search-form" action="/attendance/search/sub" method="get">
                <input type="hidden" name="subDay" value="{{ $subDate }}">
                <input type="hidden" name="today" value="{{$workDate['date'] }}">
                <button class="search-button"  name="search" type="submit">&lt;</button>
            </form>
        </div>
        <div class="search-date">
            {{ $workDate['date'] }}
        </div>
        <div class="search-item__add">
            <form class="search-form" action="/attendance/search/add" method="get">
                <input type="hidden" name="addDay" value="{{ $addDate }}">
                <input type="hidden" name="today" value="{{$workDate['date'] }}">
                <button class="search-button"  name="search" type=submit>&gt;</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <table class="main-content__table">
            <tr class="main-content__tr">
                <th class="main-content__th">名前</th>
                <th class="main-content__th">勤務開始</th>
                <th class="main-content__th">勤務終了</th>
                <th class="main-content__th">休憩時間</th>
                <th class="main-content__th">勤務時間</th>
            </tr>
            @foreach($workTables as $workTable)
            <tr class="main-content__tr">
                <td class="main-content__td">{{ $workTable['user']['name'] }}</td>
                <td class="main-content__td">{{ $workTable['work_start'] }}</td>
                <td class="main-content__td">{{ $workTable['work_end'] }}</td>
                <td class="main-content__td">{{ $workTable['total_break'] }}</td>
                <td class="main-content__td">{{ $workTable['work_time'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{ $workTables->appends(['subDay' => $subDate, 'addDay' => $addDate, 'today' => $workDate['date']])->links() }}
    </div>
</div>
@endsection