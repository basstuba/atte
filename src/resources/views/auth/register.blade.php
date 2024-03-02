@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="main-title">
        <h2 class="main-title__logo">会員登録</h2>
    </div>
    <div class="main-content">
        <form class="form" action="/register" method="post">
            @csrf
            <div class="main-content__item">
                <input class="main-content__item-input" type="text" name="name" value="{{ old('name') }}" placeholder="名前"/>
                <div class="main-content__item-error">
                    @error('name')
                        {{ $message }}
                    @enderror
                    エラーメッセージ<!--cssのコーディングが終わったら削除-->&emsp;
                </div>
            </div>
            <div class="main-content__item">
                <input class="main-content__item-input" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス"/>
                <div class="main-content__item-error">
                    @error('email')
                        {{ $message }}
                    @enderror
                    エラーメッセージ<!--cssのコーディングが終わったら削除-->&emsp;
                </div>
            </div>
            <div class="main-content__item">
                <input class="main-content__item-input" type="password" name="password" placeholder="パスワード"/>
                <div class="main-content__item-error">
                    @error('password')
                        {{ $message }}
                    @enderror
                    エラーメッセージ<!--cssのコーディングが終わったら削除-->&emsp;
                </div>
            </div>
            <div class="main-content__item">
                <input class="main-content__item-input" type="password" name="password_confirmation" placeholder="確認用パスワード"/>
                <div class="main-content__item-error">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                    エラーメッセージ<!--cssのコーディングが終わったら削除-->&emsp;
                </div>
            </div>
            <div class="main-content__button">
                <button class="main-content__button-submit" type="submit">会員登録</button>
            </div>
        </form>
    </div>
    <div class="main-text">アカウントをお持ちの方はこちらから</div>
    <div class="main-link">
        <a class="main-link__login" href="/login">ログイン</a>
    </div>
</div>
@endsection