@extends('layouts.login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="login-title">Log in</h2>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group d-flex justify-content-between">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="input-span"></span>Remember me</label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('msg.forget_password') }}
                </a>
            @endif
        </div>
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Login</button>
        </div>
    </form>
@endsection
