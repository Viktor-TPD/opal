<x-layout>
    <section class="index-layout">
        <aside class="index-sidebar"> 
            <div class="sidebar-top">
               <h1 class="sidebar-title">Users</h1>
               <a href="{{ route('users.create') }}" class="add-new-item">+ Add New User</a>
              <h1 class="sidebar-title">Search:</h1>
                 <form action="{{ route('users.index') }}" method="GET" class="search-form">
                <div class="search-container">
                    <select name="search_field" class="search-select">
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
                    class="search-input"
                >
                <button type="submit" class="search-button">Search</button>
                @if(request('search'))
                    <a href="{{ route('users.index') }}" class="clear-search">Clear search</a>
                @endif
            </div>
        </form>
    </div>
    <section class="navbar-footer">
        <a href="{{ route('home')}}" class="nav-link">Home</a>
        <a href="{{ route('products.index')}}" class="nav-link">Products</a>
        <a href="{{ route('categories.index')}}" class="nav-link">Categories</a>
    </section>
    </aside>

        <!-- Main Content -->
        <div class="index-content">
            @if($users->count() > 0)
                <div class="index-table-container">
                    <table class="index-table">
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
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="category-link">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="category-link">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-container">
                    {{ $users->links('vendor/pagination/bootstrap-4') }}
                </div>
            @else
                <p class="no-results">No users found.</p>
            @endif
        </div>
    </section>
</x-layout>