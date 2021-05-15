@extends('layouts.index')

@section('title', 'Hirdetés létrehozása')

@section('content')
    <div class="container-fluid gray-bg-color">
      <div class="row outer-form-container" >
          <div class="col-md-4">
            <div class="d-flex flex-column justify-content-center align-items-center h-100">
              <h1 class="mt-3">Hirdetés feladása</h1>
              <h1 class="mt-4 display-4 border-bottom border-primary" style="border-width: 5px !important;">{{ $category_name }}</h1>
              <h1 class="mt-4">Kategóriában</h1>
            </div>
          </div>
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
                      @include('partials.small.select_field', [
                        'field_name' => 'animal_type',
                        'options' => $animal_types,
                        'placeholder' => 'Fajta'
                      ])
                    @endisset

                    @include('partials.small.file_input', [
                      'field_name' => 'images',
                      'multiple' => true
                    ])

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
@endsection