@extends('partials.messages')

@section('message_content')
  @if ($isDesktop) 
    <table class="table">
      <tbody class="border-on-last">
        @isset($messages)
          @foreach($messages as $message)
            <tr class="table-row">
              <td class="p-2">
                <p class="ellipsis-10">
                  {{ $message->from->name }}
                </p>
              </td>
              <td class="p-2">
                <p class="ellipsis-20">
                  {{ $message->subject }}
                </p>
              </td>
              <td class="p-2">
                <p class="ellipsis-60">
                  {{ $message->message }}
                </p>
              </td>
              <td class="p-2">
                <p class="ellipsis-10">
                  {{ Date::parse($message->created_at)->format('F j') }}
                </p>
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
            <tr>
              <td class="p-2">
                <p class="ellipsis-10">
                  {{ $message->from->name }}
                </p>
              </td>
              <td class="p-2">
                <p class="ellipsis-20">
                  {{ $message->subject }}
                </p>
              </td>
              <td class="p-2">
                  <p class="ellipsis-10">
                    {{ Date::parse($message->created_at)->format('F j') }}
                  </p>
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

