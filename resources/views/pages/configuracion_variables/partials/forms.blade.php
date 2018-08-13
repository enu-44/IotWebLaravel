@csrf
        @if(!empty($configuracion_variable))
          <input type="hidden" name="id"  value="{{$configuracion_variable->id}}">
        @else
          <input type="hidden" name="id">
        @endif
        
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
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Tipo Variable</label> 
                 <select name="tipo_variable_id" id="tipo_variable_id" class="chosen" data-placeholder="Tipo Variable..." >
                  <option></option>
                  @if(!empty($configuracion_variable))
                    @foreach($tipo_variables as $item)
                     <option value="{{$item->id}}"
                                    @if ($item-> id == old('tipo_variable_id',  $configuracion_variable->tipo_variable_id))
                                        selected="selected"
                                    @endif
                                    >{{$item->name_tipo_variables}}</option>
                    @endforeach
                  @else
                    @foreach($tipo_variables as $item)
                        <option value="{{$item->id}}">{{$item->name_tipo_variables}}</option>
                    @endforeach
                  @endif
                  </select>
                  @if ($errors->has('tipo_variable_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('tipo_variable_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-device-hub"></i></span>
              <div class="fg-line">
                <label class="fg-label">Name Events</label>
                @if(!empty($configuracion_variable))
                   <input type="text" id="name_configure" value="{{$configuracion_variable->name_configure }}" name="name_configure" class="form-control">
                @else
                   <input type="text" id="name_configure" value="{{ old('name_configure') }}" name="name_configure" class="form-control">
                @endif

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
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Codigo</label>

                @if(!empty($configuracion_variable))
                    <input type="text" id="coreid_configure" value="{{$configuracion_variable->coreid_configure }}" name="coreid_configure" class="form-control">
                @else
                  
                   <input type="text" id="coreid_configure" value="{{ old('coreid_configure') }}" name="coreid_configure" class="form-control">
                @endif


                @if ($errors->has('coreid_configure'))
                  <div class="has-error">
                    <small class="help-block">{{ $errors->first('coreid_configure') }}</small>
                  </div>
                @endif
              </div>
            </div>
          </div>

          
        <br>
        <div class="row">
        <div class="col-lg-12 text-center">
            <div class="input-group">
              <br>
             <button type="submit" id="subir" class="btn btn-lg btn-primary">
              Guardar 
            </button>
            </div>
        </div>
        </div>
       