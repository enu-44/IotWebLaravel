@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Configuracion <small>.</small></h2>
         <a href="{{ url('/add_configuracion_variables') }}"  class="btn btn-primary btn-lg">Agregar Configuracion</a>
    </div>
    <div class="card-body card-padding">
        <div class="row">

            <table width="100%" id="table_configuracion_variables" class="table table-striped table-bordered nowrap" >
                <thead>
                    <tr>
                         <th>Id</th>
                         <th>Nombre Remoto</th>
                         <th>Alias</th>
                         <th>Equipo</th>
                         <th>Unidad Productiva</th>
                         <th>Proyecto</th>
                         <th>Options</th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach($configuracion_variables as  $item)
                    <tr>
                       <td>{{$item->id}}</td>
                       <td>{{$item->name_configure}}</td>
                       <td>{{$item->alias_variable}}</td>
                       <td>{{$item->name_tipo_dispositivos}} ({{$item->name_dispositivo}})</td>
                       <td>{{$item->name_proyecto}}</td>
                       <td>{{$item->name_unidad_productiva}}</td>
                       <td>
                        <div class="form-inline">
                            <div class="form-group"> 
                                <a href="{{url('/editConfiguracionVariable',['configuracion_variable_id' => Crypt::encrypt($item->id) ])}}" class="btn btn-primary btn-icon waves-effect waves-circle waves-float">
                                <i class='zmdi zmdi-edit'></i></a>
                            </div>
                            <div class="form-group">
                                <form class="mb-2" role="form"  method="POST" action="{{ url('/deleteconfiguracionvariable') }}"> 
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
      $(".li_menu_variables").addClass('active');
      $(".li_configuracion_variable").addClass('active');

       //$('#dgdfg').click();
        var Table = $('#table_configuracion_variables').DataTable({
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
    });
</script>
@endsection 

