@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2><small></small></h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        {{ __('You are logged in!') }}
        {{ Auth::user()->name }} {{ Auth::user()->last_name }}
        <ul class="actions">
            <li>
                <a href="">
                    <i class="zmdi zmdi-check-all"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="zmdi zmdi-trending-up"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="">Change Date Range</a>
                    </li>
                    <li>
                        <a href="">Change Graph Type</a>
                    </li>
                    <li>
                        <a href="">Other Settings</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="card-body" style="padding:30px;">
        
        <a href="{{ url('/users') }}" class="btn btn-danger btn-icon">
            <i class="zmdi zmdi-arrow-left"></i> 
        </a>


          @if ($user!=null)

          <form style="margin-top: 30px;"  role="form" method="POST" action="{{ url('/users') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id }}">

               <!--REFERENTES-->
                <p class="c-black f-500 m-b-5 m-t-20">Seleccione su Sponsor</p>
                <small>Patrocinador</small>

        
                <div class="form-group fg-float">
                    <div class="fg-line">
                        

                        <select name="master_id" class="chosen" data-placeholder="Escoja el referente...">
                            <option></option>
                            @foreach($users as $item)

                                <option value="{{$item-> id}}"
                                    @if ($item-> id == old('master_id',  $user->master_id))
                                        selected="selected"
                                    @endif
                                    >{{$item->name}} {{$item->last_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group fg-float">
                                <div class="fg-line">
                                    <input type="text" name="name" value="{{$user->name }}"  class="input-sm form-control fg-input " required>
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
                                    <input type="text" name="last_name" value="{{$user->last_name }}"  class="input-sm form-control fg-input " required>
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
                                    <input type="text" name="address" value="{{$user->address }} "  class="input-sm form-control fg-input " required>
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
                                    <input type="number" name="phone" value="{{$user->phone }}"  class=" input-sm form-control fg-input "   required>
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
                                    <input type="email"  name="email" value="{{$user->email }}" class="input-sm form-control is-invalid fg-input">
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
                                    <input type="password" name="password" class="input-sm form-control fg-input" >
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
                                    <input type="password" name="password_confirmation" class="input-sm form-control fg-input" >
                                    <label class="fg-label">{{ __('Confirm Password') }}</label>

                                </div>
                            </div>
                <div class="form-group ">
                    <button type="submit" id="subir" class="btn btn-danger">
                        Guardar
                    </button>
                </div>
            </form>


          @else

          <form  style="margin-top: 30px;" role="form" method="POST" action="{{ url('/users') }}">
                @csrf
                <input type="hidden" name="user_id" value="0">

                <!--REFERENTES-->
                <p class="c-black f-500 m-b-5 m-t-20">Seleccione su Sponsor</p>
                <small>Patrocinador</small>
                <div class="form-group">    
                        <select name="master_id" class="chosen" data-placeholder="Escoja el patrocinador..." required="">
                            <option></option>
                            @foreach($users as $user)
                                <option value="{{$user-> id}}">{{$user->name}} {{$user->last_name}}</option>
                            @endforeach
                        </select>

                </div>
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
                                    <input type="password" name="password" class="input-sm form-control fg-input">
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
                                    <input type="password" name="password_confirmation" class="input-sm form-control fg-input">
                                    <label class="fg-label">{{ __('Confirm Password') }}</label>

                                </div>
                            </div>
                <div class="form-group ">
                    <button type="submit" id="subir" class="btn btn-danger">
                        Guardar
                    </button>
                </div>
            </form>
          @endif
        <!--</div>-->   
        </div>
    </div>


<!-- Modal -->
@endsection
@section('footer')   
<script src="{{ URL::asset('scripts/scripts.js') }}"></script>
@endsection 