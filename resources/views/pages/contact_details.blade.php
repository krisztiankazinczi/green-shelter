@extends('layouts.index')

@section('title', 'Rólunk')

@section('content')
<div class="d-flex justify-content-center">
  @if(!empty(Session::get('success')))
    <div class="alert alert-success"> {{ Session::get('success') }}</div>
  @endif
  @if(!empty(Session::get('error')))
    <div class="alert alert-danger"> {{ Session::get('error') }}</div>
  @endif
</div>
<h1>Kapcsolat</h1>
................................................................

 <div class="container mt-4 w-50">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Kérdésed van? Bátran írj nekünk') }}</div>

                <div class="card-body">
                  <form method="POST" id="form" enctype="multipart/form-data" action="{{ route('send.message.admin') }}">
                    @csrf
                    <div class="form-group row">
                      <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Név') }}</label>
                      <div class="col-md-10">
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
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
                          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="subject" class="col-md-2 col-form-label text-md-right">{{ __('Tárgy') }}</label>
                      <div class="col-md-10">
                          <input id="subject" type="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" autofocus>
                          @error('subject')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="message" class="col-md-2 col-form-label text-md-right">{{ __('Üzenet') }}</label>
                      <div class="col-md-10">
                        <textarea @error('message')class=" form-control is-invalid" @enderror id="message" rows="6" class="form-control" name="message">{{ old('message') }}</textarea>
                        @error('message')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group mb-0">
                      <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary d-block">
                              {{ __('Üzenet küldése') }}
                          </button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection