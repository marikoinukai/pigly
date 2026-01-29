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

            <button type="button" class="btn btn-add" data-modal-open="#createModal">データ追加</button>
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
                {{ $logs->onEachSide(1)->links('vendor.pagination.pigly') }}
            </div>
        </div>
    </section>
    {{-- 追加：登録モーダル --}}
    <div id="createModal" class="modal-overlay" aria-hidden="true">
        <div class="modal-card" role="dialog" aria-modal="true">
            <h1 class="modal-title">Weight Logを追加</h1>

            <form method="POST" action="{{ route('weight_logs.store') }}">
            @include('weight_logs._form', ['log' => null])

                <div class="modal-actions">
                    <button type="button" class="btn btn-ghost" data-modal-close>戻る</button>
                    <button class="btn btn-primary" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
const indexUrl  = "{{ route('weight_logs.index') }}";
const createUrl = "{{ route('weight_logs.create') }}";

document.addEventListener('DOMContentLoaded', function () {

  // ===== 既存：日付inputの薄色 =====
  const inputs = document.querySelectorAll('.search-input[type="date"]');
  if (inputs.length) {
    inputs.forEach(input => {
      input.classList.toggle('is-empty', !input.value);
      input.addEventListener('change', () => {
        input.classList.toggle('is-empty', !input.value);
      });
    });
  }

  // ===== モーダル =====
  const modal = document.querySelector('#createModal');
  if (!modal) return;

  const openModal = (selector, pushUrl = null) => {
    const m = document.querySelector(selector);
    if (!m) return;

    m.classList.add('is-open');
    m.setAttribute('aria-hidden', 'false');

    // indexから開いた時だけURLを /create にする
    if (pushUrl) history.pushState({ modal: true }, "", pushUrl);
  };

  const closeModal = (m) => {
    m.classList.remove('is-open');
    m.setAttribute('aria-hidden', 'true');

    // URLを /weight_logs に戻す
    history.replaceState({}, "", indexUrl);
  };

  // 開く（データ追加ボタン）
  document.querySelectorAll('[data-modal-open]').forEach(btn => {
    btn.addEventListener('click', () => openModal(btn.dataset.modalOpen, createUrl));
  });

  // 閉じる（戻るボタン）
  document.querySelectorAll('[data-modal-close]').forEach(btn => {
    btn.addEventListener('click', () => closeModal(modal));
  });

  // 背景クリックで閉じる
  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal(modal);
  });

  // /createで来た or バリデーションエラーなら最初から開く
  @if (!empty($openCreateModal) || $errors->any())
    openModal('#createModal');
  @endif

  // ===== 日付表示を「YYYY年M月D日」に変換（表示用input）=====
document.querySelectorAll('.js-date-display').forEach(display => {
  // 同じ modal-field の中にある「本物のdate」を探す
  const real = display.closest('.modal-field')?.querySelector('.js-date-real');
  if (!real) return;

  const format = (v) => {
    if (!v) return '';
    const [y, m, d] = v.split('-');
    return `${y}年${Number(m)}月${Number(d)}日`;
  };

  // 初期表示
  display.value = format(real.value);

  // 表示欄クリックで日付ピッカーを開く（対応ブラウザ）
  display.addEventListener('click', () => {
    if (real.showPicker) real.showPicker();
    else real.focus(); // showPicker非対応の保険
  });

  // 日付が変わったら表示更新
  real.addEventListener('change', () => {
    display.value = format(real.value);
  });
});
});
</script>
@endsection