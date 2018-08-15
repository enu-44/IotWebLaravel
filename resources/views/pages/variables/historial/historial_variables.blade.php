@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          Historial de variables <small>.</small>
        </h2>
    </div>
    <div class="card-body card-padding">
    <input type="hidden" id="variable_historial" name="variable_historial">
    <input type="hidden" id="coreid_dispositivo" name="coreid_dispositivo">
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

        <br><br>
        <div class="row">
           <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-calendar"></i></span>
              <div class="fg-line">
                <label class="fg-label">Fecha Inicio</label>
               
                  <input type="text" id="fechainicio" name="fechainicio" class="datepicker target form-control">
                 @if ($errors->has('name_configure'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('name_configure') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-calendar"></i></span>
              <div class="fg-line">
                <label class="fg-label">Fecha Fin</label>
               
                  <input type="text" id="fechafin" name="fechafin" class="datepicker target form-control">
                 @if ($errors->has('name_configure'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('name_configure') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <button id="btnBuscarHistorial" class="btn btn-warning btn-icon waves-effect waves-circle waves-float"><i class="zmdi zmdi-arrow-forward"></i></button>
          </div>

        </div>
        <br>

        <!--===================================================================-->
    <!--===================================================================-->
      <div class="row">
        <div class="col-md-12">
          <div role="tabpanel">
            <ul class="tab-nav" data-tab-color="amber" role="tablist">
                <li class="active"><a href="#reporte" aria-controls="reporte" role="tab" data-toggle="tab">Reporte</a></li>
                <li><a href="#grafico" aria-controls="grafico" role="tab" data-toggle="tab">Graficos</a></li>                  
            </ul>

            <div class="tab-content">
                @include('loaders.loader')

                <div role="tabpanel" class="tab-pane active" id="reporte">
                  <div class="active fade in tab-pane" id="reporte">
                    <table id="example" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                         <th>ID</th>
                          <th>VALOR</th>
                          <th>FECHA</th>
                          <th>ID EQUIPO</th>
                          <th>VARIABLE</th>
                        <!--<th>FECHA PUBLICACION</th>-->
                          <th>HORA</th>
                        </tr>
                      </thead>
                    </table>
                  </div>                 
                </div>
                <div role="tabpanel" class="tab-pane" id="grafico">
                  <div id="container" style="max-width: 100%; height: 400px; margin: 0 auto"></div>
                  <br>
                  <br>
                  <div id="chart_div" style="height:400px;"></div>
                                       
                </div>                   
            </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection 
@section('footer') 


<script type="text/javascript">
  
    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu_historial").addClass('active');
     
    }); 

</script>

<script src="{{ URL::asset('scripts/reportes_variables.js') }}"></script>
@endsection 