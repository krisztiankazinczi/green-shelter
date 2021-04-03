<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background-color: black; border: none;">
      <div class="modal-body">
        <div class="d-flex justify-content-center position-relative">
          <img src="{{ $image_path }}" alt="{{ $image_alt }}" style="max-width: 100%; height: 800px !important; object-fit: contain;" />
        </div>
        <button 
          type="button" 
          class="close position-absolute" 
          data-dismiss="modal" 
          aria-label="Close"
          style="top: 30px; right: 45px;"
        >
          <span style="font-size: 40px;" aria-hidden="true">&times;</span>
        </button>
        <a 
          href="{{ $link_to_advertisement }}"
        >
          <button 
            type="button" 
            class="position-absolute btn btn-primary" 
            style="bottom: 30px; right: 30px;"
          >
            Részletek
          </button>
        </a>
      </div>
    </div>
  </div>
</div>

<style>

.modal-backdrop.show {
   background-color: black;
   opacity: 0.50;
}
</style>