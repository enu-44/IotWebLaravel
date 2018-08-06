@extends('layouts.master_page')
@section('content')

<!-- Register -->
<div class="l-block toggled" id="l-register">

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
            <form  role="form" method="POST" action="{{ route('register') }}">
                 @csrf
                <div class="lb-header palette-Blue bg">
                    <i class="zmdi zmdi-account-circle"></i>
                   {{ __('Create Account') }}
                </div>

                <div class="lb-body">
                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="name" value="{{ old('name') }}"  class="input-sm form-control fg-input " required>
                            <label class="fg-label">{{ __('Name') }}</label>
                             @if ($errors->has('name'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('name') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="last_name" value="{{ old('last_name') }}"  class="input-sm form-control fg-input " required>
                            <label class="fg-label">{{ __('LastName') }}</label>
                             @if ($errors->has('last_name'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('last_name') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="text" name="address" value="{{ old('address') }}"  class="input-sm form-control fg-input " required>
                            <label class="fg-label">{{ __('Address') }}</label>
                             @if ($errors->has('address'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('address') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="number" name="phone" value="{{ old('phone') }}"  class=" input-sm form-control fg-input "   required>
                            <label class="fg-label">{{ __('Phone') }}</label>
                             @if ($errors->has('phone'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('phone') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>


                    


                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="email"  name="email" value="{{ old('email') }}" class="input-sm form-control is-invalid fg-input">
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
                            <input type="password" name="password" class="input-sm form-control fg-input" required>
                            <label class="fg-label">{{ __('Password') }}</label>
                            @if ($errors->has('password'))
                                <div class="has-error">
                                    <small class="help-block">{{ $errors->first('password') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input type="password" name="password_confirmation" class="input-sm form-control fg-input" required>
                            <label class="fg-label">{{ __('Confirm Password') }}</label>

                        </div>
                    </div>
<!--
                    <div class="checkbox m-b-30">
                        <label>
                            <input type="checkbox" value="">
                            <i class="input-helper"></i>
                            Accept the license agreement
                        </label>
                    </div>

                    <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                    <button type="submit" class="btn palette-Blue bg">{{ __('Create Account') }}</button>

                    <div class="m-t-30">
                        <a href="/" data-bg="teal" class="palette-Blue text d-block m-b-5" >   {{ __('I already have an account') }}</a>
                      
                      <!--  <a data-block="#l-forget-password" data-bg="purple" href="" class="palette-Blue text">Forgot password?</a>-->
                    </div>
                </div>
            </form>
</div>

            
@endsection
@section('footer')   

<script type="text/javascript">
    $(document).ready(function($){
        
            //  $('#dgdfg').click();
            //$( ".login" ).css( "background-color","#42a5f5" );
            $( ".login" ).css( "background-image","url('../img/arduino.jpg') " );

            ///background-image:url("../img/fondo.jpg")  
        }); 
</script>


@endsection  


