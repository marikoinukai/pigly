@extends('layouts.app')

@section('content')
<div class="auth-card">
  <div class="auth-logo">PiGLy</div>
  <h1 class="auth-title">初期体重登録</h1>
  <p class="auth-step">STEP2 体重データの入力</p>

  <form class="auth-form" method="POST" action="{{ url('/register/step2') }}">
    @csrf

    <div class="form-group">
      <label class="form-label" for="current_weight">現在の体重</label>
      <div class="form-row">
        <input
          id="current_weight"
          class="form-input @error('current_weight') is-invalid @enderror"
          type="number"
          step="0.1"
          name="current_weight"
          value="{{ old('current_weight') }}"
          placeholder="現在の体重を入力"
        >
        <span class="form-unit">kg</span>
      </div>
      @error('current_weight')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="target_weight">目標の体重</label>
      <div class="form-row">
        <input
          id="target_weight"
          class="form-input @error('target_weight') is-invalid @enderror"
          type="number"
          step="0.1"
          name="target_weight"
          value="{{ old('target_weight') }}"
          placeholder="目標の体重を入力"
        >
        <span class="form-unit">kg</span>
      </div>
      @error('target_weight')
        <p class="form-error">{{ $message }}</p>
      @enderror
    </div>

    <button class="btn-primary" type="submit">アカウント作成</button>
  </form>
</div>
@endsection
