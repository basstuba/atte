@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/allUser.css') }}"/>
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
    <div class="main-title">
        <h2 class="main-title__logo">社員一覧</h2>
    </div>
    <div class="search">
        <form class="search-form" action="/search" method="get">
            @csrf
            <div class="search-item">
                <input class="search-item__input" type="text" name="keyword" placeholder="名前を入力してください">
            </div>
            <div class="search-button">
                <button class="search-button__submit" type="submit">検索</button>
            </div>
        </form>
    </div>
    <div class="main-content">
        <table class="main-content__table">
            <tr class="main-content__tr">
                <th class="main-content__th">名前</th>
            </tr>
            @foreach($users as $user)
            <tr class="main-content__tr">
                <td class="main-content__td">{{ $user['name'] }}</td>
                <td class="main-content__td">
                    <a class="table-link__button" href="{{ route('userList', ['user' => $user['id']]) }}">勤怠確認</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{ $users->appends(['keyword' => request('keyword')])->links() }}
    </div>
</div>
@endsection