@extends('layouts.index')

@section('title', 'Rólunk mondták')

@section('cdn-files')
  <style>
    @media(max-width: 768px) {
      #review-card {
        flex-direction: column;
      }

      #review-text {
        margin-left: 0 !important;
      }

      #review-rating {
        margin-top: 20px;
        margin-left: 0 !important;
      }
    }

    @media(max-width: 600px) {
      #review-card {
        width: 100% !important;
      }
    }

    @media(max-width: 768px) {
      #review-button {
        top: -40px !important;
        right: 35% !important;
      }
    }

    @media(max-width: 420px) {
      #review-button {
        top: -40px !important;
        right: 30% !important;
      }
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="d-flex justify-content-center align-items-center flex-column">
      @if(!empty(Session::get('success')))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
      @endif
      @if(!empty(Session::get('error')))
        <div class="alert alert-danger"> {{ Session::get('error') }}</div>
      @endif
      <div class="position-relative w-100 d-flex justify-content-center align-items-center">
        <h1 class="mb-4">Rólunk mondták</h1>
        @if ($buttonFunction == 'create')
          <button 
            type="button" 
            class="btn btn-primary btn-sm position-absolute" 
            style="right: 0; top: 7px;" 
            id="review-button"
            data-toggle="modal" 
            data-target="#create-review"
          >Vélemény Létrehozása</button>
        @elseif ($buttonFunction == 'edit')
          <button 
            type="button" 
            class="btn btn-success btn-sm position-absolute" 
            style="right: 0; top: 7px;" 
            id="review-button"
            data-toggle="modal" 
            data-target="#create-review"
          >Vélemény Szerkesztése</button>
        @endif
      </div>

      @isset($reviews)
        @foreach($reviews as $review)
          <div class="card w-75 mb-3" id="review-card" style="box-shadow: 0 0 10px 4px rgba(0, 0, 0, .15);">
            <div class="card-body d-flex justify-content-center align-items-center" id="review-card">
              <img 
                src="{{$review->adoption->user->avatar_uri ? '/images/' . $review->adoption->user->avatar_uri : '/images/users/default-profile-image.jpg'}}"
                class="rounded-circle avatar img-thumbnail" 
                width="100px" 
              />
              <div>
                <div class="d-flex ml-5 justify-content-start align-items-center" id="review-rating">
                  <p class="card-text mr-2 mb-0">{{ $review->adoption->user->name }}</p>
                  {!! str_repeat('<i class="fas fa-star" style="color: orange;"></i>', $review->rating)  !!}
                  {!! str_repeat('<i class="far fa-star" style="color: orange;"></i>', 5 - $review->rating)  !!}
                </div>

                <p class="card-text ml-5" id="review-text">
                  <span style="font-size: 1rem;">“</span>
                  {{ $review->review }}
                  <span style="font-size: 1rem;">”</span>
                </p>
              </div>
            </div>
          </div>
        @endforeach
        @else
          <h3>Jelenleg nem elérhetőek a vélemények</h3>
      @endisset
    </div>
  </div>


  <div 
    class="modal fade show" 
    style="display:block;" 
    id="create-review" 
    role="dialog"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content w-100">
        <div class="modal-header">
          <h5 class="modal-title">Vélemény Létrehozása</h5>
          <button 
            type="button" 
            class="close" 
            data-dismiss="modal" 
            aria-label="Close" 
            onclick="document.getElementById('create-review').style.display = 'none'"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="form" action="{{ $myReview != null ? route('edit.review') : route('add.review') }}">
            @csrf
            <div class="form-group row">
              <label for="rating" class="col-md-2 col-form-label text-md-right">{{ __('Értékelés') }}</label>
              <div class="col-md-10">
                  <input 
                    id="rating" 
                    type="number" 
                    class="form-control @error('rating') is-invalid @enderror" 
                    name="rating" 
                    value="{{ $myReview != null ? old('rating', $myReview->rating) : old('rating') }}" 
                    autofocus
                    min="1" 
                    max="5"
                  >
                  @error('rating')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="rating" class="col-md-2 col-form-label text-md-right">{{ __('Vélemény') }}</label>
              <div class="col-md-10">
                  <textarea 
                    id="review" 
                    type="text" 
                    class="form-control @error('review') is-invalid @enderror" 
                    name="review" 
                    {{-- value="{{ $myReview != null ? old('review', $myReview->review) : old('review') }}"  --}}
                    autofocus
                    rows="4"
                  >
                    {{ $myReview != null ? old('review', $myReview->review) : old('review') }}
                  </textarea>
                  @error('review')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>

            <div class="form-group mb-0">
              <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary d-block">
                      {{ $myReview != null ? __('Vélemény módosítása') : __('Vélemény közzététele')}}
                  </button>
              </div>
            </div>

          </form>
        </div>
      </div>
  </div>
</div>
@endsection