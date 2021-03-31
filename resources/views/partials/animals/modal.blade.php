<div class="modal fade" id="{{ $animal->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content w-100">
      <div class="modal-header">
        <h5 class="modal-title">{{ $animal->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          @include('partials.animals.carousel', ['images', $images = $animal->images])
        </div>
        <div class="mt-4">
          <h5>
            {!! $animal->description !!}
          </h5>
        </div>
      </div>
      <div class="modal-footer">
        <a href="/{{ $route }}/{{ $animal->id }}">
          <button type="button" class="btn btn-secondary">Megtekintés</button>
        </a>
        @if (Auth::user() && ($animal->user_id == Auth::user()->id || Auth::user()->role_id == 3))
          <a href="/{{ $route }}/{{ $animal->id }}/edit">
            <button type="button" class="btn btn-primary">Szerkesztés</button>
          </a>
          <button type="button" class="btn btn-danger">Törlés</button>
        @endif
      </div>
    </div>
  </div>
</div>