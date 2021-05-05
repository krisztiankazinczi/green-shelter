@isset($animal)
  @include('partials.animals.modal', ['animal' => $animal])
  <div class="card w-75" style="min-width: 17rem; max-width: 25rem; box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15);">
    @foreach ($animal->images as $image)
      @if ($image->main)
      <div class="d-flex justify-content-center">
        <img  style="height: 12rem; width: auto; max-width: 100%;" src="/images/{{ $image->filename }}" alt={{ $animal->title }}>
      </div>
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
        @include('partials.like_icon_count', [
          'likesCount' => $animal->likesCount, 
          'animal_id' => $animal->id,
          'icon_classes' => 'mt-3 mb-0 ml-2 h3',
          'is_count' => true
        ])
        @auth
          <div>
            <i 
              class="far fa-envelope-open mt-3 mb-0 ml-2 h3"
              style="cursor: pointer; color: #38C172"
              data-toggle="modal" 
              data-target="#send-message-{{ $animal->id }}"
            ></i>
            @include('partials.modal_send_message', [
              'modal_id' => "send-message-" . $animal->id,
              'from_id' => Auth::user()->id,
              'to_id' => $animal->user_id,
              'animal_id' => $animal->id,
              'subject' => '',
              'cbFunction' => 'closeModal("{{send-message-$animal->id}}")'
            ])
          </div>
        @endauth
        @include('partials.social_share', [
          'main_icon_classes' => 'mt-3 mb-0 ml-2 h3',
          'collapse_id' => $animal->id . '-collapse',
          'url' => Request::url() . '/' . $animal->id,
        ])
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

<script>
  const closeModal = (modal_id) => {
    $(`#${modal_id}`).modal('hide');
  }
</script>
