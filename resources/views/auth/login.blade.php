
@extends('layouts.master_page')
@section('content')
<!-- Login -->
<div class="l-block toggled" id="l-login">
                <div class="lb-header palette-Brown-800 bg">
                    <i class="zmdi zmdi-account-circle"></i>
                {{ __('Hi there! Please Sign in') }}
                </div>

                <div class="lb-body">

                    
                    <!--@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif-->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="email"  name="email" value="{{ old('email') }}" class="input-sm form-control{{ $errors->has('email') ? ' is-invalid' : '' }} fg-input">
                                <label class="fg-label">{{ __('E-Mail Address') }}</label>
                                @if ($errors->has('email'))
                                    <div class="has-error">
                                        <small class="help-block">{{ $errors->first('email') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group fg-float">
                            <div class="fg-line">
                                <input type="password" name="password" class="input-sm form-control{{ $errors->has('password') ? ' is-invalid' : '' }} fg-input">
                                <label class="fg-label">{{ __('Password') }}</label>
                                @if ($errors->has('password'))
                                    <div class="has-error">
                                        <small class="help-block">{{ $errors->first('password') }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="checkbox m-b-30">
                            <label>
                               <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <i class="input-helper"></i>
                                 {{ __('Remember Me') }}
                               
                            </label> 
                        </div>
                        <button type="submit" class="btn palette-Amber bg">{{ __('Login') }}</button>
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        <!--    <a href="/password/email">Forgot Your Password?</a>-->
                        <div class="m-t-20">
                            <a href="{{ route('register') }}" class="palette-Amber text d-block m-b-5" >{{ __('Create Account') }}</a>
                        <!-- <a data-block="#l-forget-password" data-bg="purple" href="" class="palette-Teal text">Forgot password?</a>-->
                        </div>
                    </form>
                </div>
</div>

            
@endsection
