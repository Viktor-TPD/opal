<x-layout>
    <article class="paddingContainer">
        <h1>Edit</h1>

        <x-errors />

        <form method="post" action="{{ route('categories.store') }}">

            <x-categories.form :category="$category" />

        </form>
    </article>
</x-layout>