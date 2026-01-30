@extends('layouts.app')

@section('content')
<div class="app-main">
  <div class="app-container">
    <div class="card">
      <h1 class="card-title">ログイン</h1>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">メールアドレス</label>
          <input class="form-input" type="email" name="email" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label">パスワード</label>
          <input class="form-input" type="password" name="password" required>
        </div>

        <button class="btn btn-primary" type="submit">ログイン</button>
      </form>
    </div>
  </div>
</div>
@endsection
