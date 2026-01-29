{{-- resources/views/weight_logs/_form.blade.php --}}
@csrf

<div class="form-group">
  <label class="form-label">日付 <span class="required-badge">必須</span></label>
  <input class="form-input" type="date" name="date" value="{{ old('date', $log->date ?? now()->toDateString()) }}">
  @error('date') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
  <label class="form-label">体重 <span class="required-badge">必須</span></label>
  <input class="form-input" type="text" name="weight" value="{{ old('weight', $log->weight ?? '') }}">
  @error('weight') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
  <label class="form-label">摂取カロリー <span class="required-badge">必須</span></label>
  <input class="form-input" type="text" name="calories" value="{{ old('calories', $log->calories ?? '') }}">
  @error('calories') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
  <label class="form-label">運動時間 <span class="required-badge">必須</span></label>
  <input class="form-input" type="time" name="exercise_time" value="{{ old('exercise_time', isset($log->exercise_time) ? \Carbon\Carbon::createFromFormat('H:i:s',$log->exercise_time)->format('H:i') : '') }}">
  @error('exercise_time') <p class="error-message">{{ $message }}</p> @enderror
</div>

<div class="form-group">
  <label class="form-label">運動内容</label>
  <textarea class="form-input" name="exercise_content">{{ old('exercise_content', $log->exercise_content ?? '') }}</textarea>
  @error('exercise_content') <p class="error-message">{{ $message }}</p> @enderror
</div>