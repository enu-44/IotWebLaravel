@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Proyectos <small>Registrar proyectos.</small></h2>
         <button data-toggle="modal" id="btn_add" data-target="#modal"  class="btn btn-primary btn-lg">Agregar Proyecto</button>
    </div>
    <div class="card-body card-padding">
     
        <div class="row">

            <table width="100%" id="table_proyectos" class="table table-striped table-bordered nowrap" >
                <thead>
                    <tr>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Descripcion</th>
                         <th>Tipo Proyecto</th>
                         <th>Options</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($proyectos as  $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->name_proyecto}}</td>
                       <td>{{$item->description_proyecto}}</td>
                       <td>{{$item->name_tipo_proyecto}}</td>
                       <td>
                        <div class="form-inline">
                            <div class="form-group"> 
                                <button onclick="getId('{{$item->tipo_proyecto_id}}')" data-toggle='modal' data-target='#modal' class='btn_edit btn btn-primary btn-icon waves-effect waves-circle waves-float'><i class='zmdi zmdi-edit'></i></button>
                            </div>
                            <div class="form-group">
                                <form class="mb-2" role="form"  method="POST" action="{{ url('/deleteproyecto') }}"> 
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
               <!-- <div class="col-sm-6 col-md-3">
                    <div class="thumbnail">
                        <img src="img/iconproject.png" width="100" alt="">
                        <div class="caption">
                            <h4>Proyecto 1</h4>
                            <p>descripcion del proyecto .</p>
                            <div class="m-b-5">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info">Opciones</button>
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Split button dropdowns</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Unidades Productivas</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Proyectos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="POST" action="{{ url('/proyectos') }}">
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
      $(".home").removeClass('active');
      $(".li_menu").addClass('active');
      $(".li_proyectos").addClass('active');

       //$('#dgdfg').click();
        var Table = $('#table_proyectos').DataTable({
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
        $("textarea[name=description]").val('');
        $("select[name=tipo_proyecto_id]").prop('required',true);
    });

    function getId(id){
      //$("input[name=tipo_proyecto_id_global]").val(id);
      //$("#tipo_proyecto_id").val(id);
      $('#tipo_proyecto_id').val(id).trigger('chosen:updated');
    }
</script>
@endsection 