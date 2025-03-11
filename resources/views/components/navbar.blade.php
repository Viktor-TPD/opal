<nav>

    <h1><a href="{{ route('home') }}">Opal</a></h1>
    
    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    @guest
    <div>
        <a class="linkButton" href="{{ route('show.login') }}">Login</a>
        <a class="linkButton" href="{{ route('show.register') }}">Register</a>
    </div>
    @endguest

    @auth
    <div class="authenticated">
        <img class="userIcon" src="{{ asset('images/user-icon.svg') }}">
        <span> {{ Auth::user()->name }} </span>
        <form action=" {{route('logout') }}" method=POST>
            @csrf
            <button>Logout</button>
        </form>
    </div>
    @endauth
</nav>