<x-layout>

    <h1>Edit User</h1>
    
    <x-errors />
    
    <form method="post" action="{{ route('users.update', $user) }}">
        @method('PATCH')
    
    <x-users.form :user="$user" />
    
    </form>
    
</x-layout>