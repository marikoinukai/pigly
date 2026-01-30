@extends('layouts.app')

@section('content')
<div class="auth-card">
  <div class="auth-logo">PiGLy</div>
  <h1 class="auth-title">ログイン</h1>

  <form class="auth-form" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label class="form-label" for="email">メールアドレス</label>
      <input
        id="email"
        class="form-input
          @error('email') is-invalid @enderror
          @error('email','login') is-invalid @enderror"
        type="email"
        name="email"
        value="{{ old('email') }}"
        placeholder="メールアドレスを入力"
        autocomplete="email"
      >

      {{-- email のエラー（通常 / login 両方） --}}
      @error('email')
        <p class="form-error">{{ $message }}</p>
      @enderror
      @error('email','login')
        <p class="form-error">{{ $message }}</p>
      @enderror

      {{-- 認証失敗が password 側に入ることがあるので、見本寄せで email 下にも出す --}}
      @error('password')
        <p class="form-error">{{ $message }}</p>
      @enderror
      @error('password','login')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="password">パスワード</label>
      <input
        id="password"
        class="form-input
          @error('password') is-invalid @enderror
          @error('password','login') is-invalid @enderror"
        type="password"
        name="password"
        placeholder="パスワードを入力"
        autocomplete="current-password"
      >

      {{-- password のエラー（通常 / login 両方） --}}
      @error('password')
        <p class="form-error">{{ $message }}</p>
      @enderror
      @error('password','login')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <button class="btn-primary" type="submit">ログイン</button>

    <a class="auth-link" href="{{ route('register.step1') }}">アカウント作成はこちら</a>
  </form>
</div>
@endsection
