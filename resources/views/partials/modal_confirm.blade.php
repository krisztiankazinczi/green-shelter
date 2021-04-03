<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex flex-row justify-content-between">
          <h5 class="modal-title">{{ $question }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="d-flex flex-row justify-content-between mt-3 ml-5 mr-5">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
            <form action="{{ route( $route, $route_params) }}" method="POST">
              @csrf
              @method($method)
              <button type="submit" class="{{ $action_button_class }}">{{ $action_button_text }}</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>