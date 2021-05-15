<label for="images" class="custom-form-label col-form-label">{{ __('Képek') }}</label>

<div class="input-group @error('images') special-input-error generic_input_file_error_height @enderror">
  <div class="custom-file">
    <input 
      type="file" 
      class="custom-file-input" 
      id="images" 
      name="images[]" 
      accept="image/*" 
      multiple
    >
    <label class="contact_form_input custom-file-label" for="images" id="file-names"></label>
  </div>
</div>
@foreach ($errors->getMessages() as $key => $msg)
  @if (str_contains($key, 'image'))
    <strong class="text-danger" style="font-size: 80%;">{{ $msg[0] }}</strong>
  @endif
@endforeach
