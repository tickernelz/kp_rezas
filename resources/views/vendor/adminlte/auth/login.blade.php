@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('plugins.Select2', true)

@section('title', 'Login')

@section('auth_body')
    <form action="{{ route('post-login') }}" method="post">
        {{ csrf_field() }}

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                {{ Session::get('error') }}
            </div>
        @endif

        {{-- Bidang field --}}
        <x-adminlte-select2 name="bidang" data-placeholder="Pilih Bidang..." autofocus>
            <option></option>
            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
            @foreach($bidang as $list)
                <option
                    value="{{ $list }}">{{ $list }}</option>
            @endforeach
        </x-adminlte-select2>
        @if($errors->has('bidang'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('bidang') }}</strong>
            </div>
        @endif

        {{-- Username field --}}
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                   value="{{ old('username') }}" placeholder="Username" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('username'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                </div>
            </div>
            <div class="col-5">
                <button type=submit
                        class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
@stop

@section('auth_footer')
    {{-- Password reset link --}}
    {{-- @if($password_reset_url)
         <p class="my-0">
             <a href="{{ $password_reset_url }}">
                 {{ __('adminlte::adminlte.i_forgot_my_password') }}
             </a>
         </p>
     @endif--}}

    {{-- Register link --}}
    {{--@if($register_url)
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif--}}
@stop
