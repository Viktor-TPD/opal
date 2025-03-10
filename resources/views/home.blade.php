<x-layout>
    <article class="homeContainer">
        <h1>Welcome</h1>

        <a href=" {{route('products.index')}} ">Products</a>
        <br>
        <a href="{{ route('categories.index') }}">Categories</a>
        <br>
        @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('users.index') }}">Users Management</a>
        @endif
    </article>
</x-layout>