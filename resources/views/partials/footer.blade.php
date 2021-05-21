<div class="container-fluid bg-dark">
  <div class="container bg-dark text-white">
    <div class="row p-3">
      <h2 class="text-primary mx-auto" style="letter-spacing: 5px;">Zöldmenedék</h2>
    </div>
      <hr class="mt-0 border-white" />
    <div class="row mt-4">
      @include('partials.small.footer_option', [ 'route' => route('home'), 'text' => 'Kezdőlap' ])
      @include('partials.small.footer_option', [ 'route' => route('show.list.pages', ['page' => 'dogs']), 'text' => 'Gazdira váró kutyák' ])
      @include('partials.small.footer_option', [ 'route' => route('show.list.pages', ['page' => 'cats']), 'text' => 'Gazdira váró macskák' ])
      @include('partials.small.footer_option', [ 'route' => route('show.list.pages', ['page' => 'lost-dogs']), 'text' => 'Elveszett kutyák' ])
      @include('partials.small.footer_option', [ 'route' => route('show.list.pages', ['page' => 'found-dogs']), 'text' => 'Talált kutyák' ])
      @include('partials.small.footer_option', [ 'route' => route('show.list.pages', ['page' => 'advertisement']), 'text' => 'Lakossági hirdetések' ])
      @include('partials.small.footer_option', [ 'route' => route('animal.of.week'), 'text' => 'A hét állata' ])
      @include('partials.small.footer_option', [ 'route' => route('success.stories'), 'text' => 'Sikertörténetek' ])
      @include('partials.small.footer_option', [ 'route' => route('gallery'), 'text' => 'Képgaléria' ])
      @include('partials.small.footer_option', [ 'route' => route('about.us'), 'text' => 'Rólunk' ])
      @include('partials.small.footer_option', [ 'route' => route('reviews'), 'text' => 'Rólunk mondták' ])
      @include('partials.small.footer_option', [ 'route' => route('contact.details'), 'text' => 'Kapcsolat' ])
    </div>
    <div class="row bg-primary mt-3">
      <h6 class="mx-auto text-dark mb-0 py-2 ">Az eredeti oldal: 
        <a href="http://www.zoldmenedek.hu" class="text-dark">
          Zöldmenedek.hu
        </a>
      </h6>
    </div>
  </div>
</div>