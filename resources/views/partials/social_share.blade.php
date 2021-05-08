<div class="position-relative">
  <i 
    class="fas fa-share-alt {{ $main_icon_classes }}"
    style="cursor: pointer; color: #3390DC;"
    href="#{{ $collapse_id }}" role="button" aria-expanded="false" aria-controls="{{ $collapse_id }}"
    data-toggle="collapse"
  ></i>

  <div class="collapsing position-absolute social-popover" id="{{ $collapse_id }}">
    <div class="card" style="border-radius: 100px;">
      <div class="d-flex">
        {!! Share::page($url, null, ['class' => 'social-icons facebook'])
          ->facebook() !!}
        {!! Share::page($url, null, ['class' => 'social-icons twitter'])
          ->twitter() !!}
        {!! Share::page($url, null, ['class' => 'social-icons whatsapp'])
          ->whatsapp() !!}
        {!! Share::page($url, null, ['class' => 'social-icons pinterest'])
          ->pinterest() !!}
        {!! Share::page($url, null, ['class' => 'social-icons reddit'])
          ->reddit() !!}
      </div>
    </div>
  </div>
</div>
