@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}"/>
@endsection

@section('content')
<div class="main">
    <div class="main-title">
        <h2 class="main-title__logo">確認用メールをお送りしました</h2>
    </div>
    <div class="main-content">
        <div class="message-again">
            @if (session('status') == 'verification-link-sent')
            確認用メールを再度お送りしました
            @endif
            &emsp;
        </div>
        <div class="message">
            メールをご確認ください。もし確認用メールが届いていない場合は、下記をクリックしてください。
        </div>
        <form class="message-form" action="/email/verification-notification" method="post">
            @csrf
            <button class="message-form__button" type="submit">確認用メールを再送信する</button>
        </form>
    </div>
</div>
@endsection