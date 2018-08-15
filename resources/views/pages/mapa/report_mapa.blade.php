@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          Ubicacion <small>.</small>
        </h2>
    </div>
    <div class="card-body card-padding">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <!-- ................................................................................................... -->
    <br><br>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Proyecto</label> 
                 <select name="proyecto_id" id="proyecto_id" class="chosen" data-placeholder="Proyecto..." >
                  <option></option>
                    @foreach($proyectos as $item)
                        <option value="{{$item->id}}">{{$item->name_proyecto}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('proyecto_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('proyecto_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Unidad Productiva</label> 
                  <select name="unidadproductiva_id" id="unidadproductiva_id" class="chosen" data-placeholder="Unidadproductiva..." >
                    <option></option>
                  </select>
                  @if ($errors->has('unidadproductiva_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('unidadproductiva_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Dispositivo</label> 
                  <select name="dispositivo_id" id="dispositivo_id" class="chosen" data-placeholder="Dispositivo..." >
                    <option></option>
                  </select>
                
                  @if ($errors->has('dispositivo_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('dispositivo_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Variables</label> 
                  <select name="conf_variables_id" id="conf_variables_id" class="chosen" data-placeholder="Variables..." >
                    <option></option>
                  </select>
                
                  @if ($errors->has('conf_variables_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('conf_variables_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>
        </div>
        <br>

        <div class="row">
          <div class="col-sm-4">
              <button id="btnBuscarHistorial" class="btn btn-warning btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-forward"></i></button>
          </div>
        </div>
        <br>

        <!--===================================================================-->
        <!--===================================================================-->
      
  </div>
</div>
@endsection 
@section('footer') 
<script type="text/javascript">
  
    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu_mapas").addClass('active');
     
    }); 

</script>
<script src="{{ URL::asset('scripts/reportes_variables.js') }}"></script>
@endsection 