<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b2ec5d">
  <a class="navbar-brand" href="#"><img alt="logo" src="http://localhost:8000/images/logo.png"
         width="35" height="35"></a>
  <!-- Logot majd ide -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color: #b2ec5d">
    <ul class="ml-auto navbar-nav">
        @isset($menuItems)
          @foreach ($menuItems as $item)
            @if (isset($item->hasSubMenu))
              <li class="nav-item dropdown {{ Request::is($item->route) || Request::is($item->route . '/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ $item->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #caf38e">
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
              <i class="mb-0 far fa-user-circle h4" style="cursor: pointer;"></i>
            </a>
          </li>
          <li class="nav-item position-relative {{ Request::is('messages') || Request::is('messages'. '/*') ? 'active' : '' }}">
            <a class="nav-link" style="cursor: pointer;" href="{{ route('show.messages', ['type' => 'inbox']) }}">
              <i class="mb-0 far fa-envelope h4"></i>
              @if (Auth::user()->unreadMessages())
                <span class="badge badge-danger position-absolute" style="bottom: 7px; right: 2px;">
                  {{ Auth::user()->unreadMessages() }}
                </span>
              @endif
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