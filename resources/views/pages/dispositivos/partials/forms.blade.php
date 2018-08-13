        @csrf
        @if(!empty($dispositivo))
          <input type="hidden" name="id"  value="{{$dispositivo->id}}">
          <input type="hidden" id="id_update_dispositivo"  value="{{$dispositivo->id}}">
        @else
          <input type="hidden" name="id">
        @endif
        
 <!-- ................................................................................................... -->
        <div class="row">
         <div class="col-sm-3">
            @if(!empty($dispositivo))
              <input type="hidden" value="{{$dispositivo->dispositivo_id}}" name="dispositivo_remotos_id" id="dispositivo_remotos_id"/>
            @endif
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Dispositivos Configurados</label> 
                  <select name="dispositivos_remotos" id="dispositivos_remotos" class="chosen" data-placeholder="Dispositivos Remotos...">
                    <option></option>
                  </select>
                  @if ($errors->has('dispositivos_remotos'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('dispositivos_remotos') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Mac</label>
                @if(!empty($dispositivo))
                   <input type="text" id="mac" value="{{$dispositivo->mac }}" name="mac" class="form-control">
                @else
                   <input type="text" id="mac" value="{{ old('mac') }}" name="mac" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Marca</label>
                @if(!empty($dispositivo))
                    <input type="text" id="marca" value="{{$dispositivo->marca }}" name="marca" class="form-control">
                @else
                   <input type="text" id="marca" value="{{ old('marca') }}" name="marca" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Cellular</label>
                @if(!empty($dispositivo))
                    <input type="text" id="cellular" value="{{$dispositivo->cellular }}" name="cellular" class="form-control">
                @else
                   <input type="text" id="cellular" value="{{ old('cellular') }}" name="cellular" class="form-control">
                @endif
              </div>
            </div>
          </div>
        </div>
        <br><br>

<!-- ................................................................................................... -->
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Connected</label>
                @if(!empty($dispositivo))
                   <input type="text" id="connected" value="{{$dispositivo->connected }}" name="connected" class="form-control">
                @else
                   <input type="text" id="connected" value="{{ old('connected') }}" name="connected" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Current_build_target</label>
                @if(!empty($dispositivo))
                   <input type="text" id="current_build_target" value="{{$dispositivo->current_build_target }}" name="current_build_target" class="form-control">
                @else
                   <input type="text" id="current_build_target" value="{{ old('current_build_target') }}" name="current_build_target" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Id Externo</label>
                @if(!empty($dispositivo))
                    <input type="text" id="id_externo" value="{{$dispositivo->id_externo }}" name="id_externo" class="form-control">
                @else
                  
                   <input type="text" id="id_externo" value="{{ old('id_externo') }}" name="id_externo" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Imei</label>
                @if(!empty($dispositivo))
                    <input type="text" id="imei" value="{{$dispositivo->imei }}" name="imei" class="form-control">
                @else
                   <input type="text" id="imei" value="{{ old('imei') }}" name="imei" class="form-control">
                @endif
              </div>
            </div>
          </div>
        </div>
 
<!-- ................................................................................................... -->
        <br><br>
        <div class="row">
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Last_app</label>
                @if(!empty($dispositivo))
                   <input type="text" id="last_app" value="{{$dispositivo->last_app }}" name="last_app" class="form-control">
                @else
                   <input type="text" id="last_app" value="{{ old('last_app') }}" name="last_app" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Last_heard</label>
                @if(!empty($dispositivo))
                   <input type="text" id="last_heard" value="{{$dispositivo->last_heard }}" name="last_heard" class="form-control">
                @else
                   <input type="text" id="last_heard" value="{{ old('last_heard') }}" name="last_heard" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Last_iccid</label>
                @if(!empty($dispositivo))
                    <input type="text" id="last_iccid" value="{{$dispositivo->last_iccid }}" name="last_iccid" class="form-control">
                @else
                  
                   <input type="text" id="last_iccid" value="{{ old('last_iccid') }}" name="last_iccid" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Last_ip_address</label>
                @if(!empty($dispositivo))
                    <input type="text" id="last_ip_address" value="{{$dispositivo->last_ip_address }}" name="last_ip_address" class="form-control">
                @else
                   <input type="text" id="last_ip_address" value="{{ old('last_ip_address') }}" name="last_ip_address" class="form-control">
                @endif
              </div>
            </div>
          </div>
        </div>

<!-- ................................................................................................... -->
        <br><br>
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Name</label>
                @if(!empty($dispositivo))
                   <input type="text" id="name" value="{{$dispositivo->name }}" name="name" class="form-control">
                @else
                   <input type="text" id="name" value="{{ old('name') }}" name="name" class="form-control">
                @endif

                 @if ($errors->has('name'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('name') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Platform_id</label>
                @if(!empty($dispositivo))
                   <input type="text" id="platform_id" value="{{$dispositivo->platform_id }}" name="platform_id" class="form-control">
                @else
                   <input type="text" id="platform_id" value="{{ old('platform_id') }}" name="platform_id" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Product_id</label>
                @if(!empty($dispositivo))
                    <input type="text" id="product_id" value="{{$dispositivo->product_id }}" name="product_id" class="form-control">
                @else
                  
                   <input type="text" id="product_id" value="{{ old('product_id') }}" name="product_id" class="form-control">
                @endif
              </div>
            </div>
          </div>
        
        </div>

        <!-- ................................................................................................... -->
        <br><br>
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Status</label>
                @if(!empty($dispositivo))
                   <input type="text" id="status" value="{{$dispositivo->status }}" name="status" class="form-control">
                @else
                   <input type="text" id="status" value="{{ old('status') }}" name="status" class="form-control">
                @endif
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-pin"></i></span>
              <div class="fg-line">
                <label class="fg-label">Ubicacion</label>
                @if(!empty($dispositivo))
                   <input type="text" id="coords_dispositivo" value="{{$dispositivo->coords_dispositivo }}" name="coords_dispositivo" class="form-control">
                @else
                   <input type="text" id="coords_dispositivo" value="{{ old('coords_dispositivo') }}" name="coords_dispositivo" class="form-control">
                @endif

                 @if ($errors->has('coords_dispositivo'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('coords_dispositivo') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Descripcion</label>
                @if(!empty($dispositivo))
                  
                   <textarea class="form-control rounded-0" name="descripcion_dispositivo" rows="3">{{$dispositivo->descripcion_dispositivo }}</textarea>
                @else
                   <textarea class="form-control rounded-0" name="descripcion_dispositivo" rows="2">{{old('descripcion_dispositivo')}}</textarea>
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
                 <label class="fg-label">Proyecto</label> 
                 <select name="proyecto_id" id="proyecto_id" class="chosen" data-placeholder="Proyecto..." >
                  <option></option>
                  @if(!empty($dispositivo))
                    @foreach($proyectos as $item)
                     <option value="{{$item->id}}"
                                    @if ($item-> id == old('proyecto_id',  $dispositivo_join->proyecto_id))
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
            @if(!empty($dispositivo))
              <input type="hidden" value="{{$dispositivo->unidad_productiva_id}}" name="unidadproductiva_update" id="unidadproductiva_update"/>

              <input type="hidden" name="unidadproductiva_id"  />
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
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Tipo Dispositivo</label> 
                 <select name="tipo_dispositivo_id" id="tipo_dispositivo_id" class="chosen" data-placeholder="Tipo Dispositivo..." >
                  <option></option>
                  @if(!empty($dispositivo))
                    @foreach($tipo_dispositivos as $item)
                     <option value="{{$item->id}}"
                                    @if ($item-> id == old('tipo_dispositivo_id',  $dispositivo->tipo_dispositivo_id))
                                        selected="selected"
                                    @endif
                                    >{{$item->name_tipo_dispositivos}}</option>
                    @endforeach
                  @else
                    @foreach($tipo_dispositivos as $item)
                        <option value="{{$item->id}}">{{$item->name_tipo_dispositivos}}</option>
                    @endforeach
                  @endif
                  </select>
                  @if ($errors->has('tipo_dispositivo_id'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('tipo_dispositivo_id') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="col-lg-12 text-center">
            <div class="input-group">
              <br>
             <button type="submit" id="subir" class="btn btn-lg btn-primary">
              Guardar 
            </button>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <br>
              <div class="text-left">
                <a class="btn btn-primary" id="delete-all-button" alt="Quitar Formas" title="Quitar Formas"> <i class="zmdi zmdi-close-circle "></i></a>
                <a class="btn btn-primary" id="delete-button" alt="Quitar Forma Seleccionada" title="Quitar Forma Seleccionada">
                  <i class="zmdi zmdi-arrow-back"></i> 
                </a>
                <a class="btn btn-primary" id="btnActualizarMapa" alt="Actualizar Mapa" title="Actualizar Mapa">
                  <i class="zmdi zmdi-refresh-alt" ></i> 
                </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div id="map" style=" margin-top:10px; width: 100%; height: 500px;background-image: url(/img/fondo.png);">
          </div>
          </div>
        </div>