<x-layout>

    <h1>{{ $user->name }}</h1>
    
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Member since:</strong> {{ $user->created_at->format('F j, Y') }}</p>
    
    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
    
    <form method="post" action="{{ route('users.destroy', $user) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Are you sure you want to delete this user?')">DELETE</button>
    </form>
    
    <br>
    
    <a href="{{ route('users.index') }}">Back to Users</a>
    
</x-layout>