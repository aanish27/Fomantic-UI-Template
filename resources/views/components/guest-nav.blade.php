@props([
    'page' => null,
])

<div class="ui menu">
    <a href="/" class="item">Home</a>
    <a class="item">Contact</a>
    <div class="right menu">
        @if ($page !== 'login')
            <a href="{{ route('login') }}" class="item">Sign In</a>
        @endif
        <a href="{{ route('register') }}" class="item">Sign Up</a>
    </div>
</div>
