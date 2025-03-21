<x-layout>
    <article class="registerContainer">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <h2>Register an Account</h2>

            <label for="name">Name:</label>
            <input
                type="text"
                name="name"
                required
                value="{{ old('name') }}">

            <label for="email">Email:</label>
            <input
                type="email"
                name="email"
                required
                value="{{ old('email') }}">

            <label for="password">Password:</label>
            <input
                type="password"
                name="password"
                required>

            <label for="password_confirmation">Confirm Password:</label>
            <input
                type="password"
                name="password_confirmation"
                required>

            <button type="submit">Register</button>

            <!-- Validation Errors -->
            @if ($errors->any())
            <ul class="error-container error-user-form">
                @foreach ($errors->all() as $error)
                <div class="error-text-container">
                    <img class="warningIcon" src="{{ asset('images/warning.svg') }}">
                    <li class="error-item">{{ $error }}</li>
                </div>
                @endforeach
            </ul>
            @endif
        </form>
    </article>


</x-layout>