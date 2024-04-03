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
        <form class="search-form" action="search" method="get">
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
        <table>
            <tr>
                <th>名前</th>
            </tr>
            <!--ここにフォーイーチが入る-->
            <tr>
                <td>山本太郎</td><!--userテーブルから名前を呼び出し-->
                <td>
                    <form class="table-form" action="/user/list" method="post">
                        @csrf
                        <input type="hidden" name="id" value=""><!--valueにidが入る-->
                        <button class="table-form__button" type="submit">勤怠確認</button>
                    </form>
                </td>
            </tr>
            <!--ここにエンドフォーイーチが入る-->
        </table>
    </div>
    <div class="pagination">
        <!--ここにページネーションが入る-->
    </div>
</div>
@endsection