<!DOCTYPE html>
<html lang="en" >

<head>
    <title>Opal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">

</head>

<body>

    <header>
       <x-navbar />
    </header>

    <main>


        {{$slot}}

    </main>

</body>

</html>