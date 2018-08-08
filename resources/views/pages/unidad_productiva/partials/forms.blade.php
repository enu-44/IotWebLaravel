        @csrf
        @if(!empty($unidadproductiva))
          <input type="hidden" name="id"  value="{{$unidadproductiva->id}}">
        @else
          <input type="hidden" name="id">
        @endif
        
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Proyecto</label> 
                 <select name="proyecto_id" id="proyecto_id" class="chosen" data-placeholder="Proyecto..." >
                  <option></option>
                  @if(!empty($unidadproductiva))
                    @foreach($proyectos as $item)
                     <option value="{{$item->id}}"
                                    @if ($item-> id == old('proyecto_id',  $unidadproductiva->proyecto_id))
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
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-edit"></i></span>
              <div class="fg-line">
                <label class="fg-label">Nombre </label>
                
                @if(!empty($unidadproductiva))
                  <input type="text" id="name" value="{{$unidadproductiva->name_unidad_productiva}}" name="name" class="form-control" >
                @else
                  <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" >
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
              <span class="input-group-addon last"><i class="zmdi zmdi-my-location"></i></span>
              <div class="fg-line">
                <label class="fg-label">Ubicacion UP</label>
               
                @if(!empty($unidadproductiva))
                   <input type="text" value="{{$unidadproductiva->coords_ubicacion}}"  id="ubicacion_unidad_productiva" name="ubicacion_unidad_productiva" class="form-control" required>
                @else
                  <input type="text" value="{{ old('ubicacion_unidad_productiva') }}"  id="ubicacion_unidad_productiva" name="ubicacion_unidad_productiva" class="form-control" required>
                @endif

                @if ($errors->has('ubicacion_unidad_productiva'))
                      <div class="has-error">
                          <small class="help-block">{{ $errors->first('ubicacion_unidad_productiva') }}</small>
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
              <span class="input-group-addon last"><i class="zmdi zmdi-edit"></i></span>
              <div class="fg-line">
                <label class="fg-label">Nit</label>
               
                @if(!empty($unidadproductiva))
                    <input type="text" id="nit" name="nit" value="{{$unidadproductiva->nit_unidad_productiva}}"  class="form-control">
                @else
                  <input type="text" id="nit" name="nit" value="{{ old('nit') }}"  class="form-control">
                @endif

              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-globe"></i></span>
              <div class="fg-line">
                <label class="fg-label">Direccion</label>
                @if(!empty($unidadproductiva))
                   <input type="text" id="direccion" value="{{$unidadproductiva->direccion_unidad_productiva }}" name="direccion" class="form-control">
                @else
                   <input type="text" id="direccion" value="{{ old('direccion') }}" name="direccion" class="form-control">
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                <label class="fg-label">Descripcion</label>
                @if(!empty($unidadproductiva))
                  
                   <textarea class="form-control rounded-0" name="description" rows="5" required>{{$unidadproductiva->description_unidad_productiva }}</textarea>
                @else
                   <textarea class="form-control rounded-0" name="description" rows="5" required>{{old('description')}}</textarea>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-collection-folder-image"></i></span>
              <div class="fg-line">
                <label class="fg-label">Foto</label>
                @if(!empty($unidadproductiva))
                <input id="icon" class="file " name="icon"  type="file"  class="file" >
                  
                @else
                    

                     <input id="" class="file " name="icon"  type="file"  class="file" data-show-upload="false" data-show-caption="true" data-overwrite-initial="false" data-min-file-count="0">
                @endif


                 @if ($errors->has('icon'))
                    <div class="has-error">
                        <small class="help-block">{{ $errors->first('icon') }}</small>
                    </div>
                  @endif
              </div>
            </div>
          </div>

          <div class="col-lg-4 text-center">
            <div class="input-group">
              <br>
             <button type="submit" id="subir" class="btn btn-lg btn-primary">
              Guardar 
            </button>
            </div>
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
                <a class="btn btn-primary" onclick="activarlocalizacion()" alt="Obtener Mi Localizacion" title="Obtener Mi Localizacion">
                    <i class="zmdi zmdi-pin"></i> 
                </a>
                <a class="btn btn-primary" id="btnActualizarMapa" alt="Actualizar Mapa" title="Actualizar Mapa">
                  <i class="zmdi zmdi-refresh-alt" ></i> 
                </a>
            </div>
        </div>
      <!-- Buscador del mapa -->
      <!--....................................................................................................-->
      <div  class=" col-lg-12" >
        <label >Buscar:</label><br>
        <div id="locationField" class="has-feedback has-feedback-left">
         
          @if(!empty($unidadproductiva))
              <input id="autocomplete" name="direccioncompleta" class="form-control input-sm" value="{{$unidadproductiva->direccion_completa_ciudad }}" placeholder="digite el nombre de la ciudad"  type="text" >
                  
          @else
              <input id="autocomplete" name="direccioncompleta" class="form-control input-sm" placeholder="digite el nombre de la ciudad"  type="text" >
          @endif

          <i class="form-control-feedback glyphicon glyphicon-pushpin"></i>
        </div>
        <!--INICIO INFORMACION DE LA CIUDAD DE RESIDENCIA BUSCADA-->
        <div style="display: none;">
          <input class="field" name="numero_calle" id="street_number"  disabled="true" placeholder="Street address">
          <input class="field" id="route" name="direccion_user" placeholder="Street address" disabled="true">
          <input class="field" id="locality" name="ciudad_residencia" placeholder="ciudad"  disabled="true">
          <input class="field" id="ciudad_residencia_user" name="ciudad_user" placeholder="ciudad2">
          <input class="field" id="administrative_area_level_1" disabled="true" name="estado_residencia" placeholder="Estado">
          <input class="field" id="postal_code" name="codigo_postal" placeholder="Zip code" disabled="true">
          <input class="field"  id="country" disabled="true" name="pais_residencia" placeholder="pais">
        </div>
        <!--FIN INFORMACION DE LA CIUDAD DE RESIDENCIA BUSCADA-->
      </div>  
      <!--....................................................................................................--> 
      <div class="col-lg-12">
      <!--....................................................................................................-->
      <!-- Coordenadas de formas dibujadas -->
      <!--....................................................................................................-->
      <div style="display:none;" class="row">
        @if(!empty($unidadproductiva))
         <div class="col-lg-5">
          <label>Coordenadas Punto</label>
          <input type="text" class="input-sm form-control" value="{{$unidadproductiva->marker}}" name="coordsMarker" id="coordsMarker" placeholder="Coordenadas de punto dibujados..."/>
          <label>Coordenadas Poligono</label>
           <textarea class=" form-control" rows="6" name="coordsPoligono" id="coordsPoligono" placeholder="poligono...">{{$unidadproductiva->poligono}}</textarea>
        </div>
        <div class="col-lg-6">
          <label>Coordenadas Circulo</label>
          <input type="text" value="{{$unidadproductiva->radius}}" class="input-sm form-control" name="getRadius" id="getRadius" placeholder="Radius..."><br>
          <input type="text" value="{{$unidadproductiva->circulo}}" class="input-sm form-control" name="getCorrdenadasCirculo" id="getCorrdenadasCirculo" placeholder="Latitud Longitud..."><br>
          <label>Coordenadas Rectangulo</label>
          <input type="text" class="form-control input-sm" name="getNorthEastRectangulo" id="getNorthEastRectangulo" placeholder="Norte, este..."><br>
          <input type="text" class="form-control input-sm" id="getSouthWestRectangulo" placeholder="Sur y oeste..."><br>
        </div>
                 
        @else

        <div class="col-lg-5">
          <label>Coordenadas Punto</label>
          <input type="text" class="input-sm form-control" name="coordsMarker" id="coordsMarker" placeholder="Coordenadas de punto dibujados..."/>
          <label>Coordenadas Poligono</label>
           <textarea class=" form-control" rows="6" name="coordsPoligono" id="coordsPoligono" placeholder="poligono..."></textarea>
        </div>
        <div class="col-lg-6">
          <label>Coordenadas Circulo</label>
          <input type="text" class="input-sm form-control" name="getRadius" id="getRadius" placeholder="Radius..."><br>
          <input type="text" class="input-sm form-control" name="getCorrdenadasCirculo" id="getCorrdenadasCirculo" placeholder="Latitud Longitud..."><br>
          <label>Coordenadas Rectangulo</label>
          <input type="text" class="form-control input-sm" name="getNorthEastRectangulo" id="getNorthEastRectangulo" placeholder="Norte, este..."><br>
          <input type="text" class="form-control input-sm" id="getSouthWestRectangulo" placeholder="Sur y oeste..."><br>
        </div>
              
        @endif
      </div>
      <div id="map" style=" margin-top:10px; width: 100%; height: 500px;background-image: url(/img/fondo.png);"></div>
           
      </div>
    </div>  