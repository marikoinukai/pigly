<h1>STEP1 アカウント情報の登録</h1>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li style="color:red">{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form method="POST" action="{{ url('/register/step1') }}">
  @csrf

  <div>
    <label>お名前</label>
    <input type="text" name="name" value="{{ old('name') }}">
  </div>

  <div>
    <label>メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}">
  </div>

  <div>
    <label>パスワード</label>
    <input type="password" name="password">
  </div>

  <div>
    <label>パスワード（確認）</label>
    <input type="password" name="password_confirmation">
  </div>

  <button type="submit">次に進む</button>

  <div style="margin-top:10px;">
    <a href="{{ url('/login') }}">ログインはこちら</a>
  </div>
</form>
