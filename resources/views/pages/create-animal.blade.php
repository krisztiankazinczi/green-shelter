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
                  <form method="POST" action="{{ route('register') }}">
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
                          <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required></textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="category" class="col-md-2 col-form-label text-md-right">{{ __('Kategória') }}</label>
                      <div class="col-md-10">
                        <select class="form-control w-100 @error('category') is-invalid @enderror" name="category" id="category" required>
                          <option value="+91">+91</option>
                          <option value="+351">+351</option>
                          <option value="+1">+1</option>
                        </select>
                        @error('category')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="animal_type" class="col-md-2 col-form-label text-md-right">{{ __('Kategória') }}</label>
                      <div class="col-md-10">
                        <select class="form-control w-100 @error('animal_type') is-invalid @enderror" name="animal_type" id="animal_type" required>
                          <option value="+91">+91</option>
                          <option value="+351">+351</option>
                          <option value="+1">+1</option>
                        </select>
                        @error('animal_type')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

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



  {{-- <textarea name="editor1"></textarea> --}}
  <script>
      CKEDITOR.replace( 'description' );
  </script>
@endsection