@extends('layouts.app')
@section('body_class', 'dashboard')
@section('title', '体重編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<header class="dash-header">
  <div class="dash-logo">PiGLy</div>

  <div class="dash-actions">
    <a class="dash-btn" href="{{ route('weight_targets.edit') }}">目標体重設定</a>
  </div>
</header>

<div class="app-main edit-page">
  <div class="app-container">
    <div class="card">
        
      <h1 class="card-title">Weight Log</h1>

      <form action="{{ route('weight_logs.update', $weightLog) }}" method="POST">
        @csrf

        <div class="form-group">
          <label class="form-label">日付</label>
          <input class="form-input" type="date" name="date" value="{{ old('date', $weightLog->date) }}">
        @error('date') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">体重</label>
          <div class="input-unit  input-unit--outer">
          <input class="form-input" 
            type="text"
            name="weight"
            placeholder="50.0"
            value="{{ old('weight', $weightLog->weight) }}"
          >
          <span class="unit-text">kg</span>
        </div>  
        @error('weight') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">摂取カロリー</label>
          <div class="input-unit input-unit--outer">
            <input class="form-input"
              type="text"
              name="calories"
              placeholder="1200"
              value="{{ old('calories', $weightLog->calories) }}">
            <span class="unit-text">cal</span>
          </div>
        @error('calories') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">運動時間</label>
          <input class="form-input" 
            type="text"
            name="exercise_duration"
            placeholder="00:00"
            value="{{ old('exercise_duration', $weightLog->exercise_time ? \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i') : '') }}"
          >
        @error('exercise_duration') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label">運動内容</label>
          <textarea class="form-input"  name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
        @error('exercise_content') <p class="modal-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
          <a class="btn btn-ghost" href="{{ route('weight_logs.index') }}">戻る</a>
          <button class="btn btn-primary" type="submit">更新</button>

          <form class="delete-form" action="/weight_logs/{{ $weightLog->id }}/delete" method="POST">
            @csrf
            <button class="delete-btn" type="submit" aria-label="削除">🗑</button>
          </form>
        </div>
     </div>
  </div>
</div>
@endsection