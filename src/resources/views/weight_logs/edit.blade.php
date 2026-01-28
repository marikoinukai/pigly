@extends('layouts.app')

@section('title', '商品更新')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products/edit.css') }}">
@endsection

@section('content')
<div class="card">
  
<h1 class="card-title">体重編集</h1>

@if ($errors->any())
  <ul class="error-list">
    @foreach ($errors->all() as $error)
      <li class="error-message">{{ $error }}</li>
    @endforeach
  </ul>
@endif

<form action="/weight_logs/{{ $weightLog->id }}/update" method="POST">
  @csrf

  <div class="form-group">
    <label>日付</label>
    <input type="date" name="date" value="{{ old('date', $weightLog->date) }}">
  </div>

  <div class="form-group">
    <label>体重 (kg)</label>
    <input type="number" step="0.1" name="weight" value="{{ old('weight', $weightLog->weight) }}">
  </div>

  <div class="form-group">
    <label>摂取カロリー</label>
    <input type="number" name="calories" value="{{ old('calories', $weightLog->calories) }}">
  </div>

  <div class="form-group">
    <label>運動時間</label>
    <input type="time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
  </div>

  <div class="form-group">
    <label>運動内容</label>
    <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
  </div>

  <button class="form-group" type="submit">更新</button>
</form>

<p><a href="{{ route('weight_logs.index') }}">一覧に戻る</a></p>

<form action="/weight_logs/{{ $weightLog->id }}/delete" method="POST">
  @csrf
  <button type="submit">削除</button>
</form>

@endsection