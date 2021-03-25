<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content w-100">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          {{-- <img class="img-fluid" style="height: 30rem; max-width: 100%;" src="images/dog2.jpeg" alt="Card image cap"> --}}
          @include('partials.carousel_modal_animals')
        </div>
        <div class="mt-4">
          <h5>
            Otthont keres Kóbor János! Kóbor János gazdátlanul, magányosan rótta az utcákat, mielőtt a menhelyre került. Már lassan egy éve lakónk. Gyönyörű, selymes, szürke-cirmos bundájú, 3 év körüli hatalmas kandúr. Tiszteletet parancsoló külseje egy bújós, végtelenül kedves, szeretetigényes kiscicát takar. Tökéletes családi kedvenc lehetne, ha végre rátalálna az igazi gazdi.
Telefon: 06 20 667 6281. Látogatni a Vác-Máriaudvar, Kamillai utcai telephelyen lehet.
          </h5>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">View</button>
        <button type="button" class="btn btn-primary">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>