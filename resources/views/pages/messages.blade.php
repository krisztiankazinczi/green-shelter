@extends('layouts.index')

@section('title', 'Üzeneteim')

@section('cdn-files')
  <style>
    .active-option {
      color: red;
    }
    .active-option:hover {
      color: darkred;
      text-decoration: none;
    }
    .border-on-last:last-child {
      border-bottom: 1px solid #DEE2E6;
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 d-flex flex-column">
        <a 
          href="{{ route('show.messages', ['type' => 'inbox']) }}"
          class="text-decoration-none {{ last(request()->segments()) == 'inbox' ? 'active-option' : '' }}"
        >
          <h5>Beérkező üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'sent']) }}"
          class="text-decoration-none {{ last(request()->segments()) == 'sent' ? 'active-option' : '' }}"
        >
          <h5>Elküldött üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'archived']) }}"
          class="text-decoration-none {{ last(request()->segments()) == 'archived' ? 'active-option' : '' }}"
        >
          <h5>Archivált üzenetek</h5>
        </a>
      </div>
      <div class="col-md-10">
        <table class="table mt-2">
          <tbody class="border-on-last">
            <tr>
              <td>Username</td>
              <td>Subject subject</td>
              <td>Message egy reszeMessage egy reszeMessage egy reszeMessage egy resze</td>
              <td>Apr 23.</td>
            </tr>
            <tr>
              <td>Username</td>
              <td>Subject subject</td>
              <td>Message egy reszeMessage egy reszeMessage egy reszeMessage egy resze</td>
              <td>Apr 23.</td>
            </tr>
            <tr>
              <td>Username</td>
              <td>Subject subject</td>
              <td>Message egy reszeMessage egy reszeMessage egy reszeMessage egy resze</td>
              <td>Apr 23.</td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection