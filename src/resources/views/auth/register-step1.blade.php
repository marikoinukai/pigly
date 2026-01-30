@extends('layouts.app')

@section('content')
<div class="auth-card">
  <div class="auth-logo">PiGLy</div>
  <h1 class="auth-title">新規会員登録</h1>
  <p class="auth-step">STEP1 アカウント情報の登録</p>

  <form class="auth-form" method="POST" action="{{ url('/register/step1') }}">
    @csrf

    <div class="form-group">
      <label class="form-label" for="name">お名前</label>
      <input id="name" class="form-input @error('name') is-invalid @enderror"
             type="text" name="name" value="{{ old('name') }}" placeholder="お名前入力">
      @error('name')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="email">メールアドレス</label>
      <input id="email" class="form-input @error('email') is-invalid @enderror"
             type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
      @error('email')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="password">パスワード</label>
      <input id="password" class="form-input @error('password') is-invalid @enderror"
             type="password" name="password" placeholder="パスワードを入力">
      @error('password')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <button class="btn-primary" type="submit">次に進む</button>
    <a class="auth-link" href="{{ route('login') }}">ログインはこちら</a>
  </form>
</div>
@endsection
