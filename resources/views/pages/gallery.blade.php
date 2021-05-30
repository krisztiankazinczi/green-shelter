@extends('layouts.index')

@section('title', 'Képgaléria')

@section('content')

<div class="pt-4 mb-4 d-flex justify-content-center align-items-center flex-column">
  <h1><span class="border-bottom border-primary display-4" style="border-width: 5px !important;">Képgaléria</span></h1>
</div>

<div id="photos" class="mt-4">
  @isset($images)
    @foreach ($images as $data)
        <div
          class="position-relative"
          style="cursor: pointer;"
          data-toggle="modal" 
          data-target="#{{ $data->animal_id . $data->id }}"
        >
          <img class="gallery-image" src="/images/{{$data->filename}}"  class="img-thumbnail" />
          <div class="details-button">
            <a href="{{ $data->adopted ? '/success-stories' : '/animals/' . $data->route }}/{{ $data->animal_id }}">
              <button class="btn btn-primary" >
                Részletek
              </button>
            </a>
          </div>
        </div>
        @include('partials.modal_image', [
          'id' => $data->animal_id . $data->id,
          'image_path' => '/images/' . $data->filename,
          'image_alt' => $data->title,
          'link_to_advertisement' => $data->adopted ? '/success-stories/' . $data->animal_id : '/animals/' . $data->route . '/' . $data->animal_id
        ])
    @endforeach
    @else
    <h2>Adatbázis hiba. Dolgozunk a problémán.</h2>
  @endisset
</div> 
@endsection