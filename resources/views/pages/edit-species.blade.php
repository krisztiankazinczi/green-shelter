@extends('layouts.index')

@section('title', 'Állatfajta ({{ $animal_type->name }}) szerkesztése')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')

<div class="container-fluid gray-bg-color">
  <div class="row outer-form-container" >
      <div class="col-md-4">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h1 class="mt-4 text-center display-4 thick-underline">{{ $animal_type->name }}</h1>
          <h1 class="mt-4 mb-4 text-center">fajta módosítása</h1>
        </div>
      </div>
      <div class="col-md-2 forms-bg-color form-fields-container" style="max-width: 200px;"></div>
      <div class="p-4 col-md-6 forms-bg-color" >
        <div>
            <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('animal.type.edit', ['id' => $animal_type->id]) }}">
              @csrf
              @method('PUT')
                <label for="name" class="custom-form-label col-form-label">{{ __('Fajta Neve') }}</label>
                <div class="col-12">
                  @include('partials.small.input_field', [
                    'field_name' => 'name',
                    'type' => 'text',
                    'db_value' => $animal_type->name
                  ])
                </div>

                @include('partials.small.ckeditor', [
                  'field_name' => 'description',
                  'placeholder' => 'Leírás',
                  'db_value' => $animal_type->description
                ])

                @include('partials.small.single_file_input', [
                  'field_name' => 'image',
                  'placeholder' => 'Kép',
                  'image_uri_from_db' => '/images/' . $animal_type->image_uri
                ])

                <div class="mb-0 form-group">
                  <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-secondary d-block w-50 form_submit_button">
                          {{ __('Fajta módosítása') }}
                      </button>
                  </div>
                </div>
              </form>
        </div>
              
      </div>
  </div>
</div>
@endsection