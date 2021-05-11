@extends('layouts.index')

@section('title', 'Új állatfajta létrehozása')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Új állatfajta létrehozása') }}</div>
        <div class="card-body">
          <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('create.species') }}">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Fajta neve') }}</label>
              <div class="col-md-10">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Leírás') }}</label>
              <div class="col-md-10">
                  <div class="@error('description') special-input-error @enderror">
                    <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                  </div>
                  <div>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Kép') }}</label>
              <div class="col-md-10">
                <div class="input-group @error('image') special-input-error @enderror">
                  <div class="custom-file" style="@error('images') border: 1px solid red; @enderror">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                    <label class="custom-file-label" for="image" id="file-name"></label>
                  </div>
                </div>
                @error('image')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              <div class="mt-4 mb-3 text-center row user-image">
                <div class="imgPreview">
                
                </div>
                
              </div>   
              </div>
            </div>
            
            <div class="mb-0 form-group">
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary d-block">
                      {{ __('Létrehozás') }}
                  </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
  CKEDITOR.replace( 'description' );

  const styles= {
    height: "200px",
    marginRight: "10px",
    marginBottom: "10px",
    maxWidth: "400px",
  };

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $($.parseHTML('<img>')).css(styles).attr('src', event.target.result).appendTo('div.imgPreview');
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#image").change(function(e) {
    $("div.imgPreview").empty();
    $('#file-name').text(e.target.files[0].name)
    readURL(this);
  });


</script>
@endsection