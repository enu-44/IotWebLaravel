@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Unidades Productivas <small>.</small></h2>
      
         <a href="{{ url('/add_unidad_productiva') }}"  class="btn btn-primary btn-lg">Agregar UnidadProductiva</a>

    </div>
    <div class="card-body card-padding">
        <div class="row">

            <table width="100%" id="table_unidadproductiva" class="table table-striped table-bordered nowrap" >
                <thead>
                    <tr>
                         <th>Id</th>
                         <th>Nombre</th>
                         <th>Descripcion</th>
                         <th>Proyecto</th>
                         <th>Tipo Proyecto</th>
                         <th>Options</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($unidades_productivas as  $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->name_unidad_productiva}}</td>
                       <td>{{$item->description_unidad_productiva}}</td>
                       <td>{{$item->name_proyecto}}</td>
                       <td>{{$item->name_tipo_proyecto}}</td>
                       <td>
                        <div class="form-inline">
                            <div class="form-group"> 
                                <button onclick="getId('{{$item->proyecto_id}}')" data-toggle='modal' data-target='#modal' class='btn_edit btn btn-primary btn-icon waves-effect waves-circle waves-float'><i class='zmdi zmdi-edit'></i></button>
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
      $(".li_unidadproductiva").addClass('active');

       //$('#dgdfg').click();
        var Table = $('#table_unidadproductiva').DataTable({
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
      //$('#tipo_proyecto_id').val(id).trigger('chosen:updated');
    }
</script>
@endsection 