@if(auth()->check())
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="">Poker Hands</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navbar">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{route('dashboard')}}">Dashboard</a>
                <a class="nav-item nav-link" href="{{route('result-upload-form')}}">Upload</a>
                <a class="nav-item nav-link" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="btn btn-light">
                        Victories <span class="badge badge-danger">{{auth()->user()->victories_count}}</span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@endif