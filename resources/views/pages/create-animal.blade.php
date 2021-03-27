@extends('layouts.index')

@section('title', 'Hirdetés létrehozása')

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
  <textarea name="editor1"></textarea>
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
@endsection