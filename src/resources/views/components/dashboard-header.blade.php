<header class="dash-header">
  <div class="dash-logo">PiGLy</div>

  <div class="dash-actions">
    <a class="dash-btn" href="{{ route('weight_targets.edit') }}">目標体重設定</a>

        {{-- ログアウト --}}
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="dash-btn">ログアウト</button>
    </form>
  </div>
</header>
