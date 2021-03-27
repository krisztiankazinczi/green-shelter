<div class="row mt-5">
  @isset($animals)
    @if (@animals !== null)
      @foreach ($animals as $animal)
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
          <div class="d-flex justify-content-center h-100">
            @include('partials.info_card', ['animal' => $animal])
          </div>
        </div>
      @endforeach
    @endif
    @else
      <div class="col-12">
        <div class="d-flex justify-content-center">
          <h2>Meg nem toltottek fel hirdetest</h2>
        </div>
      </div>
  @endisset
</div>