@extends('layouts.app')


@section('content')

<p><a href="{{ route('weight_logs.create') }}">体重を登録する</a></p>

<p><a href="{{ route('weight_targets.edit') }}">目標体重を設定</a></p>

<h1>体重管理画面</h1>

@if($target)
<p>目標体重：{{ $target->target_weight }} kg</p>
@else
<p>目標体重：未設定</p>
@endif

@if($logs->isEmpty())
<p>まだ記録がありません。</p>
@else
    <ul>
        @foreach($logs as $log)
            <li>{{ $log->date }}：{{ $log->weight }}kg（{{ $log->calories }}kcal）</li>
            
            <a href="{{ route('weight_logs.edit', $log) }}">編集</a>

            <form action="{{ route('weight_logs.destroy', $log) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <button type="submit">削除</button>
            </form>
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

