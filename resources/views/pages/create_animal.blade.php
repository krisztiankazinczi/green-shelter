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
                  <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('create.advertisement', $page) }}">
                    @csrf
                    <div class="form-group row">
                      <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Cím') }}</label>
                      <div class="col-md-10">
                          <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>
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

                    @isset($animal_types)
                      <div class="form-group row">
                        <label for="animal_type" class="col-md-2 col-form-label text-md-right">{{ __('Kategória') }}</label>
                        <div class="col-md-10">
                          <select class="form-control w-100 @error('animal_type') is-invalid @enderror" name="animal_type" id="animal_type">
                            <option value=""></option>
                            @foreach ($animal_types as $type)
                              <option value="{{ $type->id }}" {{ !strcmp($type->id, old('animal_type')) ? 'selected' : '' }}>{{ $type->name }}</option>
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
                          <div class="input-group @error('images') special-input-error @enderror">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="images" name="images[]" accept="image/*" multiple>
                              <label class="custom-file-label" for="images" id="file-names"></label>
                            </div>
                          </div>
                          @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          {{-- @foreach ($errors->getMessages() as $key => $message)
                              @if (str_starts_with((strval($key)), 'images'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @endif
                          @endforeach --}}
                           @foreach ($errors->getMessages() as $key => $message)
                              {{$key}}
                          @endforeach
                        <div class="mt-4 mb-3 text-center row user-image">
                          <div class="imgPreview">
                          
                          </div>
                          
                        </div>   
                      </div>
                    </div>
                    <div class="mb-0 form-group">
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> --}}
  <script>
      CKEDITOR.replace( 'description' );

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

        $('#images').on('change', function(e) {
            multiImgPreview(this, 'div.imgPreview');

            let filenames = "";
            for (i = 0; i < e.target.files.length; i++) {
              filenames += e.target.files[i].name;
              if (i !== e.target.files.length - 1) filenames += ', '; 
            }
            
            $('#file-names').append(filenames);
        });
      });    


     {{-- $(document).ready(function () {
        $('#form').validate({ 
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true,
                },
                animal_type: {
                    required: true,                    
                },
                images: {
                    required: true,                    
                },
            },
            messages: {
              title: 'asdkjlglhsdl g;sdkh gkasldhg k'
            }
        });
    }); --}}
  </script>
@endsection