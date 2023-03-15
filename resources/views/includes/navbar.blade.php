<nav class="container navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Portfolio</a>
    
    @auth
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link @if (Route::is('admin.home')) text-primary active @endif" aria-current="page" href="{{ route('admin.home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Route::is('admin.projects.index')) text-primary active @endif" href="{{ route('admin.projects.index') }}">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if (Route::is('admin.technologies.index')) text-primary active @endif" href="{{ route('admin.technologies.index') }}">Technologies</a>
        </li>                       
      </ul>
    </div>

    <div class="collapse navbar-collapse" style="flex-grow:0">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admin.home') }}">{{__('Home')}}</a>
                <!-- <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a> -->
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>             
      </ul>
    </div>
    @endauth
    @guest
    <div class="collapse navbar-collapse" style="flex-grow:0">
      <a class="nav-link" href="{{ route('admin.home') }}">Login</a>
    </div>
    @endguest
  </div>
</nav>