@extends('Dashboard.Auth.Layouts.master')

@section('title')
    {{ trans('dashboard.Login') }}
@endsection

@section('meta_description_keywords_author')
    <meta name="description" content="Oculux Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">
@endsection


@section('content')
    <div class="auth-main particles_js">
        <div class="auth_div vivify popIn">
            <div class="auth_brand">
                <a class="navbar-brand" href="javascript:void(0);">
                    <img src="{{ asset('shams/dashboard/general_assets/assets/images/icon.svg')}}" width="30" height="30" class="mr-2 align-top d-inline-block" alt="">
                    {{ trans('dashboard.Shams') }}
                </a>
            </div>
            <div class="card">
                <div class="body">
                    <p class="lead">
                        {{ trans('dashboard.Login_To_Your_Account') }}
                    </p>
                    <form class="form-auth-small m-t-20" method="post" action="{{ route('dashboard.auth.login',['locale'=>app()->getLocale()]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="signin-email" class="sr-only control-label">
                                {{ trans('dashboard.Email') }}
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control round
                                       @error('email')
                                            is-invalid
                                        @enderror"
                                id="signin-email"
                                placeholder="{{ trans('dashboard.Email') }}"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="signin-password" class="sr-only control-label">
                                {{ trans('dashboard.Password') }}
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control round
                                        @error('password')
                                            is-invalid
                                        @enderror"
                                id="signin-password"
                                placeholder="{{ trans('dashboard.Password') }}"
                            >
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="clearfix form-group">
                            <label class="fancy-checkbox element-left">
                                <input type="checkbox" name="remember" value="1">
                                <span>Remember me</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                        <div class="bottom">
                            <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span>
                            <span>Dont have an account? <a href="page-register.html">Register</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="particles-js"></div>
    </div>
@endsection


