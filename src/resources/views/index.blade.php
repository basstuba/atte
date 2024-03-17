@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
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
    <div class="main-message">
        {{ $user['name'] }}さんお疲れ様です！
    </div>
    <div class="main-content">
        <div class="main-content__work-start">
            <form class="form__work-start" action="/work/start" method="post">
                @csrf
                <input type="text" name="user_id" value="{{ $user['id'] }}">
                <input type="text" name="date" value="{{ $now->format('Y-m-d') }}">
                <input type="text" name="work_start">
                @if(!empty($work['work_start']) && empty($work['work_end']))
                <div class="form__work-start--fake">勤務開始</div>
                @else
                <button class="form__work-start--button" type="submit">勤務開始</button>
                @endif
            </form>
        </div>
        <div class="main-content__break-start">
            <form class="form__break-start" action="/break/start" method="post">
                @csrf
                <input type="text" name="time_id" value="{{ $work['id'] ?? 'null' }}">
                <input type="text" name="break_start">
                @if(!empty($break['break_start']) && empty($break['break_end']))
                <div class="form__break-start--fake">休憩開始</div>
                @else
                <button class="form__break-start--button" type="submit">休憩開始</button>
                @endif
            </form>
        </div>
        <div class="main-content__break-end">
            <form class="form__break-end" action="/break/end" method="post">
                @csrf
                <input type="text" name="id" value="{{$break['id'] ?? 'null' }}">
                <input type="text" name="time_id" value="{{ $break['time_id'] ?? 'null' }}">
                <input type="text" name="break_start" value="{{ $break['break_start'] ?? 'null' }}">
                <input type="text" name="break_end">
                <input type="text" name="total_break" value="{{ $work['total_break'] ?? '00:00:00' }}">
                @if(!empty($break['break_start']) && empty($break['break_end']))
                <button class="form__break-end--button" type="submit">休憩終了</button>
                @else
                <div class="form__break-end--fake">休憩終了</div>
                @endif
            </form>
        </div>
        <div class="main-content__work-end">
            <form class="form__work-end" action="/work/end" method="post">
                @csrf
                <input type="text" name="id" value="{{ $work['id'] ?? 'null' }}">
                <input type="text" name="work_start" value="{{ $work['work_start'] ?? 'null' }}">
                <input type="text" name="work_end">
                <input type="text" name="total_break" value="{{ $work['total_break'] ?? '00:00:00' }}">
                @if(!empty($work['work_start']) && empty($work['work_end']))
                <button class="form__work-end--button" type="submit">勤務終了</button>
                @else
                <div class="form__work-end--fake">勤務終了</div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection