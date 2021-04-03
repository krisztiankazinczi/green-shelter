@extends('layouts.index')

@section('title', 'Képgaléria')

@section('content')

<div class="row mb-3 mt-4 d-flex flex-row justify-content-center">
  @isset($images)
    @foreach ($images as $image)
        <img src="/images/{{$image->filename}}" style="height: 300px; margin-right: 15px; margin-bottom:15px; max-width: 600px; object-fit: cover;" alt="{{$image->animal->title}}" />
    @endforeach
  @endisset
</div> 

@endsection