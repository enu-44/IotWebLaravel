@extends('layouts.master_page')
@section('content')
 <!-- Forgot Password -->
            <div class="l-block toggled" id="l-forget-password">
                <div class="lb-header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    {{ __('Reset Password') }}
                </div>

                <div class="lb-body">
                    <!--<p class="m-b-30">Lorem ipsum dolor fringilla enim feugiat commodo sed ac lacus.</p>-->
                    <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" class="input-sm form-control fg-input"  value="{{ old('email') }}" required>
                            <label class="fg-label">{{__('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('email') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn palette-Purple bg"> {{ __('Send Password Reset Link') }}</button>

                    </form>

                    <div class="m-t-30">
                        <a  class="palette-Purple text d-block m-b-5" href="/">{{__('I already have an account') }}</a>
                        <a  href="{{ route('register') }}" class="palette-Purple text">{{ __('Create Account') }}</a>
                    </div>
                </div>
            </div>
@endsection
@section('footer')   
<script type="text/javascript">
    $(document).ready(function($){
        
            //  $('#dgdfg').click();
            $( ".login" ).css( "background-color","#9C27B0" );  
        }); 
</script>
@endsection 
