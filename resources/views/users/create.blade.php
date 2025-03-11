<x-layout>
    <article class="paddingContainer">
        <h1>New User</h1>

        <x-errors />

        <form method="post" action="{{ route('users.store') }}">

            <x-users.form :user="$user" />

        </form>
    </article>
</x-layout>