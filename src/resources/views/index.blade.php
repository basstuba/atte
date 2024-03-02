extends('layouts.app')

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
        <!--"ログインユーザー"さんお疲れ様です！と表示するように作成。CSSコーディング後下記は削除-->
        "ログインユーザー"さんお疲れ様です！
    </div>
    <div class="main-content">
        <div class="main-content__work-start">
            <form class="form__work-start" action="/work/start" method="post">
                @csrf
                <input type="hidden"><!--ログインしているユーザーのuser_id-->
                <input type="hidden"><!--現在の日付-->
                <input type="hidden"><!--出勤時間-->
                <button class="form__work-start--button" type="submit">勤務開始</button>
            </form>
        </div>
        <div class="main-content__break-start">
            <form class="form__break-start" action="/break/start" method="post">
                @csrf
                <input type="hidden"><!--休憩開始時間-->
                <button class="form__break-start--button" type="submit">休憩開始</button>
            </form>
        </div>
        <div class="main-content__break-end">
            <form class="form__break-end" action="/break/end" method="post">
                @csrf
                <input type="hidden"><!--休憩開始時間-->
                <input type="hidden"><!--休憩終了時間-->
                <button class="form__break-end--button" type="submit">休憩終了</button>
            </form>
        </div>
        <div class="main-content__work-end">
            <form class="form__work-end" action="/work/end" method="post">
                @csrf
                <input type="hidden"><!--ログインしているユーザーのuser_id-->
                <input type="hidden"><!--出勤の日付-->
                <input type="hidden"><!--出勤時間-->
                <input type="hidden"><!--退勤時間-->
                <input type="hidden"><!--休憩時間-->
                <button class="form__work-end--button" type="submit">勤務終了</button>
            </form>
        </div>
    </div>
</div>
@endsection