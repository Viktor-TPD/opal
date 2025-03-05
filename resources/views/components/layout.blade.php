<!DOCTYPE html>
<html lang="en">

<head>
    <title>Opal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>

    <header>
        <nav>
            <h1>Opal</h1>

            <a href="{{ route('show.login') }}">Login</a>
            <a href="{{ route('show.register') }}">Register</a>

            @auth
            <span> user: {{ Auth::user()->name }} </span>
            <form action=" {{route('logout') }}" method=POST>
                @csrf
                <button>Logout</button>
            </form>
            @endauth
        </nav>
    </header>

    @if (session('status'))
    <div>{{ session('status') }}</div>
    @endif

    {{$slot}}

</body>

</html>