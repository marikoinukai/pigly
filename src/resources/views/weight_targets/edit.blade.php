@extends('layouts.app')

{{-- 編集画面と同じ背景にしたいなら edit-bg も付ける --}}
@section('body_class', 'dashboard edit-bg')
@section('title', '目標体重設定')

@section('header')
  @include('components.dashboard-header')
@endsection

@section('content')
<div class="app-main edit-page goal-page">
  <div class="app-container">
    <div class="card">

      <h1 class="card-title"">目標体重設定</h1>

      <form action="{{ route('weight_targets.update') }}" method="POST">
        @csrf
        {{-- ルートがPUTなら @method('PUT') を入れる --}}
        {{-- @method('PUT') --}}

        <div class="form-group">
          <div class="input-unit input-unit--outer">
            <input class="form-input"
              type="text"
              name="target_weight"
              placeholder="50.0"
              value="{{ old('target_weight', $target?->target_weight) }}"
            >
            <span class="unit-text">kg</span>
          </div>

          @error('target_weight')
            <p class="modal-error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-actions">
          <a class="btn btn-ghost" href="{{ route('weight_logs.index') }}">戻る</a>
          <button class="btn btn-primary" type="submit">更新</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection