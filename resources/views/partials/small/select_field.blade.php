<div class="form-group">
  <label for={{ $field_name }} class="custom-form-label col-form-label">{{ __($placeholder) }}</label>
    <select class="contact_form_input form-control w-100 @error($field_name) is-invalid @enderror" name={{ $field_name }} id={{ $field_name }}>
      <option value=""></option>
      @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ !strcmp($option->id, old($field_name, $db_value ?? '')) ? 'selected' : '' }}>{{ $option->name }}</option>
      @endforeach
    </select>
    @error($field_name)
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
</div>