<nav class="navbar navbar-expand-lg navbar-light bg-primary py-0 navbar-customization">
  <a class="navbar-brand text-white text-decoration-none" style="font-size: 20px;" href="{{ route('home') }}">Zöldmenedék</a>
  <!-- Logot majd ide -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse bg-primary" id="navbarSupportedContent">
    <ul class="ml-auto navbar-nav">
        @isset($menuItems)
          @foreach ($menuItems as $item)
            @if (isset($item->hasSubMenu))
              <li class="nav-item dropdown py-2 {{ Request::is($item->route) || Request::is($item->route . '/*') ? 'bg-secondary' : '' }}">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ $item->name }}
                </a>
                <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                  @foreach ($menuItems as $item1)
                    @if ($item->id == $item1->parent)
                      @if ($item1->role_id > 1)
                        @if (Auth::user() != null && $item1->role_id <= Auth::user()->role_id)
                          <a class="dropdown-item text-white" href="/{{$item->route}}/{{$item1->route}}">{{ $item1->name }}</a>
                        @endif
                      @else 
                        <a class="dropdown-item text-white" href="/{{$item->route}}/{{$item1->route}}">{{ $item1->name }}</a>
                      @endif    
                    @endif
                  @endforeach
                </div>
              </li>
            @elseif ($item->parent == 0)
              @if ($item->role_id > 1)
                @if (Auth::user() != null && $item->role_id <= Auth::user()->role_id)
                  <li class="nav-item py-2 {{ Request::is($item->route) || Request::is($item->route . '/*') ? 'bg-secondary' : '' }}">
                  
                    <a class="nav-link text-white" href="/{{$item->route}}">{{ $item->name }}<span class="sr-only">(current)</span></a>
                  </li>
                @endif
              @else 
                <li class="nav-item py-2 {{ Request::path() == $item->route ? 'bg-secondary' : '' }}">
                  <a class="nav-link text-white" href="/{{$item->route}}">{{ $item->name }}<span class="sr-only">(current)</span></a>
                </li>
              @endif
            @endif
          @endforeach
        @endisset
        @auth
          <li class="nav-item py-2 {{ Request::path() == 'my-likes' ? 'bg-secondary' : '' }}">
            <a class="nav-link" href="{{ route('my.likes') }}">
              <i class="mb-0 h4 far fa-heart text-white" style="cursor: pointer;"></i>
            </a>
          </li>
          <li class="nav-item py-2 {{ Request::path() == 'profile' ? 'bg-secondary' : '' }}">
            <a class="nav-link" href="{{ route('show.profile') }}">
              <i class="mb-0 far fa-user-circle h4 text-white" style="cursor: pointer;"></i>
            </a>
          </li>
          <li class="nav-item position-relative py-2 {{ Request::is('messages') || Request::is('messages'. '/*') ? 'bg-secondary' : '' }}">
            <a class="nav-link" style="cursor: pointer;" href="{{ route('show.messages', ['type' => 'inbox']) }}">
              <i class="mb-0 far fa-envelope h4 text-white"></i>
              @if (Auth::user()->unreadMessages())
                <span class="badge badge-danger position-absolute unread-messages-number">
                  {{ Auth::user()->unreadMessages() }}
                </span>
              @endif
            </a>
          </li>
        @endauth
      </ul>
      <div class="ml-auto">
        @auth
          <a class="nav-item nav-link text-white on-hover" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kijelentkezés</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form> 
        @else
          <div class="d-flex">
            <a class="nav-item nav-link d-block text-white on-hover" href="{{ route('login') }}">Bejelentkezés</a>
            <a class="nav-item nav-link d-block text-white on-hover" href="{{ route('register') }}">Regisztráció</a>
          </div>
        @endauth
      </div>
  </div>
</nav>

<style>
  ul > li:hover {
    background-color: #f3969a;
  }
  .on-hover:hover {
    background-color: #f3969a;
  }
</style>