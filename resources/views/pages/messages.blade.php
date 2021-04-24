@extends('partials.messages')

@section('message_content')
  @if ($isDesktop) 
      @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
      @endif
      @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
      @endif
    <table class="table" id="messages-container">
      <tbody class="border-on-last">
        @isset($messages)
          @foreach($messages as $message)
              <tr class="table-row">
                <td class="p-2">
                  <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                    <p class="ellipsis-10">
                      {{ $message->from->name }}
                    </p>
                  </a>
                </td>
                <td class="p-2">
                  <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                    <p class="ellipsis-20">
                      {{ $message->subject }}
                    </p>
                  </a>
                </td>
                <td class="p-2">
                  <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                    <p class="ellipsis-60">
                      {{ $message->message }}
                    </p>
                  </a>
                </td>
                <td class="p-2">
                  <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                    <p class="ellipsis-10">
                      {{ Date::parse($message->created_at)->format('F j') }}
                    </p>
                  </a>
                </td>
              </tr>
          @endforeach
        @else
          <div class="d-flex justify-content-center align-items-center">
            <h3>Nem található üzenet ebben a mappában</h3>
          </div>
        @endisset
      </tbody>
    </table>
  @else 
    <table class="table mt-2">
      <tbody class="border-on-last">
        @isset($messages)
          @foreach($messages as $message)
            <tr class="table-row">
              <td class="p-2">
                <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                  <p class="ellipsis-10">
                    {{ $message->from->name }}
                  </p>
                </a>
              </td>
              <td class="p-2">
                <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                  <p class="ellipsis-20">
                    {{ $message->subject }}
                  </p>
                </a>
              </td>
              <td class="p-2">
                <a class="text-decoration-none" href="{{ route('show.message', ['type' => last(request()->segments()), 'id' => $message->id]) }}">
                  <p class="ellipsis-10">
                    {{ Date::parse($message->created_at)->format('F j') }}
                  </p>
                </a>
              </td>
            </tr>
          @endforeach
        @else
          <div class="d-flex justify-content-center align-items-center">
            <h3>Nem található üzenet ebben a mappában</h3>
          </div>
        @endisset
      </tbody>
    </table>
  @endif
@endsection

