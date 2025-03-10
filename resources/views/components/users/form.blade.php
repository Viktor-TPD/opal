@csrf
<div>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div>
    <label for="password">Password {{ isset($user->id) ? '(leave blank to keep current password)' : '' }}</label>
    <input type="password" name="password" id="password" {{ isset($user->id) ? '' : 'required' }}>
</div>

<div>
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" {{ isset($user->id) ? '' : 'required' }}>
</div>

<button>Save</button>
<br>
<a href="{{ route('users.index') }}">Back to Users</a>