@extends('layouts.index')

@section('title', 'Rólunk')

@section('content')
<div class="d-flex justify-content-center">
</div>
<div class="mt-4 d-flex justify-content-center align-items-center flex-column">
  <h1><span class="border-bottom border-primary" style="border-width: 5px !important;">Elérhetőségeink</span></h1>
  <h2 class="mt-4 text-primary text-bold"><span>Zöld Menedék Állatvédő Alapítvány</span></h2>
</div>
<div class="mt-4 d-flex justify-content-around contact-details-container">
  <div class="p-5 rounded bg-primary">
    <div class="d-flex justify-content-center">
      <h3 class="text-light">Menhely 1</h3>
    </div>
    <h5 class="mt-3 text-light">Vác, Külső-Rádi út</h5>
    <p class="mt-3 text-light">Nyitva tartás: hétköznap 8.30 -15.30</p>
    <p class="mt-3 text-light">Telefon: 06 20 4245367</p>
  </div>
  <div class="p-5 rounded bg-primary">
    <div class="d-flex justify-content-center">
      <h3 class="text-light">Menhely 2</h3>
    </div>
    <h5 class="mt-3 text-light">Vác-Máriaudvar, Kamilla utca</h5>
    <p class="mt-3 text-light">Nyitva tartás: naponta 9-13 óra között</p>
    <p class="mt-3 text-light">Telefon: 20 4646491 /sms/</p>
  </div>
</div>

<div class="mt-5 d-flex justify-content-center">
  <div class="p-5 rounded bg-secondary">
    <div class="d-flex justify-content-center">
      <h3 class="text-light">Általános adatok</h3>
    </div>
    <h6 class="mt-3 text-light">Levélcím: 2600 Vác Piac u. 1.</h6>
    <h6 class="mt-3 text-light">E-mail: zoldm@zoldmenedek.hu</h6>
    <h6 class="mt-3 text-light">Számlaszám: 10200919-32871834</h6>
    <h6 class="mt-3 text-light">
      IBAN - nemzetközi számlaszám:
      <br />
      HU66 1020 0919 3287 1834 0000 0000
    </h6>
    <h6 class="mt-3 text-light">Adószám: 18661026-2-13</h6>
  </div>
</div>

<div class="mt-5 d-flex justify-content-center">
  <h1><span class="border-bottom border-primary" style="border-width: 5px !important;">Kapcsolat</span></h1>
</div>
 <div class="container mt-4 w-50" id="contact-form-container">
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
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
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
                          <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
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
                          <input id="subject" type="subject" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">
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

                    <div class="mb-0 form-group">
                      <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary d-block" onclick="validateContactForm(event)">
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

<style>
 
</style>

@endsection