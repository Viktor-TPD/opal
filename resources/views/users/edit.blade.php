<x-layout>
    <article class="paddingContainer">
        <h1>Edit User</h1>

        <x-errors />

        <form method="post" action="{{ route('users.update', $user) }}">
            @method('PATCH')

            <x-users.form :user="$user" />

        </form>
    </article>
</x-layout>