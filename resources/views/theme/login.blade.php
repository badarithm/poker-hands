@extends('theme.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
                <div class="col-xs-12" style="height:150px;"></div>
                <div class="card">
                    <div class="card-body">
                    <form method="POST" action="{{route('login-action')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email-address-field">Your email address</label>
                            <input name="email" type="email" class="form-control" id="email-address-field" aria-describedby="email-messages" placeholder="Enter your email address">
                            <small id="email-messages" class="form-text text-muted">
                                @if ($errors->has('email'))
                                    {{implode(' ', $errors->get('email'))}}
                                @endif
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password-field">Password</label>
                            <input name="password" type="password" class="form-control" id="password-field" aria-describedby="password-messages" placeholder="Password">
                            <small id="password-messages" class="form-text text-muted">
                                @if ($errors->has('email'))
                                    {{implode(' ', $errors->get('email'))}}
                                @endif
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection