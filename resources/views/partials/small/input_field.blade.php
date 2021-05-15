<div class="form-group row">
  <input 
    id={{ $field_name }} 
    @isset ($placeholder) placeholder={{ $placeholder }} @endisset
    type={{ $type }} 
    class="contact_form_input form-control @error($field_name) is-invalid @else remove-border @enderror" 
    name={{ $field_name }} 
    value="{{ old($field_name, $db_value ?? '')}}"
  >
  @error($field_name)
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>