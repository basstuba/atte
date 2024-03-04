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
                <input type="text" name="user_id" value="{{ $user['id'] }}"><!--ログインしているユーザーのuser_id-->
                <input type="text" name="date" value="{{ $now->format('Y-m-d') }}"><!--現在の日付-->
                <input type="text" name="work_start" value="{{ $now->format('H:i:s') }}"><!--出勤時間-->
                <button class="form__work-start--button" type="submit">勤務開始</button>
            </form>
        </div>
        <div class="main-content__break-start">
            <form class="form__break-start" action="/break/start" method="post">
                @csrf
                <input type="text" name="break_start" value="{{ $now->format('H:i:s') }}"><!--休憩開始時間-->
                <button class="form__break-start--button" type="submit">休憩開始</button>
            </form>
        </div>
        <div class="main-content__break-end">
            <form class="form__break-end" action="/break/end" method="post">
                @csrf
                <input type="text"><!--休憩開始時間-->
                <input type="text" name="break_end" value="{{ $now->format('H:i:s') }}"><!--休憩終了時間-->
                <button class="form__break-end--button" type="submit">休憩終了</button>
            </form>
        </div>
        <div class="main-content__work-end">
            <form class="form__work-end" action="/work/end" method="post">
                @csrf
                <input type="text" name="id" value="{{ $workStart['id'] ?? 'null' }}">
                <input type="text" name="user_id" value="{{ $workStart['user_id'] ?? 'null'}}"><!--ログインしているユーザーのuser_id-->
                <input type="text" name="date" value="{{ $workStart['date'] ?? 'null'}}"><!--出勤の日付-->
                <input type="text" name="work_start" value="{{ $workStart['work_start'] ?? 'null'}}"><!--出勤時間-->
                <input type="text" name="work_end" value="{{ $now->format('H:i:s') }}"><!--退勤時間-->
                <input type="text"><!--休憩時間-->
                <button class="form__work-end--button" type="submit">勤務終了</button>
            </form>
        </div>
    </div>
</div>
@endsection