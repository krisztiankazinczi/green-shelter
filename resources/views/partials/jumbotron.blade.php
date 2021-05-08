@isset($category)
    <div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/images/' . $category->image_uri }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 60vh;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    @if ($category->text_location === 'left')
                        <h1 class="p-4 text-white animals-jumbotron-title" style="background-color: rgba(0, 0, 0, 0.5)">{{ $category->menu->name }}</h1>
                        <h4 class="p-5 mt-5 text-white animals-jumbotron-description" style="background-color: rgba(0, 0, 0, 0.5)">{{ $category->description }}</h4>
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