@extends('layouts.index')

@section('title', 'Képgaléria')

@section('content')

<div 
  {{-- class="row mb-3 mt-4 d-flex flex-row justify-content-center"  --}}
  id="photos"
>
  @isset($images)
    @foreach ($images as $image)
        <div
        class="position-relative"
          style="cursor: pointer;"
          data-toggle="modal" 
          data-target="#{{ $image->animal->id . $image->id }}"
        >
          <img src="/images/{{$image->filename}}" 
            {{-- style="height: 300px; margin-right: 15px; margin-bottom:15px; max-width: 600px; object-fit: cover;" alt="{{$image->animal->title}}"  --}}
          />
          <div class="button">
            <a 
              href="/{{ $image->menu->route }}/{{ $image->animal->id }}"
            >
              <button class="btn btn-primary " >
                Részletek
              </button>
            </a>
          </div>
        </div>
        @include('partials.modal_image', [
          'id' => $image->animal->id . $image->id,
          'image_path' => '/images/' . $image->filename,
          'image_alt' => $image->animal->title,
          'link_to_advertisement' => '/' . $image->menu->route . '/' . $image->animal->id
        ])
    @endforeach
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