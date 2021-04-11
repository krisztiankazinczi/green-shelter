<div class="d-flex flex-column align-items-center">
  @if (Auth::user()->likesById($animal_id))
  <i class="mt-3 mb-0 ml-2 fas fa-heart h3" style="cursor: pointer; color: red;"></i>
  @else
  <i class="mt-3 mb-0 ml-2 far fa-heart h3" style="cursor: pointer;"></i>
  @endif
  <p class="mb-0 ml-2 text" style="margin-top: -2px;">
    @if(isset($likesCount))
      @forelse($likesCount as $likes)
        {{ $likes->totalLikes }}
      @empty
        0
      @endforelse
    @endif
  </p>
</div>