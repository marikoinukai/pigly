@extends('layouts.app')


@section('content')
<h1>体重管理画面</h1>

@if($logs->isEmpty())
<p>まだ記録がありません。</p>
@else
    <ul>
        @foreach($logs as $log)
            <li>{{ $log->date }}：{{ $log->weight }}kg（{{ $log->calories }}kcal）</li>
        @endforeach
    </ul>
@endif
@endsection

<h3>体重を登録</h3>

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
    <input type="date" name="date">
  </div>

  <div>
    <label>体重 (kg)</label>
    <input type="number" step="0.1" name="weight">
  </div>

  <div>
    <label>摂取カロリー</label>
    <input type="number" name="calories">
  </div>

  <div>
    <label>運動時間</label>
    <input type="time" name="exercise_time">
  </div>

  <div>
    <label>運動内容</label>
    <textarea name="exercise_content"></textarea>
  </div>

  <button type="submit">登録</button>
</form>