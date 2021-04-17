@extends('layouts.index')

@section('title', 'Profil szerkesztése - ' . Auth::user()->name)

@section('cdn-files')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Profil adatok módosítása') }}</div>
        <div class="card-body">
          <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('update.profile') }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Név') }}</label>
              <div class="col-md-10">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>
              <div class="col-md-10">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" autocomplete="email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="bio" class="col-md-2 col-form-label text-md-right">{{ __('Leírás') }}</label>
              <div class="col-md-10">
                  <div style="@error('bio') border: 1px solid red; @enderror">
                    <textarea id="bio" class="form-control" name="bio">{{ old('bio', Auth::user()->bio) }}</textarea>
                  </div>
                  <div>
                    @error('bio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Profilkép') }}</label>
              <div class="col-md-10">
                <div class="input-group">
                  <div class="custom-file" style="@error('images') border: 1px solid red; @enderror">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                    <label class="custom-file-label" for="image" id="file-name"></label>
                  </div>
                </div>
                @error('image')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              <div class="mt-4 mb-3 text-center row user-image">
                <div class="imgPreview">
                  <img src="{{Auth::user()->avatar_uri ? 'images/' . Auth::user()->avatar_uri : 'images/users/default-profile-image.jpg'}}" style="height: 200px; margin-right: 10px; margin-bottom:10px; max-width: 400px;" />
                  <p class="alert alert-warning" role="alert">Ezt a képet cseréled le, ha most új képet választasz ki.</p>
                </div>
                
              </div>   
              </div>
            </div>


            @if(!empty(Session::get('success')))
              <div class="alert alert-success"> {{ Session::get('success') }}</div>
            @endif
            @if(!empty(Session::get('error')))
              <div class="alert alert-danger"> {{ Session::get('error') }}</div>
            @endif
            <div class="form-group mb-0">
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary d-block">
                      {{ __('Profil Módosítása') }}
                  </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
  CKEDITOR.replace( 'bio' );

  const styles= {
    height: "200px",
    marginRight: "10px",
    marginBottom: "10px",
    maxWidth: "400px",
  };

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $($.parseHTML('<img>')).css(styles).attr('src', event.target.result).appendTo('div.imgPreview');
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $("#image").change(function(e) {
    $("div.imgPreview").empty();
    $('#file-name').text(e.target.files[0].name)
    readURL(this);
  });
</script>

@endsection