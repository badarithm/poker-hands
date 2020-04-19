@if(auth()->check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">Poker Hands</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navbar">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{route('dashboard')}}">Dashboard</a>
                <a class="nav-item nav-link" href="{{route('result-upload-form')}}">Upload Results</a>
                <a class="nav-item nav-link" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
    </nav>
@endif