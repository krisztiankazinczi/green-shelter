<div class="mt-5 mb-4 row">
  @isset($animals)
    @if ($animals !== null)
      @foreach ($animals as $animal)
        <div class="mb-4 col-12 col-md-6 col-lg-4 col-xl-3">
          <div class="d-flex justify-content-center h-100">
            @include('partials.animals.info_card', ['animal' => $animal])
          </div>
        </div>
      @endforeach
    @else
      <div class="col-12">
        <div class="d-flex justify-content-center">
          <h2> megadott keresési feltételekkel</h2>
        </div>
      </div>
    @endif 
  @endisset
</div>