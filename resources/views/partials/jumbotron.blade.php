<div class="jumbotron jumbotron-fluid" style="background: url({{ URL::to('/') . '/' . $category->image_uri }}) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 60vh;">
<!-- <div class="jumbotron jumbotron-fluid" style="background: url(images/dog1.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 60vh;"> -->
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <h1>{{ $category->title }}</h1>
                <h2>{{ $category->description }}</h2>
            </div>
        </div>
      </div>
</div>