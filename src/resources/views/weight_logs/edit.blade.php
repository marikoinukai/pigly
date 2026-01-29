@extends('layouts.app')
@section('body_class', 'dashboard')
@section('title', '体重編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<div class="app-main edit-page">
  <div class="app-container">
    <div class="card">
        
      <h1 class="card-title">体重編集</h1>

      <form action="{{ route('weight_logs.update', $weightLog) }}" method="POST">
        @csrf

        <div class="form-group">
          <label>日付</label>
          <input type="date" name="date" value="{{ old('date', $weightLog->date) }}">
        @error('date') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label>体重 (kg)</label>
          <input
            type="text"
            name="weight"
            placeholder="50.0"
            value="{{ old('weight', $weightLog->weight) }}"
          >
        @error('weight') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label>摂取カロリー</label>
          <input
            type="text"
            name="calories"
            placeholder="1200"
            value="{{ old('calories', $weightLog->calories) }}"
          >
        @error('calories') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label>運動時間</label>
          <input
            type="text"
            name="exercise_duration"
            placeholder="例：01:30"
            value="{{ old('exercise_duration', $weightLog->exercise_time ? \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i') : '') }}"
          >
        @error('exercise_duration') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label>運動内容</label>
          <textarea name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        @error('exercise_content') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
          <a class="btn btn-ghost" href="{{ route('weight_logs.index') }}">戻る</a>
          <button class="btn btn-primary" type="submit">更新</button>
        </div>
      </form>

        <form class="delete-form" action="/weight_logs/{{ $weightLog->id }}/delete" method="POST">
          @csrf
          <button class="delete-btn" type="submit" aria-label="削除">🗑</button>
        </form>
     </div>
  </div>
</div>
@endsection