<x-layout>
    <article class="paddingContainer">
        <article class="showContainer">
            <article class="editContainer">
                <h1>{{ $user->name }}</h1>

                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Member since:</strong> {{ $user->created_at->format('F j, Y') }}</p>

                <a class="linkButton" href="{{ route('users.edit', $user->id) }}">Edit</a>

                <form method="post" action="{{ route('users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button class="deleteButton" onclick="return confirm('Are you sure you want to delete this user?')">DELETE
                        <img class="trashIcon" src="{{ asset('images/trash.svg') }}">
                    </button>
                </form>

                <br>

                <a class="linkButton" href="{{ route('users.index') }}">Back to Users</a>
            </article>
        </article>
    </article>
</x-layout>