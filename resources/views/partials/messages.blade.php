@extends('layouts.index')

@section('title', 'Üzeneteim')

@section('cdn-files')
  <style>
    .active-option > h5 {
      color: #f3969a;
      background-color: #f1f1f1;
      border-radius: 0 100px 100px 0;
    }
    .active-option > h5:hover {
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

    .message-type:hover {
      color: black;
      background-color: #f1f1f1;
      border-radius: 0 100px 100px 0;
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
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="mt-2 col-md-2 d-flex flex-column" style="max-width: 250px; border-right: 10px solid #f3969a;">
        <a 
          href="{{ route('show.messages', ['type' => 'inbox']) }}"
          class="text-decoration-none {{ Request::is('messages/inbox') || Request::is('messages/inbox'. '/*') ? 'active-option' : '' }}"
        >
          <h5 class="py-2 message-type">Beérkező üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'sent']) }}"
          class="text-decoration-none {{ Request::is('messages/sent') || Request::is('messages/sent'. '/*') ? 'active-option' : '' }}"
        >
          <h5 class="py-2 message-type">Elküldött üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'archived']) }}"
          class="text-decoration-none {{ Request::is('messages/archived') || Request::is('messages/archived'. '/*') ? 'active-option' : '' }}"
        >
          <h5 class="py-2 message-type">Archivált üzenetek</h5>
        </a>
        <a 
          href="{{ route('show.messages', ['type' => 'trash']) }}"
          class="text-decoration-none {{ Request::is('messages/trash') || Request::is('messages/trash'. '/*') ? 'active-option' : '' }}"
        >
          <h5 class="py-2 message-type">Törölt üzenetek</h5>
        </a>
      </div>
      <div class="col-md-10">
        @yield('message_content')
      </div>
    </div>
  </div>
@endsection