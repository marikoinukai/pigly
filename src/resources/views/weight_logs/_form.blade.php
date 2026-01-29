{{-- resources/views/weight_logs/_form.blade.php --}}
@csrf

<div class="modal-field">
  <div class="modal-label">
    <span>日付</span>
    <span class="required-badge">必須</span>
  </div>

  {{-- 表示用（年 月 日） --}}
  <input
    type="text"
    class="modal-input js-date-display is-empty"
    data-placeholder="年/月/日"
    readonly
  >

  {{-- 実際に送信する date --}}
  <input
    type="date"
    name="date"
    class="js-date-real"
    value="{{ old('date') }}"
    hidden
  >

  @error('date') <p class="modal-error">{{ $message }}</p> @enderror
</div>

<div class="modal-field">
  <div class="modal-label">
    <span>体重</span>
    <span class="required-badge">必須</span>
  </div>

  <div class="modal-input-row">
    <input
      class="modal-input"
      type="text"
      name="weight"
      placeholder="50.0"
      value="{{ old('weight') }}"
    >
    <span class="modal-unit">kg</span>
  </div>
  @error('weight') <p class="modal-error">{{ $message }}</p> @enderror
</div>

<div class="modal-field">
  <div class="modal-label">
    <span>摂取カロリー</span>
    <span class="required-badge">必須</span>
  </div>

  <div class="modal-input-row">
    <input
      class="modal-input"
      type="text"
      name="calories"
      placeholder="1200"
      value="{{ old('calories') }}"
    >
    <span class="modal-unit">cal</span>
  </div>
  @error('calories') <p class="modal-error">{{ $message }}</p> @enderror
</div>

<div class="modal-field">
  <div class="modal-label">
    <span>運動時間</span>
    <span class="required-badge">必須</span>
  </div>

  <input
  class="modal-input"
  type="text"
  name="exercise_duration"
  placeholder="00:00"
  value="{{ old('exercise_duration') }}"
  >
  @error('exercise_duration') 
    <p class="modal-error">{{ $message }}</p> 
  @enderror
</div>

<div class="modal-field">
  <div class="modal-label">
    <span>運動内容</span>
  </div>

  <textarea
    class="modal-input modal-textarea"
    name="exercise_content"
    placeholder="運動内容を追加"
  >{{ old('exercise_content') }}</textarea>
  @error('exercise_content') <p class="modal-error">{{ $message }}</p> @enderror
</div>