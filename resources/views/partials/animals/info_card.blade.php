@isset($animal)
  @include('partials.animals.modal', ['animal' => $animal])
  <div class="card w-75" style="min-width: 17rem; max-width: 25rem;">
    @foreach ($animal->images as $image)
      @if ($image->main)
        <img class="card-img-top img-fluid" style="height: 15rem;" src="/images/{{ $image->filename }}" alt={{ $animal->title }}>
      @endif
    @endforeach
    <div class="pb-2 card-body d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex justify-content-between position-relative">
          <h5 class="card-title type-link">{{ $animal->title }}</h5>
          <a href="/type/{{ $animal->animal_type_id }}">
            <h5 class="card-title btn btn-outline-success btn-sm position-absolute" style="top: -5px; right: 0;">{{ $animal->animalType->name }}</h5>
          </a>
        </div>
        <p class="card-text">{!! substr( $animal->description, 0, 150) . '...' !!}</p>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="mt-2 btn btn-primary" style="flex: 1;" data-toggle="modal" data-target="#{{ $animal->id }}">
          További Információ
        </button>
        <div class="d-flex flex-column align-items-center">
          <i class="mt-3 mb-0 ml-2 far fa-heart h3" style="cursor: pointer;"></i>
          <p class="mb-0 ml-2 text" style="margin-top: -2px;">
            @if(isset($animal->likesCount))
              @forelse($animal->likesCount as $likes)
                {{ $likes->totalLikes }}
              @empty
                0
              @endforelse
            @endif
          </p>
        </div>
      </div>
    </div>
  </div>
@endisset

<style>
  .type-link {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 60%;
  }
</style>
