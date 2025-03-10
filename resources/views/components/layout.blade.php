<!DOCTYPE html>
<html lang="en" >

<head>
    <title>Opal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body>

    <header>
       <x-navbar />
    </header>

    <main>

        @if (session('status'))
        <div>{{ session('status') }}</div>
        @endif

        {{$slot}}

    </main>

</body>

</html>