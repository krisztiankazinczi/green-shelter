<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Logo</a>
  <!-- Logot majd ide -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="ml-auto navbar-nav">
        @isset($menuItems)
          @foreach ($menuItems as $item)
            @if (isset($item->hasSubMenu))
              <li class="nav-item dropdown {{ Request::is($item->route) || Request::is($item->route . '/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ $item->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach ($menuItems as $item1)
                    @if ($item->id == $item1->parent)
                      @if ($item1->role_id > 1)
                        @if (Auth::user() != null && $item1->role_id <= Auth::user()->role_id)
                          <a class="dropdown-item" href="/{{$item->route}}/{{$item1->route}}">{{ $item1->name }}</a>
                        @endif
                      @else 
                        <a class="dropdown-item" href="/{{$item->route}}/{{$item1->route}}">{{ $item1->name }}</a>
                      @endif    
                    @endif
                  @endforeach
                </div>
              </li>
            @elseif ($item->parent == 0)
              @if ($item->role_id > 1)
                @if (Auth::user() != null && $item->role_id <= Auth::user()->role_id)
                  <li class="nav-item {{ Request::is($item->route) || Request::is($item->route . '/*') ? 'active' : '' }}">
                  
                    <a class="nav-link" href="/{{$item->route}}">{{ $item->name }}<span class="sr-only">(current)</span></a>
                  </li>
                @endif
              @else 
                <li class="nav-item {{ Request::path() == $item->route ? 'active' : '' }}">
                  <a class="nav-link" href="/{{$item->route}}">{{ $item->name }}<span class="sr-only">(current)</span></a>
                </li>
              @endif
            @endif
          @endforeach
        @endisset
        @auth
          <li class="nav-item {{ Request::path() == 'my-likes' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('my.likes') }}">
              <i class="mb-0 h4 far fa-heart" style="cursor: pointer;"></i>
            </a>
          </li>
          <li class="nav-item {{ Request::path() == 'profile' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('show.profile') }}">
              <i class="far fa-user-circle mb-0 h4" style="cursor: pointer;"></i>
            </a>
          </li>
        @endauth
      </ul>
      <div class="ml-auto">
        @auth
          <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form> 
        @else
          <div class="d-flex">
            <a class="nav-item nav-link d-block" href="{{ route('login') }}">Bejelentkezés</a>
            <a class="nav-item nav-link d-block" href="{{ route('register') }}">Regisztráció</a>
          </div>
        @endauth
      </div>
  </div>
</nav>