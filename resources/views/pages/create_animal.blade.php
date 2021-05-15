@extends('layouts.index')

@section('title', 'Hirdetés létrehozása')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid gray-bg-color">
      <div class="row outer-form-container" >
          <div class="col-md-4"></div>
          <div class="col-md-2 forms-bg-color form-fields-container" style="max-width: 200px;"></div>
          <div class="p-4 col-md-6 forms-bg-color" >
            <div>
                <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('create.advertisement', $page) }}">
                  @csrf
                    <label for="title" class="custom-form-label col-form-label">{{ __('Cím') }}</label>
                    <div class="col-12">
                      @include('partials.small.input_field', [
                        'field_name' => 'title',
                        'type' => 'text',
                      ])
                    </div>

                    @include('partials.small.ckeditor', [
                      'field_name' => 'description',
                      'placeholder' => 'Leírás'
                    ])

                    @isset($animal_types)
                      <div class="form-group">
                        <label for="animal_type" class="custom-form-label col-form-label">{{ __('Fajta') }}</label>
                          <select class="contact_form_input form-control w-100 @error('animal_type') is-invalid @enderror" name="animal_type" id="animal_type">
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
                    @endisset

                      <div class="form-group">
                        @include('partials.small.file_input')

                        <div class="mt-4 mb-3 text-center row user-image">
                          <div class="imgPreview">
                          
                          </div>
                          
                        </div>   
                      </div>
                      <div class="mb-0 form-group">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary d-block w-50 form_submit_button">
                                {{ __('Hirdetés feladása') }}
                            </button>
                        </div>
                      </div>
                    </form>
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