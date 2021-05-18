@extends('layouts.index')

@section('title', 'Hirdetés létrehozása')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container-fluid gray-bg-color">
  <div class="row outer-form-container" >
      <div class="col-md-4">
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
          <h1 class="mt-4 text-center display-4 thick-underline">Hirdetés módosítása</h1>
          <h3 class="mt-5 text-center">Feltöltött képek módosítása</h3>
          <div class="mt-4 mb-3 ml-4 text-center row user-image">
            @foreach( $animal->images as $image )
              <div class="position-relative">
                <img 
                  src="/images/{{$image->filename}}" 
                  class="{{ $image->main ? 'border border-secondary' : '' }}" 
                  style="height: 200px; margin-right: 10px; margin-bottom:10px; max-width: 300px; {{ $image->main ? 'border-width: 10px !important;' : '' }}" 
                />
                @if (!$image->main)
                  <form action="{{ route('delete.image', [$animal->id, $image->id]) }}" method="POST" id="delete-image-{{$image->id}}">
                    @csrf
                    @method('DELETE') 
                    <i 
                      class="far fa-times-circle position-absolute" 
                      style="top: 20px; right: 20px; font-size: 20px; color: red; cursor: pointer;"
                      data-toggle="tooltip" 
                      title="Kép törlése"
                      onclick="deleteImage({{$image->id}})"
                    >
                    </i>
                  </form>
                  <form action="{{ route('change.main.image', [$animal->id, $image->id]) }}" method="POST" id="main-image-{{$image->id}}">
                    @csrf
                    @method('PUT') 
                      <i 
                        class="fas fa-image position-absolute" 
                        style="top: 20px; right: 50px; font-size: 20px; color: green; cursor: pointer;"
                        onclick="changeMainImage({{$image->id}})"
                        data-toggle="tooltip" 
                        title="Borítókép beállítása"
                      >
                      </i>
                  </form>
                @endif
                
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-2 forms-bg-color form-fields-container" style="max-width: 200px;"></div>
      <div class="p-4 col-md-6 forms-bg-color" >
        <div>
            <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('update.advertisement', [$page, $animal->id]) }}">
              @csrf
              @method('PUT') 
                <label for="title" class="custom-form-label col-form-label">{{ __('Cím') }}</label>
                <div class="col-12">
                  @include('partials.small.input_field', [
                    'field_name' => 'title',
                    'type' => 'text',
                    'db_value' => $animal->title
                  ])
                </div>

                @include('partials.small.ckeditor', [
                  'field_name' => 'description',
                  'placeholder' => 'Leírás',
                  'db_value' => $animal->description
                ])

                @isset($animal_types)
                  @include('partials.small.select_field', [
                    'field_name' => 'animal_type',
                    'options' => $animal_types,
                    'placeholder' => 'Fajta',
                    'db_value' => $animal->animal_type_id
                  ])
                @endisset

                @include('partials.small.file_input', [
                  'field_name' => 'images',
                  'placeholder' => 'Képek',
                  'multiple' => true
                ])

                <div class="mb-0 form-group">
                  <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-secondary d-block w-50 form_submit_button">
                          {{ __('Hirdetés módosítása') }}
                      </button>
                  </div>
                </div>
              </form>
        </div>
        
      </div>
  </div>
</div>
<script>

  // Change main image
  function changeMainImage(id) {
    document.getElementById(`main-image-${id}`).submit();
  }

  // Delete image
  function deleteImage(id) {
    document.getElementById(`delete-image-${id}`).submit();
  }

</script>
@endsection