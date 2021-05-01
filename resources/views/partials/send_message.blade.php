<form 
  method="POST" 
  id="form" 
  enctype="multipart/form-data" 
  action="{{ route('send.message') }}"
>
  @csrf
  <div class="form-group row d-flex justify-content-center">
    <input style="width: 95%;" id="subject" placeholder="Tárgy" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" autofocus>
    @error('subject')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group">
    <input type="hidden" name="from_id" value="{{ $from_id }}" />
    <input type="hidden" name="to_id" value="{{ $to_id }}" />
    <input type="hidden" name="animal_id" value="{{ $animal_id }}" />

    <div style="@error('message') border: 1px solid red; @enderror">
      <textarea placeholder="Üzenet" id="message" rows="6" class="form-control" name="message">{{ old('message') }}</textarea>
    </div>
    <div>
      @error('message')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
  </div>
    @if(!empty(Session::get('success')))
      <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    @if(!empty(Session::get('error')))
      <div class="alert alert-danger"> {{ Session::get('error') }}</div>
    @endif
    <div class="form-group mb-0">
      <div class="d-flex justify-content-between">
          <a class="card-link text-danger" style="cursor: pointer;" onclick="{{ $cbFunction }}" >Mégse</a>
          <button type="submit" class="btn btn-primary btn-sm d-block">
              {{ __('Küldés') }}
          </button>
      </div>
    </div>
  </form>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    CKEDITOR.replace( 'message' );
</script>