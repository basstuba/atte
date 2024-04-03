@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userPage.css') }}"/>
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
    <div class="user-name">
        山本太郎<!--ユーザーの名前が入る-->
    </div>
    <div class="search">
        <div class="search-item__sub">
            <form class="search-form" action="/page/month/sub" method="get">
                <input type="hidden" name="subMonth" value=""><!--ここに先月が入る-->
                <input type="hidden" name="thisMonth" value=""><!--ここに今月が入る-->
                <button class="search-button" name="search" type="submit">&lt;</button>
            </form>
        </div>
        <div class="search-date">
            <!--ここに今月が入る-->
        </div>
        <div class="search-item__add">
            <form class="search-form" action="/page/month/add" method="get">
                <input type="hidden" name="addMonth" value=""><!--ここに翌月が入る-->
                <input type="hidden" name="thisMonth" value=""><!--ここに今月が入る-->
                <button class="search-button" name="search" type=submit>&gt;</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <table class="first-table">
            <tr class="first-tr">
                <th class="first-th">勤務日</th>
                <th class="first-th">勤務開始</th>
                <th class="first-th">勤務終了</th>
                <th class="first-th">休憩時間</th>
                <th class="first-th">勤務時間</th>
            </tr>
            <!--ここにフォーイーチが入る-->
            <tr class="first-tr">
                <td class="first-td">4月1日</td>
                <td class="first-td">10:00:00</td>
                <td class="first-td">18:00:00</td>
                <td class="first-td">01:00:00</td>
                <td class="first-td">
                    <a class="modal-link" href="#">詳細</a><!--hrefの#の後にidが入る-->
                </td>
                <td class="first-td">07:00:00</td>
            </tr>
            <div class="modal" id=""><!--詳細と同じ値が入る-->
                <a class="close-button" href="#">閉じる</a>
                <table class="second-table">
                    <tr class="second-tr">
                        <th class="second-th">休憩開始</th>
                        <th class="second-th">休憩終了</th>
                        <th class="second-th">休憩時間</th>
                    </tr>
                    <!--ここにフォーイーチが入る-->
                    <tr class="second-tr">
                        <td class="second-td">11:00:00</td><!--closedsテーブルから休憩開始時間-->
                        <td class="second-td">12:00:00</td><!--closedsテーブルから休憩終了時間-->
                        <td class="second-td">01:00:00</td><!--closedsテーブルから休憩時間-->
                    </tr>
                    <!--ここにエンドフォーイーチが入る-->
                </table>
            </div>
            <!--ここにエンドフォーイーチが入る-->
        </table>
    </div>
    <div class="pagination">
        <!--ここにページネーションが入る-->
    </div>
</div>