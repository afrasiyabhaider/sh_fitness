@extends('layouts.app')
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{asset('public/dashboard/images/login.jpg')}}" alt="IMG"  width="500px">
                </div>
                {{-- {{ route('staff.login.submit') }} --}}
                <form class="login100-form" method="POST" action="">
                    @csrf
                    <input type="hidden" name="type" value="staff">
                    <span class="login100-form-title text-blue font-weight-bold">
                        <i class="fa fa-user-shield fa-2x"></i>
                        Portal Login
                    </span>

                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text text-blue">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-2 mt-3">
                        <div class="input-group-append">
                            <div class="input-group-text text-blue">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Remember Me --}}
                    {{-- <div class="form-group row">
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox form-check">
                                <input class="form-check-input custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label custom-control-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="container-login100-form-btn">
                        {{-- <a href="{{url('user/forget/password')}}" class="pb-2 font-weight-bolder text-blue">
                            <i class="fa fa-lock"></i>
                            Forget Password
                            <i class="fa fa-question"></i>
                        </a> --}}
                        <button class="login100-form-btn bg-dark-blue text-capitalize">
                            <i class="fa fa-sign-in-alt"></i>
                            &nbsp;Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
