@extends('layouts.app')
@section('body_class', 'dashboard')

@section('content')

<header class="dash-header">
    <div class="dash-logo">PiGLy</div>

    <div class="dash-actions">
        <a class="dash-btn" href="{{ route('weight_targets.edit') }}">目標体重設定</a>
        {{-- ログアウトは Fortify導入後にフォームに差し替え --}}
    </div>
</header>

<div class="dash-shell">

    <section class="summary-card-wide">
        <div class="summary-item">
            <div class="summary-label">目標体重</div>
            <div class="summary-value">
            {{ $target ? $target->target_weight : '—' }}<span class="unit">kg</span>
            </div>
        </div>

        <div class="summary-divider"></div>

        <div class="summary-item">
            <div class="summary-label">目標まで</div>
            <div class="summary-value">
            {{ is_null($diffToTarget) ? '—' : (-1 * $diffToTarget) }}<span class="unit">kg</span>
            </div>
        </div>

        <div class="summary-divider"></div>

        <div class="summary-item">
            <div class="summary-label">最新体重</div>
            <div class="summary-value">
            {{ $logs->first() ? $logs->first()->weight : '—' }}<span class="unit">kg</span>
            </div>
        </div>
    </section>

  {{-- 検索 --}}
    <section class="logs-card">
        <div class="search-row">
            <form class="search-form" method="GET" action="{{ route('weight_logs.index') }}">
            <input class="search-input" type="date" name="from" value="{{ request('from') }}">
            <span class="search-sep">〜</span>
            <input class="search-input" type="date" name="to" value="{{ request('to') }}">

            <button class="search-btn" type="submit">検索</button>

            @if(request('from') || request('to'))
                <a class="reset-btn" href="{{ route('weight_logs.index') }}">リセット</a>
            @endif
            </form>

            <a class="btn btn-add" href="{{ route('weight_logs.create') }}">データ追加</a>
        </div>

        <div class="result-info">
            @php
                $from = request('from');
                $to = request('to');

                $fromText = $from ? \Carbon\Carbon::parse($from)->format('Y年n月j日') : null;
                $toText = $to ? \Carbon\Carbon::parse($to)->format('Y年n月j日') : null;
            @endphp


            @if($fromText && $toText)
                <p class="result-text">
                {{ $fromText }}～{{ $toText }}の検索結果　{{ $count }}件
                </p>
            @elseif($fromText)
                <p class="result-text">
                    {{ $fromText }}以降の検索結果　{{ $count }}件
                </p>
            @elseif($toText)
                <p class="result-text">
                {{ $toText }}以前の検索結果　{{ $count }}件
                </p>
            @else
                <p class="result-text">
                    全ての記録　{{ $count }}件
                </p>
            @endif
        </div>

    {{-- 一覧テーブル --}}
        <div class="table-wrap">
            <table class="log-table">
                <thead>
                    <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>{{\Carbon\Carbon::parse($log->date)->format('Y/m/d')}}</td>
                        <td>{{ $log->weight }}kg</td>
                        <td>{{ $log->calories }}kcal</td>
                        <td>
                            {{ $log->exercise_time ? \Carbon\Carbon::createFromFormat('H:i:s', $log->exercise_time)->format('H:i') : '' }}
                        </td>
                        <td class="edit-col">
                        <a class="edit-link" href="{{ route('weight_logs.edit', $log) }}">✎</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty">まだ記録がありません。</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $logs->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.search-input[type="date"]');
    if (inputs.length === 0) return;


    inputs.forEach(input => {
    input.classList.toggle('is-empty', !input.value);
    input.addEventListener('change', () => {
    input.classList.toggle('is-empty', !input.value);
    });
    });
    });
</script>
@endsection