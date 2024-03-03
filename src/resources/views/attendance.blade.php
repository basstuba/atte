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
                <input type="hidden"><!--class="search-date"で表示される日付の前日-->
                <button class="search-button" type="submit">&lt;</button>
            </form>
        </div>
        <div class="search-date">
            <!--デフォルトは当日の日付だが検索で得た日付を表示-->
            2024-03-03<!--表示するように出来た後に削除-->
        </div>
        <div class="search-item__add">
            <form class="search-form" action="/attendance/search/add" method="get">
                <input type="hidden"><!--class="search-date"で表示される日付の翌日-->
                <button class="search-button" type=submit>&gt;</button>
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
            <!--ここにforeachが入る-->
            <tr>
                <td>テスト太郎</td><!--user-idで紐付けされている名前。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>10:00:00</td><!--work_startの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>20:00:00</td><!--work_endの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>00:30:00</td><!--break_timeの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>09:30:00</td><!--work_endからwork_startとbreak_timeを差し引いた値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
            </tr>
            <!--ここにendforeachが入る-->
            <tr>
                <td>テスト太郎</td><!--user-idで紐付けされている名前。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>10:00:00</td><!--work_startの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>20:00:00</td><!--work_endの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>00:30:00</td><!--break_timeの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>09:30:00</td><!--work_endからwork_startとbreak_timeを差し引いた値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
            </tr>
            <tr>
                <td>テスト太郎</td><!--user-idで紐付けされている名前。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>10:00:00</td><!--work_startの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>20:00:00</td><!--work_endの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>00:30:00</td><!--break_timeの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>09:30:00</td><!--work_endからwork_startとbreak_timeを差し引いた値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
            </tr>
            <tr>
                <td>テスト太郎</td><!--user-idで紐付けされている名前。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>10:00:00</td><!--work_startの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>20:00:00</td><!--work_endの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>00:30:00</td><!--break_timeの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>09:30:00</td><!--work_endからwork_startとbreak_timeを差し引いた値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
            </tr>
            <tr>
                <td>テスト太郎</td><!--user-idで紐付けされている名前。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>10:00:00</td><!--work_startの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>20:00:00</td><!--work_endの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>00:30:00</td><!--break_timeの値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
                <td>09:30:00</td><!--work_endからwork_startとbreak_timeを差し引いた値。td内はcssコーディング後ダミーデータでのテスト時に削除-->
            </tr>
        </table>
    </div>
    <div class="pagination">
        <!--ここにpaginationが入る-->
        |&lsaquo;|1|2|3|4|5|6|7|8|9|10|&rsaquo;|<!--cssコーディング後ページネーション実装時に削除-->
    </div>
</div>
@endsection