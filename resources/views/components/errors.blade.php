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