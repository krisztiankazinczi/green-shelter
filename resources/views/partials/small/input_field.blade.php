<div class="form-group row">
  <input 
    id={{ $field_name }} 
    placeholder={{ $placeholder }}
    type={{ $type }} 
    class="contact_form_input form-control @error($field_name) is-invalid @else remove-border @enderror" 
    name={{ $field_name }} 
    value="{{ old($field_name) }}"
  >
  @error($field_name)
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>