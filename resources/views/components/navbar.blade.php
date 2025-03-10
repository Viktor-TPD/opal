<header>
    <nav>
        <h1>Opal</h1>

        @guest
        <div>
            <a href="{{ route('show.login') }}">Login</a>
            <a href="{{ route('show.register') }}">Register</a>
        </div>
        @endguest

        @auth
        <div class="authenticated">
            <span> User: {{ Auth::user()->name }} </span>
            <form action=" {{route('logout') }}" method=POST>
                @csrf
                <button>Logout</button>
            </form>
        </div>
        @endauth
    </nav>
</header>