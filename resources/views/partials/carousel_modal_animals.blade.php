<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" interval="1000">
  <ol class="carousel-indicators">
    @isset($images)
      @foreach( $images as $image )
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
      @endforeach
    @endisset
  </ol>
  <div class="carousel-inner">
    @isset($images)
      @foreach($images as $image)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img class="d-block img-fluid" style="height: 30rem; max-width: 100%; width: auto;" src="/images/{{ $image->filename }}">
        </div>
      @endforeach
    @endisset
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Előző</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Következő</span>
  </a>
</div>