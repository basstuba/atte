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
        <table>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
            @foreach($workTables as $workTable)
            <tr>
                <td>{{ $workTable['user']['name'] }}</td>
                <td>{{ $workTable['work_start'] }}</td>
                <td>{{ $workTable['work_end'] }}</td>
                <td>{{ $workTable['total_break'] }}</td>
                <td>{{ $workTable['work_time'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{ $workTables->appends(['subDay' => $subDate, 'addDay' => $addDate, 'today' => $workDate['date']])->links() }}
    </div>
</div>
@endsection