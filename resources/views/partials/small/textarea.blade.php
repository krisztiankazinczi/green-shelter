<div class="form-group row">
  <textarea 
    placeholder={{ $placeholder }}
    class="contact_form_textarea form-control w-100 @error($field_name) is-invalid @else remove-border @enderror" 
    id={{ $field_name }} 
    rows={{ $rows }}
    name={{ $field_name }}
  >{{ old($field_name) }}</textarea>
  @error($field_name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
  @enderror
</div>