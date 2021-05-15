<div class="form-group">
  <label for={{ $field_name }} class="custom-form-label col-form-label">{{ __($placeholder) }}</label>

  <div class="input-group @error($field_name) special-input-error generic_input_file_error_height @enderror">
    <div class="custom-file">
      <input 
        type="file" 
        class="custom-file-input" 
        id={{ $field_name }} 
        name="{{$field_name}}" 
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
      @isset ($image_uri_from_db)
        <img src="{{$image_uri_from_db}}" style="height: 200px; margin-right: 10px; margin-bottom:10px; max-width: 300px;" />
        <p class="alert alert-warning" role="alert">Ezt a képet cseréled le, ha most új képet választasz ki.</p>
      @endisset
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

    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $($.parseHTML('<img>')).css(styles).attr('src', event.target.result).appendTo('div.imgPreview');
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

    const fieldName = {!! json_encode($field_name) !!};
    $("#image").change(function(e) {
      $("div.imgPreview").empty();
      $('#file-names').text(e.target.files[0].name)
      readURL(this);
    });
  });    
</script>
