<ul class="nav">
    @if(auth()->check())

    <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('result-upload-form')}}">Upload Results</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}">Logout</a>
    </li>
    @endif
</ul>