@extends('layouts.app')

@section('content')
<div class="auth-card">
  <div class="auth-logo">PiGLy</div>
  <h1 class="auth-title">ログイン</h1>

  <form class="auth-form" method="POST" action="{{ route('login') }}" novalidate>
    @csrf

    <div class="form-group">
  <label class="form-label" for="email">メールアドレス</label>
  <input
    id="email"
    class="form-input @error('email') is-invalid @enderror"
    type="email"
    name="email"
    value="{{ old('email') }}"
    placeholder="メールアドレスを入力"
    autocomplete="email"
  >
  @error('email')
    <p class="form-error">{{ $message }}</p>
  @enderror
</div>

<div class="form-group">
  <label class="form-label" for="password">パスワード</label>
  <input
    id="password"
    class="form-input @error('password') is-invalid @enderror"
    type="password"
    name="password"
    placeholder="パスワードを入力"
    autocomplete="current-password"
  >
  @error('password')
    <p class="form-error">{{ $message }}</p>
  @enderror
</div>

    <button class="btn-primary" type="submit">ログイン</button>

    <a class="auth-link" href="{{ route('register.step1') }}">アカウント作成はこちら</a>
  </form>
</div>
@endsection
