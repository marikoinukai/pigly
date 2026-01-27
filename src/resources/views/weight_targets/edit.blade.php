@extends('layouts.app')

@section('content')
<h2>目標体重設定</h2>

@if ($errors->any())
    <ul>
    @foreach ($errors->all() as $error)
        <li style="color:red">{{ $error }}</li>
    @endforeach
    </ul>
@endif

<form action="{{ route('weight_targets.update') }}" method="POST">
    @csrf

    <div>
        <label>目標体重 (kg)</label>
        <input type="number" step="0.1" name="target_weight"
            value="{{ old('target_weight', optional($target)->target_weight) }}">
    </div>

    <button type="submit">保存</button>
</form>

<p><a href="{{ route('weight_logs.index') }}">一覧に戻る</a></p>
@endsection