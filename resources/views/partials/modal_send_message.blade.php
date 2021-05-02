<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content w-100">
      <div class="modal-header">
        <h5 class="modal-title">Üzenet küldése</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('partials.send_message', [
          'from_id' => $from_id,
          'to_id' => $to_id,
          'animal_id' => $animal_id ,
          'subject' => $subject,
          'cbFunction' => $cbFunction,
        ])
      </div>
    </div>
  </div>
</div>