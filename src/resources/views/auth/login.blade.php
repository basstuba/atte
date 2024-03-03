@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="main-title">
        <h2 class="main-title__logo">ログイン</h2>
    </div>
    <div class="main-content">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="main-content__item">
                <input class="main-content__item-input" type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
                <div class="main-content__item-error">
                    @error('email')
                        {{ $message }}
                    @enderror
                    &emsp;
                </div>
            </div>
            <div class="main-content__item">
                <input class="main-content__item-input" type="password" name="password" placeholder="パスワード">
                <div class="main-content__item-error">
                    @error('password')
                        {{ $message }}
                    @enderror
                    &emsp;
                </div>
            </div>
            <div class="main-content__button">
                <button class="main-content__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
    <div class="main-text">アカウントをお持ちでない方はこちらから</div>
    <div class="main-link">
        <a class="main-link__register" href="/register">会員登録</a>
    </div>
</div>
@endsection