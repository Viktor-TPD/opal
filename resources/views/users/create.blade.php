<x-layout>

    <h1>New User</h1>
    
    <x-errors />
    
    <form method="post" action="{{ route('users.store') }}">
    
    <x-users.form :user="$user" />
    
    </form>
    
</x-layout>