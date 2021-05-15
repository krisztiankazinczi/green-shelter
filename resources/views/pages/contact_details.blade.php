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

<div style="background-color: #F1F1F1;">

<div class="mt-5 d-flex justify-content-center">
  <h1 class="pt-4 pb-2"><span class="border-bottom border-primary" style="border-width: 5px !important;">Kapcsolat</span></h1>
</div>
<div class="container mt-4 w-75 banner position-relative" id="contact-form-container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <form method="POST" id="contact_form" enctype="multipart/form-data" action="{{ route('send.message.admin') }}">
            @csrf
            <div class="row">
            
              <div class="col-md-6">
                <div class="col-md-12">
                  @include('partials.small.input_field', [
                    'field_name' => 'name',
                    'placeholder' => 'Név',
                    'type' => 'text'
                  ])
                  @include('partials.small.input_field', [
                    'field_name' => 'email',
                    'placeholder' => 'Email',
                    'type' => 'text'
                  ])
                  @include('partials.small.input_field', [
                    'field_name' => 'subject',
                    'placeholder' => 'Tárgy',
                    'type' => 'text'
                  ])
                </div>
              </div>

              <div class="col-md-6">
                <div class="col-md-12">
                  @include('partials.small.textarea', [
                    'field_name' => 'message',
                    'placeholder' => 'Üzenet',
                    'rows' => '5'
                  ])
                </div>
              </div>
            </div>
            <div class="row w-100">
              <div class="col-md-12">
                <div class="mt-3 mb-4 form-group w-100">
                  <div class="d-flex justify-content-center">
                      <button 
                        type="submit" 
                        class="p-2 contact_form_button btn btn-primary d-block w-50" 
                        onclick="validateContactForm(event)"
                      >
                          {{ __('Üzenet küldése') }}
                      </button>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
    </div>
  </div>
</div>
@endsection