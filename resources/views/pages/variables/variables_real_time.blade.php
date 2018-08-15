@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          Medidas en tiempo real <small>.</small>
        </h2>
    </div>
    <div class="card-body card-padding">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <!-- ................................................................................................... -->
    <br><br>
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Proyecto</label> 
                 <select name="proyecto_id" id="proyecto_id" class="chosen" data-placeholder="Proyecto..." >
                  <option></option>
                  @if(!empty($configuracion_variable))
                    @foreach($proyectos as $item)
                     <option value="{{$item->id}}"
                                    @if ($item-> id == old('proyecto_id',  $config_variable_join->proyecto_id))
                                        selected="selected"
                                    @endif
                                    >{{$item->name_proyecto}}</option>
                    @endforeach
                  @else
                    @foreach($proyectos as $item)
                        <option value="{{$item->id}}">{{$item->name_proyecto}}</option>
                    @endforeach
                  @endif
                  </select>
                  @if ($errors->has('proyecto_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('proyecto_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            @if(!empty($configuracion_variable))
              <input type="hidden" value="{{$config_variable_join->unidad_productiva_id}}" name="unidadproductiva_update" id="unidadproductiva_update"/>

            @endif
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

          <div class="col-sm-4">
            @if(!empty($configuracion_variable))
              <input type="hidden" value="{{$configuracion_variable->dispositivo_id}}" name="dispositivo_update" id="dispositivo_update"/>

            @endif
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

        </div>
        <br><br>

        <div class="row">
          <div class="col-sm-12">
             <div id="content_variables_real_time"></div>
          </div>
        </div>
  </div>
</div>
@endsection 
@section('footer') 


<script type="text/javascript">

    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu_variables").addClass('active');
      $(".li_medida_variables").addClass('active');
    }); 

</script>

<script src="{{ URL::asset('scripts/reportes_variables.js') }}"></script>
@endsection 