@extends('layouts.index')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bejelentkezés') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Jelszó') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Emlékezz rám') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Bejelentkezés') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Elfelejtett jelszó') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <div class="mt-3">
                        <a 
                            href="{{ route('login.as.user') }}" 
                            onclick="event.preventDefault(); document.getElementById('login-as-user-form').submit();">
                            Bejelentkezés egy felhasználóként
                        </a>
                        <form id="login-as-user-form" action="{{ route('login.as.user') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form> 
                    </div>

                    <div class="mt-1">
                        <a 
                            href="{{ route('login.as.admin') }}" 
                            onclick="event.preventDefault(); document.getElementById('login-as-admin-form').submit();">
                            Bejelentkezés egy adminként
                        </a>
                        <form id="login-as-admin-form" action="{{ route('login.as.admin') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form> 
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
