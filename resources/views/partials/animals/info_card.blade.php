@isset($animal)
  @include('partials.animals.modal', ['animal' => $animal])
  <div class="card w-75" style="min-width: 17rem; max-width: 25rem;">
    @foreach ($animal->images as $image)
      @if ($image->main)
        <img class="card-img-top img-fluid" style="height: 15rem;" src="/images/{{ $image->filename }}" alt={{ $animal->title }}>
      @endif
    @endforeach
    <div class="card-body d-flex flex-column justify-content-between">
      <div>
        <h5 class="card-title">{{ $animal->title }}</h5>
        <p class="card-text">{!! substr( $animal->description, 0, 150) . '...' !!}</p>
      </div>
      <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#{{ $animal->id }}">
        További Információ
      </button>
    </div>
  </div>
@endisset
