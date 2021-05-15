@extends('layouts.index')

@section('title', 'Új állatfajta létrehozása')

@section('content')
<div class="container-fluid gray-bg-color">
  <div class="row outer-form-container" >
      <div class="col-md-4">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h1 class="mt-4 display-4 border-bottom border-primary" style="border-width: 5px !important;">Új állatfajta hozzáadása</h1>
        </div>
      </div>
      <div class="col-md-2 forms-bg-color form-fields-container" style="max-width: 200px;"></div>
      <div class="p-4 col-md-6 forms-bg-color" >
        <div>
            <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('create.species') }}">
              @csrf
                <label for="name" class="custom-form-label col-form-label">{{ __('Fajta Neve') }}</label>
                <div class="col-12">
                  @include('partials.small.input_field', [
                    'field_name' => 'name',
                    'type' => 'text',
                  ])
                </div>

                @include('partials.small.ckeditor', [
                  'field_name' => 'description',
                  'placeholder' => 'Leírás'
                ])

                @include('partials.small.single_file_input', [
                  'field_name' => 'image',
                  'placeholder' => 'Kép',
                ])

                <div class="mb-0 form-group">
                  <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-secondary d-block w-50 form_submit_button">
                          {{ __('Fajta mentése') }}
                      </button>
                  </div>
                </div>
              </form>
        </div>
              
      </div>
  </div>
</div>
@endsection