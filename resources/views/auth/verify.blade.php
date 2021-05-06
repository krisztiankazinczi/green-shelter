@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Erősítsd meg az e-mail címed') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Egy új megerősítő linket küldtünk az email címedre') }}
                        </div>
                    @endif

                    {{ __('Mielőtt folytatnád, kérünk ellenőrizd az email címed') }}
                    {{ __('Ha nem kaptad meg az emailünket') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('ckattints ide és küldünk egy másikat') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
