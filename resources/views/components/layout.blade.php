<!DOCTYPE html>
<html lang="en">

<head>
    <title>Opal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

</head>

<body>

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

    <main>

        @if (session('status'))
        <div>{{ session('status') }}</div>
        @endif

        {{$slot}}

    </main>

</body>

</html>