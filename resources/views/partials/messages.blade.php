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

    .table-row {
      width: 100%;
      cursor: pointer;
    }

    .table-row:hover {
      box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .ellipsis-10 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 8em;
      margin-bottom: 0;
    }
    .ellipsis-20 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 16em;
      margin-bottom: 0;
    }
    .ellipsis-60 {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 48em;
      margin-bottom: 0;
    }
    tr > td > a > p {
      color: black;
    }

    #messages-container {
      font-size: 16px;
    }
    @media (max-width: 1600px) {
      #messages-container {
        font-size: 14px;
      }
    }
    @media (max-width: 1470px) {
      #messages-container {
        font-size: 13px;
      }
    }
    @media (max-width: 1370px) {
      #messages-container {
        font-size: 12px;
      }
    }
    @media (max-width: 1280px) {
      #messages-container {
        font-size: 11px;
      }
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 d-flex flex-column">
        <a 
          href="{{ route('show.messages', ['type' => 'inbox']) }}"
          class="text-decoration-none {{ Request::is('messages/inbox') || Request::is('messages/inbox'. '/*') ? 'active-option' : '' }}"
        >
          <h5>Beérkező üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'sent']) }}"
          class="text-decoration-none {{ Request::is('messages/sent') || Request::is('messages/sent'. '/*') ? 'active-option' : '' }}"
        >
          <h5>Elküldött üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'archived']) }}"
          class="text-decoration-none {{ Request::is('messages/archived') || Request::is('messages/archived'. '/*') ? 'active-option' : '' }}"
        >
          <h5>Archivált üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'trash']) }}"
          class="text-decoration-none {{ Request::is('messages/trash') || Request::is('messages/trash'. '/*') ? 'active-option' : '' }}"
        >
          <h5>Törölt üzenetek</h5>
        </a>
      </div>
      <div class="col-md-10">
        @yield('message_content')
      </div>
    </div>
  </div>
@endsection