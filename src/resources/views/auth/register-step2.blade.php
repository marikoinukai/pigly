<h1>STEP2 体重データの入力</h1>

<form method="POST" action="{{ url('/register/step2') }}">
  @csrf

  <div>
    <label>現在の体重</label>
    <input type="number" step="0.1" name="current_weight" value="{{ old('current_weight') }}"> kg
  </div>

  <div>
    <label>目標の体重</label>
    <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}"> kg
  </div>

  <button type="submit">アカウント作成</button>
</form>
