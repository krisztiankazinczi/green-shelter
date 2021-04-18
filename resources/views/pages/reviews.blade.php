@extends('layouts.index')

@section('title', 'Rólunk mondták')

@section('cdn-files')
<style>
  @media(max-width: 768px) {
    #review-card {
      flex-direction: column;
    }

    #review-text {
      margin-top: 20px;
      margin-left: 0 !important;
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

      <h1 class="mb-4">Rólunk mondták</h1>

      @isset($reviews)
        @foreach($reviews as $review)
          <div class="card w-75 mb-3">
            <div class="card-body d-flex justify-content-center align-items-center" id="review-card">
              <img src="/images/{{ $review->adoption->user->avatar_uri }}" class="rounded-circle avatar img-thumbnail" width="100px"  />
              <div>
                <div class="d-flex ml-5 justify-content-start align-items-center">
                  <p class="card-text mr-2 mb-0">{{ $review->adoption->user->name }}</p>
                  {!! str_repeat('<i class="fas fa-star" style="color: orange;"></i>', $review->rating)  !!}
                  {!! str_repeat('<i class="far fa-star" style="color: orange;"></i>', 5 - $review->rating)  !!}
                </div>

                <p class="card-text ml-5" id="review-text">{{ $review->review }}</p>
              </div>
            </div>
          </div>
        @endforeach
        @else
          <h3>Jelenleg nem elérhetőek a vélemények</h3>
      @endisset
    </div>
  </div>
@endsection