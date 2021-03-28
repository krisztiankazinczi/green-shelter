@extends('layouts.index')

@section('title', 'Hirdetés létrehozása')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Hirdetés feladása') }}</div>

                <div class="card-body">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('create.advertisement', $page) }}">
                    @csrf
                    <div class="form-group row">
                      <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Cím') }}</label>
                      <div class="col-md-10">
                          <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                          @error('title')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Leírás') }}</label>
                      <div class="col-md-10">
                          <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    @isset($animal_types)
                      <div class="form-group row">
                        <label for="animal_type" class="col-md-2 col-form-label text-md-right">{{ __('Kategória') }}</label>
                        <div class="col-md-10">
                          <select class="form-control w-100 @error('animal_type') is-invalid @enderror" name="animal_type" id="animal_type" required>
                            <option value=""></option>
                            @foreach ($animal_types as $type)
                              <option value="{{ $type->id }}" @if (old('animal_types') == $type->id) selected @endif >{{ $type->name }}</option>
                            @endforeach
                          </select>
                          @error('animal_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    @endisset


                    <div class="form-group row">
                      <label for="images" class="col-md-2 col-form-label text-md-right">{{ __('Képek') }}</label>
                      <div class="col-md-10">
                          <input type="file" id="images" name="images[]" multiple>
                          @error('images')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        <div class="row user-image mb-3 text-center mt-4">
                          <div class="imgPreview">
                          
                          </div>
                          
                        </div>   
                      </div>
                    </div>
                    @isset($errors)
                      @foreach ($errors->all() as $error)
                          <div>{{ $error }}</div>
                      @endforeach
                  @endisset

                    <div class="form-group mb-0">
                      <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary d-block">
                              {{ __('Hirdetés feladása') }}
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

      $(function() {
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).css(styles).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
      });    
  </script>
@endsection