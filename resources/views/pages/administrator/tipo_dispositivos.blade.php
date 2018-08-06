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
        <a data-toggle="modal" id="btn_add" data-target="#modal" class="btn btn-danger btn-icon">
            <i class="zmdi zmdi-plus"></i> 
        </a>
        <!-- <div style=" overflow-x: auto;white-space: nowrap;" >
        <table width="100%"  class="mdl-data-table" id="table">-->
        <table width="100%" id="table_tipodispositivos" class="table table-striped table-bordered nowrap" >
                <thead>
                    <tr>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Descripcion</th>
                         <th>Options</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($tipo_dispositivos as  $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->name_tipo_dispositivos}}</td>
                       <td>{{$item->description_tipo_dispositivos}}</td>
                       <td>
                        <div class="form-inline">
                            <div class="form-group"> 
                                <button data-toggle='modal' data-target='#modal' class='btn_edit btn btn-primary btn-icon waves-effect waves-circle waves-float'><i class='zmdi zmdi-edit'></i></button>
                            </div>
                            <div class="form-group">
                                <form class="mb-2" role="form"  method="POST" action="{{ url('/deletetipodispositivos') }}"> 
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="id" name="id" value="{{$item->id}}">  
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


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tipo Dispositivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="POST" action="{{ url('/tipodispositivos') }}">
            @include('pages.administrator.partials.forms')
        </form>
      </div>
      <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-close"></i></button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('footer')   
<script src="{{ URL::asset('scripts/scripts.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function($){

      //$(".administrador").siblings('li').removeClass('active');
      $(".home").removeClass('active');
      $(".li_administrador").addClass('active');
      $(".li_tipodispositivos").addClass('active');


        //  $('#dgdfg').click();
        var Table = $('#table_tipodispositivos').DataTable({
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
              $("input[name=id]").val(data[0]);
              $("textarea[name=description]").val(data[2]);
               /// alert( data[1] +"'s salary is: "+ data[0] );
        });
    }); 

    $("#btn_add").click(function(){
        $("input[name=id]").val(0);
        $("input[name=name]").val('');
        $("input[name=description]").val('');
    });


</script>
@endsection 