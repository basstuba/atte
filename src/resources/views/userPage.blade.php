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
    <div>
        <div class="search-item__sub">
            <form class="search-form" action="" method="get">
                <input type="hidden" name="subMonth" value=""><!--ここに先月が入る-->
                <input type="hidden" name="thisMonth" value=""><!--ここに今月が入る-->
                <button class="search-button"  name="search" type="submit">&lt;</button>
            </form>
        </div>
        <div class="search-date">
            <!--ここに今月が入る-->
        </div>
        <div class="search-item__add">
            <form class="search-form" action="" method="get">
                <input type="hidden" name="addMonth" value=""><!--ここに翌月が入る-->
                <input type="hidden" name="thisMonth" value=""><!--ここに今月が入る-->
                <button class="search-button"  name="search" type=submit>&gt;</button>
            </form>
        </div>
    </div>
    <div>
        <table>
            <tr>
                <th>勤務日</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
            <!--ここにフォーイーチが入る-->
            <tr>
                <td>4月1日</td>
                <td>10:00:00</td>
                <td>18:00:00</td>
                <td>01:00:00</td>
                <td>
                    <a class="modal-link" href="#">詳細</a><!--hrefの#の後にidが入る-->
                </td>
                <td>07:00:00</td>
            </tr>
            <div class="modal" id=""><!--詳細と同じ値が入る-->
                <a href="#">閉じる</a>
                <table>
                    <tr>
                        <th>休憩開始</th>
                        <th>休憩終了</th>
                        <th>休憩時間</th>
                    </tr>
                    <!--ここにフォーイーチが入る-->
                    <tr>
                        <td>11:00:00</td><!--closedsテーブルから休憩開始時間-->
                        <td>12:00:00</td><!--closedsテーブルから休憩終了時間-->
                        <td>01:00:00</td><!--closedsテーブルから休憩時間-->
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