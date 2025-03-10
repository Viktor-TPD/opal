<x-layout>

    <h1>Users</h1>
    
    <a href="{{ route('users.create') }}">New User</a>
    
    <form action="{{ route('users.index') }}" method="GET" class="search-form">
        <div>
            <select name="search_field">
                <option value="all" {{ request('search_field') == 'all' ? 'selected' : '' }}>All Fields</option>
                
                @foreach((new \App\Models\User())->getFillable() as $field)
                    @if($field !== 'password' && $field !== 'remember_token')
                        <option value="{{ $field }}" {{ request('search_field') == $field ? 'selected' : '' }}>
                            {{ ucfirst($field) }}
                        </option>
                    @endif
                @endforeach
            </select>
            
            <input 
                type="text" 
                name="search" 
                placeholder="Search users..." 
                value="{{ request('search') }}"
            >
            
            <button type="submit">Search</button>
            
            @if(request('search'))
                <a href="{{ route('users.index') }}">Clear search</a>
            @endif
        </div>
    </form>
    
    @if($users->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $users->links('vendor/pagination/simple-default') }}
    
    @else
        <p>No users found.</p>
    @endif
    
</x-layout>