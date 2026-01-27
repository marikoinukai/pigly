@extends('layouts.app')

@section('content')
<h2>体重登録</h2>

@if ($errors->any())
  <ul>
    @foreach ($errors->all() as $error)
      <li style="color:red">{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form action="{{ route('weight_logs.store') }}" method="POST">
  @csrf

  <div>
    <label>日付</label>
    <input type="date" name="date" value="{{ old('date') }}">
  </div>

  <div>
    <label>体重 (kg)</label>
    <input type="number" step="0.1" name="weight" value="{{ old('weight') }}">
  </div>

  <div>
    <label>摂取カロリー</label>
    <input type="number" name="calories" value="{{ old('calories') }}">
  </div>

  <div>
    <label>運動時間</label>
    <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
  </div>

  <div>
    <label>運動内容</label>
    <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
  </div>

  <button type="submit">登録</button>
</form>

<p><a href="{{ route('weight_logs.index') }}">一覧に戻る</a></p>
@endsection