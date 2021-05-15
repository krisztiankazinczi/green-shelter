<div class="form-group">
  <label for={{ $field_name }} class="custom-form-label col-form-label">{{ __($placeholder) }}</label>
  <div class="@error($field_name) special-input-error @enderror">
    <textarea id={{ $field_name }} class="form-control" name={{ $field_name }}>{{ old($field_name) }}</textarea>
  </div>
  <div>
    @error($field_name)
      <strong class="text-danger" style="font-size: 80%;">{{ $message }}</strong>
    @enderror
  </div>
</div>