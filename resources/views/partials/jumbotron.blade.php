@isset($category)
    <div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/images/' . $category->image_uri }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 60vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @if ($category->text_location === 'left')
                        <h1>{{ $category->title }}</h1>
                        <h2>{{ $category->description }}</h2>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($category->text_location === 'right')
                        <h1>{{ $category->title }}</h1>
                        <h2>{{ $category->description }}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endisset