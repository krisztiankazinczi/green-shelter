<div class="position-relative">
  <i 
    class="fas fa-share-alt {{ $main_icon_classes }}"
    style="cursor: pointer; color: #3390DC;"
    href="#{{ $collapse_id }}" role="button" aria-expanded="false" aria-controls="{{ $collapse_id }}"
    data-toggle="collapse"
  ></i>

  <div class="collapsing position-absolute" style="top: -40px; left: -90px; width: 220px; z-index: 1000;" id="{{ $collapse_id }}">
    <div class="card" style="border-radius: 100px;">
      <div class="d-flex">
        {!! Share::page('http://jorenvanhocht.be', null, ['class' => 'social-icons'])
          ->facebook() !!}
        {!! Share::page('http://jorenvanhocht.be', null, ['class' => 'social-icons'])
          ->twitter() !!}
        {!! Share::page('http://jorenvanhocht.be', null, ['class' => 'social-icons'])
          ->whatsapp() !!}
        {!! Share::page('http://jorenvanhocht.be', null, ['class' => 'social-icons'])
          ->pinterest() !!}
        {!! Share::page('http://jorenvanhocht.be', null, ['class' => 'social-icons'])
          ->reddit() !!}
      </div>
    </div>
  </div>
</div>

<style>
  #social-links > ul {
    margin-bottom: 0;
    padding: 5px;
    padding-left: 10px;
    padding-bottom: 3px;
  }
  .social-icons > span {
    font-size: 30px;
  }

</style>