@extends('layouts.index')

@section('title', 'Képgaléria')

@section('content')

<div id="photos">
  @isset($images)
    @foreach ($images as $data)
        <div
        class="position-relative"
          style="cursor: pointer;"
          data-toggle="modal" 
          data-target="#{{ $data->animal_id . $data->id }}"
        >
          <img src="/images/{{$data->filename}}"  class="img-thumbnail" />
          <div class="button">
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

<style>

.button {
  display: none;
}

img:hover + .button {
  display: block;
  margin-left: auto;
  margin-right: auto;
  position: absolute;
  left: 20px;
  bottom: 20px;
  width: 100%;
  margin-bottom: 10px;
}

.button:hover {
  display: block;
  margin-left: auto;
  margin-right: auto;
  position: absolute;
  left: 20px;
  bottom: 20px;
  width: 100%;
  margin-bottom: 10px;
}


#photos {
  line-height: 0;
  -webkit-column-count: 4;
  -webkit-column-gap:   10px;
  -moz-column-count:    4;
  -moz-column-gap:      10px;
  column-count:         4;
  column-gap:           10px;  
}

#photos img {
  width: 100% !important;
  height: auto !important;
  max-height: 500px;
  object-fit: cover;
  margin-bottom: 10px;  
}

@media (max-width: 1200px) {
  #photos {
  -moz-column-count:    3;
  -webkit-column-count: 3;
  column-count:         3;
  }
}

@media (max-width: 1000px) {
  #photos {
  -moz-column-count:    2;
  -webkit-column-count: 2;
  column-count:         2;
  }
}
@media (max-width: 500px) {
  #photos {
  -moz-column-count:    1;
  -webkit-column-count: 1;
  column-count:         1;
  }
}

</style>

@endsection