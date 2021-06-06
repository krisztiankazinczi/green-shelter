@isset($category)
    <div class="mb-5" style="background: url({{ URL::to('/') . '/images/' . $category->image_uri }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 60vh;">
        <div class="container-fluid">
            <div class="row pt-5">
                <div class="col-md-6">
                    @if ($category->text_location === 'left')
                        <h1 class="p-4 text-white animals-jumbotron-title">{{ $category->menu->name }}</h1>
                        <h4 class="p-5 mt-5 text-white animals-jumbotron-description">{{ $category->description }}</h4>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($category->text_location === 'right')
                        <h1 class="p-4 text-white animals-jumbotron-title">{{ $category->menu->name }}</h1>
                        <h4 class="p-5 mt-5 text-white animals-jumbotron-description">{{ $category->description }}</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endisset