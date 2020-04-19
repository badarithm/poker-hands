<ul class="nav">
    @if(auth()->check())

    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('result-upload-form')}}">Upload Results</a>
    </li>
    <li class="nav-item">
        @if(auth()->check())
            <a class="nav-link disabled" href="{{route('logout')}}">Logout</a>
        @else
            <a class="nav-link disabled" href="{{route('login')}}">Login</a>
        @endif
    </li>

    @endif
</ul>