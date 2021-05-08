@extends('layouts.index')

@section('title', 'Állatfajta ({{ $animal_type->name }}) szerkesztése')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Új állatfajta létrehozása') }}</div>
        <div class="card-body">
          <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('animal.type.edit', ['id' => $animal_type->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Fajta neve') }}</label>
              <div class="col-md-10">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $animal_type->name) }}" autocomplete="name" autofocus>
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
                  <div style="@error('description') border: 1px solid red; @enderror">
                    <textarea id="description" class="form-control" name="description">{{ old('description', $animal_type->description) }}</textarea>
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
                  <div class="custom-file">
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
                  <img src="/images/{{$animal_type->image_uri}}" style="height: 200px; margin-right: 10px; margin-bottom:10px; max-width: 400px;" />
                  <p class="alert alert-warning" role="alert">Ezt a képet cseréled le, ha most új képet választasz ki.</p>
                </div>
                
              </div>   
              </div>
            </div>
            
            <div class="mb-0 form-group">
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary d-block">
                      {{ __('Mentés') }}
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