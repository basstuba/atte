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
        {{ $userName['name'] }}
    </div>
    <div class="search">
        <div class="search-item__sub">
            <form class="search-form" action="/page/month/sub" method="get">
                <input type="hidden" name="user" value="{{ $userName['id'] }}">
                <input type="hidden" name="subMonth" value="{{ $subMonth }}">
                <input type="hidden" name="thisMonth" value="{{ $thisMonth }}">
                <button class="search-button" name="search" type="submit">&lt;</button>
            </form>
        </div>
        <div class="search-date">
            {{ date('Y年m月度', strtotime($thisMonth)) }}
        </div>
        <div class="search-item__add">
            <form class="search-form" action="/page/month/add" method="get">
                <input type="hidden" name="user" value="{{ $userName['id'] }}">
                <input type="hidden" name="addMonth" value="{{ $addMonth }}">
                <input type="hidden" name="thisMonth" value="{{ $thisMonth }}">
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
                <th class="first-th__break">休憩時間</th>
                <th class="first-th__space">&emsp;</th>
                <th class="first-th__work">勤務時間</th>
            </tr>
            @foreach($lists as $list)
            <tr class="first-tr">
                <td class="first-td">{{ date('m月d日', strtotime($list['date'])) }}</td>
                <td class="first-td">{{ $list['work_start'] }}</td>
                <td class="first-td">{{ $list['work_end'] }}</td>
                <td class="first-td__break">{{ $list['total_break'] }}</td>
                <td class="first-td__detail">
                    <a class="modal-link" href="#{{ $list['id'] }}">詳細</a>
                </td>
                <td class="first-td__work">{{ $list['work_time'] }}</td>
            </tr>
            @endforeach
        </table>
        @foreach($lists as $list)
        <div class="modal" id="{{ $list['id'] }}">
            <div class="modal-close">
                <a class="close-button" href="#">閉じる</a>
            </div>
            <table class="second-table">
                <tr class="second-tr">
                    <th class="second-th">休憩開始</th>
                    <th class="second-th">休憩終了</th>
                    <th class="second-th">休憩時間</th>
                </tr>
                @foreach($list->closeds as $closed)
                <tr class="second-tr">
                    <td class="second-td">{{ $closed['break_start'] }}</td>
                    <td class="second-td">{{ $closed['break_end'] }}</td>
                    <td class="second-td">{{ $closed['break_time'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endforeach
    </div>
    <div class="pagination">
        {{ $lists->appends(['subMonth'=>$subMonth, 'addMonth'=>$addMonth, 'thisMonth'=>$thisMonth, 'user'=>$userName['id']])->links() }}
    </div>
</div>
@endsection