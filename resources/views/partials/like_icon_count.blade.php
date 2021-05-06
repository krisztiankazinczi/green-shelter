<div class="d-flex flex-column align-items-center">
  @if (Auth::user() && Auth::user()->likesById($animal_id))
    <form 
      action="{{ route('toggle.like', ['animal_id' => $animal_id]) }}" 
      method="POST"
      id="like-{{$animal->id}}"
    >
      @csrf
      @method('PUT')
        <i 
          class="@isset($icon_classes) {{ $icon_classes }} @endisset fas fa-heart" 
          style="cursor: pointer; color: red;"
          onclick="submitLike('{{$animal->id}}')"
        ></i>
    </form>
  @else
  <form 
    action="{{ route('toggle.like', ['animal_id' => $animal_id]) }}" 
    method="POST"
    id="like-{{$animal->id}}"
  >
    @csrf
    @method('PUT')
      <i 
        class="@isset($icon_classes) {{ $icon_classes }} @endisset far fa-heart" 
        @if (Auth::user()) style="cursor: pointer;" @endif
        @if (Auth::user()) onclick="submitLike('{{$animal->id}}')" @endif
      ></i>
  </form>
  
  @endif
  @isset($is_count)
    <p class="mb-0 ml-2 text" style="margin-top: -2px;">
      @if(isset($likesCount))
        @forelse($likesCount as $likes)
          {{ $likes->totalLikes }}
        @empty
          0
        @endforelse
      @endif
    </p>
  @endif
</div>

<script>
  function submitLike(animal_id) {
    document.getElementById(`like-${animal_id}`).submit();
  }
</script>