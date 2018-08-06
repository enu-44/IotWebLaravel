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
       <!-- <a data-toggle="modal" id="btn_add_users" data-target="#exampleModalUser" class="btn btn-danger btn-icon">
            <i class="zmdi zmdi-plus"></i> 
        </a>-->
        <a href="{{url('/addeditUser',['user_id' => Crypt::encrypt('0') ])}}" class="btn btn-danger btn-icon">
            <i class="zmdi zmdi-plus"></i> 
        </a>

        
        <!-- <div style=" overflow-x: auto;white-space: nowrap;" >
        <table width="100%"  class="mdl-data-table" id="table">-->
        <table width="100%" id="table_users" class="table table-striped table-bordered nowrap" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('PhoneName') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('E-Mail Address') }}</th>
                        <th>Options</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($users as  $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->name}} {{$item->last_name}}</td>
                       <td>{{$item->phone}}</td>
                       <td>{{$item->address}}</td>
                       <td>{{$item->email}}</td>
                       <td>
                        <div class="form-inline">
                            <div class="form-group"> 
                                <a href="{{url('/addeditUser',['user_id' => Crypt::encrypt($item->id) ])}}" class="btn btn-primary btn-icon waves-effect waves-circle waves-float">
                                <i class='zmdi zmdi-edit'></i></a>
                            </div>
                            <div class="form-group">
                                <form class="mb-2" role="form"  method="POST" action="{{ url('/deleteusers') }}"> 
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user_id" name="user_id" value="{{$item->id}}">  
                                    <button type="submit" onclick="confirmFunction('eliminar')" class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float">
                                        <span class="zmdi zmdi-delete"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
        <!--</div>-->   
        </div>
    </div>


<!-- Modal 
<div class="modal fade" id="exampleModalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <div class="modal-body">
    <form  role="form" method="POST" action="{{ url('/users') }}">

        @csrf
        <input type="hidden" name="user_id">
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
        <div class="form-group ">
            <button type="submit" id="subir" class="btn btn-danger">
                Guardar
            </button>
        </div>
    </form>
  </div>
  <div class="modal-footer">
      <button data-dismiss="modal" class="btn btn-default btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close"></i></button>
  </div>
</div>
</div>
</div>
-->

@endsection
@section('footer')   
<script src="{{ URL::asset('scripts/scripts.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function($){
        //  $('#dgdfg').click();
        var Table = $('#table_users').DataTable({
          'bFilter': true,
          'bInfo': true,
          'responsive': true,
          "bAutoWidth": true,
          'bPaginate': true,
          /*"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button data-toggle='modal' data-target='#exampleModal' class='btn_edit btn btn-primary btn-icon waves-effect waves-circle waves-float'><i class='zmdi zmdi-edit'></i></button><button class='btn_delete btn btn-danger btn-icon waves-effect waves-circle waves-float'><i class='zmdi zmdi-delete'></i></button>"
        } ]*/
    });
    new $.fn.dataTable.FixedHeader(Table);

    $(".btn_edit").click(function(){
             var data = Table.row( $(this).parents('tr') ).data();
              $("input[name=name]").val(data[1]);
                /// $("input[name=name]").trigger("click");
              $("input[name=user_id]").val(data[0]);
               /// alert( data[1] +"'s salary is: "+ data[0] );
        });
    }); 

    $("#btn_add_users").click(function(){
        $("input[name=user_id]").val(0);
        $("input[name=name]").val('');
    });


</script>
@endsection 