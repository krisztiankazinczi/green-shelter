<div class="form-group">
  <label for={{ $field_name }} class="custom-form-label col-form-label">{{ __('Képek') }}</label>

  <div class="input-group @error($field_name) special-input-error generic_input_file_error_height @enderror">
    <div class="custom-file">
      <input 
        type="file" 
        class="custom-file-input" 
        id={{ $field_name }} 
        name="{{$field_name}}[]" 
        accept="image/*" 
        @isset ($multiple) multiple @endisset
      >
      <label class="contact_form_input custom-file-label" for={{ $field_name }} id="file-names"></label>
    </div>
  </div>
  @foreach ($errors->getMessages() as $key => $msg)
    @if (str_contains($key, 'image'))
      <strong class="text-danger" style="font-size: 80%;">{{ $msg[0] }}</strong>
    @endif
  @endforeach

  <div class="mt-4 mb-3 text-center row user-image">
    <div class="imgPreview">
    
    </div>
  </div>
</div>

<script>
  const styles= {
    height: "200px",
    marginRight: "10px",
    marginBottom: "10px",
    maxWidth: "400px",
  };

  $(function() {
    const multiImgPreview = function(input, imgPreviewPlaceholder) {

        if (input.files) {
            let filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).css(styles).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    const fieldName = {!! json_encode($field_name) !!}

    $('#' + fieldName).on('change', function(e) {
        multiImgPreview(this, 'div.imgPreview');

        let filenames = "";
        for (i = 0; i < e.target.files.length; i++) {
          filenames += e.target.files[i].name;
          if (i !== e.target.files.length - 1) filenames += ', '; 
        }
        
        $('#file-names').append(filenames);
    });
  });    
</script>
