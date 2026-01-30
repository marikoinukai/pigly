@extends('layouts.app')

@section('content')
<div class="app-main">
  <div class="app-container">
    <div class="card">
      <h1 class="card-title">会員登録</h1>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <label class="form-label">名前</label>
          <input class="form-input" type="text" name="name" required>
        </div>

        <div class="form-group">
          <label class="form-label">メールアドレス</label>
          <input class="form-input" type="email" name="email" required>
        </div>

        <div class="form-group">
          <label class="form-label">パスワード</label>
          <input class="form-input" type="password" name="password" required>
        </div>

        <div class="form-group">
          <label class="form-label">パスワード（確認）</label>
          <input class="form-input" type="password" name="password_confirmation" required>
        </div>

        <button class="btn btn-primary" type="submit">登録</button>
      </form>
    </div>
  </div>
</div>
@endsection
