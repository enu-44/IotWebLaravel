@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          <a href="{{ url('/unidades_productivas') }}"  class="btn btn-danger btn-icon"><i class="zmdi zmdi-arrow-back"></i></a>
          Agregar Unidad Productiva <small>.</small></h2>
    </div>
    <div class="card-body card-padding">

      <div class="row">


          

          <div class="col-sm-4">
            <div class="input-group">
              <span class="input-group-addon last"><i class="zmdi zmdi-view-list"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Proyecto</label> <select name="proyecto_id" id="proyecto_id" class="chosen" data-placeholder="Proyecto..." required="true">
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

          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-edit"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" required>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-my-location"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Ubicacion UP</label>
                <input type="text" id="ubicacion_unidad_productiva" name="ubicacion_unidad_productiva" class="form-control" required>
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
                <input type="text" id="name" name="name" class="form-control">
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-edit"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Direccion</label>
                <input type="text" id="ubicacion_unidad_productiva" name="ubicacion_unidad_productiva" class="form-control">
              </div>
            </div>
          </div>

          
          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-sort-amount-desc"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Descripcion</label>
                <textarea class="form-control rounded-0" name="description" rows="5" required></textarea>
              </div>
            </div>
          </div>
         


        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="input-group">
               <span class="input-group-addon last"><i class="zmdi zmdi-edit"></i></span>
              <div class="fg-line">
                 <label class="fg-label">Foto</label>
                <input id="" class="file " name="image"  type="file" multiple class="file" data-show-upload="false" data-show-caption="true" data-overwrite-initial="false" data-min-file-count="1">
              </div>
            </div>
          </div>

          <div class="col-sm-8 text-center">
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
          <input id="autocomplete" name="direccioncompleta" class="form-control input-sm" placeholder="digite el nombre de la ciudad"  type="text" required>
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
        <div class="col-lg-5">
          <label>Coordenadas Punto</label>
          <input type="text" class="input-sm form-control" id="coordsMarker" placeholder="Coordenadas de punto dibujados..."/>
          <label>Coordenadas Poligono</label>
           <textarea class=" form-control" rows="6" id="coordsPoligono" placeholder="poligono..."></textarea>
        </div>
        <div class="col-lg-6">
          <label>Coordenadas Circulo</label>
          <input type="text" class="input-sm form-control" id="getRadius" placeholder="Radius..."><br>
          <input type="text" class="input-sm form-control" id="getCorrdenadasCirculo" placeholder="Latitud Longitud..."><br>
          <label>Coordenadas Rectangulo</label>
          <input type="text" class="form-control input-sm" id="getNorthEastRectangulo" placeholder="Norte, este..."><br>
          <input type="text" class="form-control input-sm" id="getSouthWestRectangulo" placeholder="Sur y oeste..."><br>
        </div>
      </div>
      <div id="map" style=" margin-top:10px; width: 100%; height: 500px;background-image: url(img/fondo.png);"></div>
           
      </div>
    </div>    
  </div>
</div>

@endsection  
@section('footer') 
<script type="text/javascript">
    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu").addClass('active');
      $(".li_unidadproductiva").addClass('active');
    }); 

     // This example requires the Drawing library. Include the libraries=drawing
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=drawing">

 /*   function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });

        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['marker', 'circle', 'polygon', 'polyline', 'rectangle']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
          }
        });
        drawingManager.setMap(map);
      }
*/

////Funcion para activar mi geolocalizacion
/*---------------------------------------------------------------------------------------*/
function activarlocalizacion() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var latitude= position.coords.latitude;
            var longitude = position.coords.longitude;

           // $("#coordsMarker").val(latitude+","+longitude);

            ///Iniciar mapa
            center = new google.maps.LatLng(latitude,longitude);
            map.setCenter(center);
            map.setZoom(17);
            ///map.setContent('mi ubicacion');
       

            var goldStar = {//creamos las propiedades para un nuevo marcador
                  path: google.maps.SymbolPath.CIRCLE,
                  strokeColor: '#276ED0',
                  fillColor: '#276ED0',
                  fillOpacity: .9,
                  strokeWeight: 1,
                  scale: 6,
                  };

         
           var marker = new google.maps.Marker({
                      position: center,
                      map: map,
                      animation:google.maps.Animation.DROP,
                      draggable:false,
                      icon:goldStar
            });
             var infoWindowposition= new google.maps.InfoWindow({
              map:map,
              position:marker.getPosition(),
              content:'mi ubicacion'
            });
            /* 
            marker.addListener( 'dragend', function (event)
            {
              //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
              document.getElementById("coordsMarker").value = this.getPosition().lat()+","+ this.getPosition().lng();
            });*/
          });   
        };
    }
////Funcionalidades de dibujar en el mapa
/*---------------------------------------------------------------------------------------*/
    var drawingManager;
    var all_overlays = [];
    var selectedShape;
    var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
    var selectedColor;
    var colorButtons = {};

    function clearSelection() {
      if (selectedShape) {
        selectedShape.setEditable(false);
        selectedShape = null;
      }
    }

    function setSelection(shape) {
      clearSelection();
      selectedShape = shape;
      shape.setEditable(true);
    }
    ////Eliminar forma seleccionada del mapa
    function deleteSelectedShape() {
      if (selectedShape) {
        selectedShape.setMap(null);
        $('#ubicacion_unidad_productiva').val('');
      }
    }
    ////Eliminar todas las formas dibujdas en el mapa
    function deleteAllShape() {
      for (var i = 0; i < all_overlays.length; i++) {
        all_overlays[i].overlay.setMap(null);
      }
      all_overlays = [];

      $("#getNorthEastRectangulo").val('');
      $("#getSouthWestRectangulo").val('');
      $("#getCorrdenadasCirculo").val('');
      $("#getRadius").val('');
      $("#coordsPoligono").val('');
      $("#coordsMarker").val('');
      $('#ubicacion_unidad_productiva').val('');
    }


    ///Valiables del mapa
    var placeSearch, autocomplete,radius;
    var latitude,longitude;
    
    var center;
    var map;
    var center;
    var Uppoligono;
    var circleUP;
    var rectangleUP;
    var markerUP;


    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

      ///Iniciar el mapa
     /*---------------------------------------------------------------------------------------*/
    function initAutocomplete() {
      contador=0;
      // Create the autocomplete object, restricting the search to geographical
      // location types.
      autocomplete = new google.maps.places.Autocomplete(
          /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);

      ///Inicio Configuracion Mapa 
               latitude = 4.570868,
                longitude = -74.29733299999998,
                radius = 8000000, //how is this set up
                center = new google.maps.LatLng(latitude,longitude),
                mapOptions = {
                    center: center,
                    zoom: 5,
                    mapTypeControl: true,
                    scrollwheel: false,
                     mapTypeId: google.maps.MapTypeId.SATELLITE,
                      fullscreenControl:true,

                };
                map = new google.maps.Map(document.getElementById("map"), mapOptions);
            ////Mostrar en mapa opciones de dibujo
            dibujarFormasMapa();
            ///Cargar Unidades Productivas Registradas
           // showAllUp();
           
    }
     /*---------------------------------------------------------------------------------------*/
    ///funcion para dibujar formas en el mapa
     /*---------------------------------------------------------------------------------------*/
    function dibujarFormasMapa(){


                var polyOptions = {
                  strokeWeight: 0,
                  fillOpacity: 0.45,
                  editable: true
                };
                // Creates a drawing manager attached to the map that allows the user to draw
                // markers, lines, and shapes.
                drawingManager = new google.maps.drawing.DrawingManager({

                  ///drawingMode: google.maps.drawing.OverlayType.MARKER,
                 drawingControl: true,
                  drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                      google.maps.drawing.OverlayType.MARKER,
                      google.maps.drawing.OverlayType.CIRCLE,
                      google.maps.drawing.OverlayType.POLYGON,
                      google.maps.drawing.OverlayType.POLYLINE,
                      google.maps.drawing.OverlayType.RECTANGLE
                    ]
                  },
                  markerOptions: {
                    draggable: true
                  },
                  polylineOptions: {
                    editable: true
                  },
                  rectangleOptions: polyOptions,
                  circleOptions: polyOptions,
                  polygonOptions: polyOptions,
                  map: map
                });
      /* ================================================================================*/
                google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
                  all_overlays.push(e);
                  if (e.type != google.maps.drawing.OverlayType.MARKER) {
                    // Switch back to non-drawing mode after drawing a shape.
                    drawingManager.setDrawingMode(null);

                    // Add an event listener that selects the newly-drawn shape when the user
                    // mouses down on it.
                    var newShape = e.overlay;
                    newShape.type = e.type;
                    google.maps.event.addListener(newShape, 'click', function() {
                      setSelection(newShape);
                    });
                    setSelection(newShape);
                  }
                });

        // Borrar la selección actual cuando se cambia el modo de dibujo , o cuando 
                // Se hace clic en el mapa .
      /* ================================================================================*/
                google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
                google.maps.event.addListener(map, 'click', clearSelection);
                google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
                google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);

              /////Funcion cuando se dibuja un marker
              google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type == google.maps.drawing.OverlayType.MARKER) {
                  var latitud = event.overlay.getPosition().lat();
                  var longitud = event.overlay.getPosition().lng();
                  $('#coordsMarker').val(latitud+","+longitud);
                  $('#ubicacion_unidad_productiva').val(latitud+","+longitud);
                  
                  /// toastr.error("Notificacion: " + "Posicion"+radius," Mensajeria"); 
                }
              });


      /////Funcion cuando se dibuja un circulo
      /* ================================================================================*/
               google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type == google.maps.drawing.OverlayType.CIRCLE) {
                  var radius = event.overlay.getRadius();
                    var latitud = event.overlay.getCenter().lat();;
                    var longitud= event.overlay.getCenter().lng();
                  //// console.log('radius', circle.getRadius());
                   // console.log('lat', circle.getCenter().lat());
                   /// console.log('lng', circle.getCenter().lng());
                    ///toastr.error("Notificacion: " + "Posicion"+norte," Mensajeria"); 
                  ///  var este=ne.lng();
                  //  var sur=sw.lat();
                  //  var oeste=sw.lng();
                    
                    $("#getRadius").val(radius);
                    $("#getCorrdenadasCirculo").val(latitud+","+longitud);
                    $('#ubicacion_unidad_productiva').val(latitud+","+longitud);
                    
                    
                  /// toastr.error("Notificacion: " + "Posicion"+ne," Mensajeria"); 
                }
              });

      /////Funcion cuando se dibuja un rectangulo
      /* ================================================================================*/
               google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type == google.maps.drawing.OverlayType.RECTANGLE) {
                  ////var radius = event.overlay.getRadius();
                ////Ubicacion del rectangulo
                  var latitud = event.overlay.getBounds().getCenter().lat();
                  var longitud= event.overlay.getBounds().getCenter().lng();

                    var ne = event.overlay.getBounds().getNorthEast();
                    var sw= event.overlay.getBounds().getSouthWest();
                    ///toastr.error("Notificacion: " + "Posicion"+norte," Mensajeria"); 
                    var norte=ne.lat();
                    var este=ne.lng();

                    var sur=sw.lat();
                    var oeste=sw.lng();

                    $("#getNorthEastRectangulo").val(norte+","+este);
                    $("#getSouthWestRectangulo").val(sur+","+oeste);
                     $('#ubicacion_unidad_productiva').val(latitud+","+longitud);
                  /// toastr.error("Notificacion: " + "Posicion"+ne," Mensajeria"); 
                }
              });


       /////Funcion cuando se dibuja un poligono
      /* ================================================================================*/
               google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
                if (event.type == google.maps.drawing.OverlayType.POLYGON) {
                  var vertices = event.overlay.getPath();
                  var coordinates = event.overlay.getPath().getArray();
                    
                 // Iterate over the vertices.
                 var coordenadapoligono = 0;
                 var todos=0;
                 var validar=0;

                 ///Obtener coordenadas de localizacion del poligono
                  var bounds = new google.maps.LatLngBounds();
                 //// console.log("event:..",bounds);
                  var u;  
                  var poligonoCoords = [];


                for (var i =0; i < vertices.getLength(); i++) {
                  var xy = vertices.getAt(i);
                    ////Llenar array con coordenadas de los puntos de los poligonos
                    poligonoCoords.push( new google.maps.LatLng(xy.lat() , xy.lng() ));
                    ///Se toma coordenadas el primer punto
                    if(todos==0){
                    var coordenadapoligono=xy.lat()+","+xy.lng();
                    todos+=coordenadapoligono+"|";
                    validar=1;
                    }
                    ///Se toma coordenadas de el segundo punto 
                    else if(validar==1){
                    var coordenadapoligono=xy.lat()+","+xy.lng();
                    todos+=coordenadapoligono;
                    validar=2;
                    }
                    ///Se toma coordenadas de el tercer y en adelante  
                    else{
                      var coordenadapoligono="|"+xy.lat()+","+xy.lng();
                    todos+=coordenadapoligono;
                    }
                }

                ////
                for (u = 0; u < poligonoCoords.length; u++) {
                    bounds.extend(poligonoCoords[u]);
                }
              
                ///Latitud y longitud del poligono
                var latitud = bounds.getCenter().lat();
                var longitud= bounds.getCenter().lng();

                $('#ubicacion_unidad_productiva').val(latitud+","+longitud);


                ///Se pasan todas las coordenadas del poligono
                $("#coordsPoligono").val(todos);
                ///$('#ubicacion_unidad_productiva').val(latitud);
                }
              });
     /* ================================================================================*/
            ////Cuando el radius del circulo cambia
            google.maps.event.addListener(drawingManager, 'circlecomplete', function (circle) {
                google.maps.event.addListener(circle, 'radius_changed', function () {
                    var radius=this.getRadius();
                      $("#getRadius").val(radius);
        
                });
            });

    } 
    /*---------------------------------------------------------------------------------------*/

    
  // [START region_fillform]
  ///Obtener lugarbuscado
  /*---------------------------------------------------------------------------------------*/
  function fillInAddress() {
      // Obtenga los detalles de lugar el objeto de autocompletar .
      var place = autocomplete.getPlace();
      for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }
  
    

   

    // Obtener cada componente de la dirección de los detalles del sitio
    // Y llenar el campo correspondiente en el formulario.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById(addressType).value = val;
                center = new google.maps.LatLng(1.8493151,-76.0529119);
                map.setCenter(center);
                map.setZoom(15);
         
                ///Mi ciudad de residencia
                var geocoder = new google.maps.Geocoder();
                geocodeAddress(geocoder, map);
                function geocodeAddress(geocoder, resultsMap) {
                var address = document.getElementById('autocomplete').value;
                ///Se obtiene la posicion 1
                var res = address.split(",", 1);
                document.getElementById("ciudad_residencia_user").value = res;
                geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                  resultsMap.setCenter(results[0].geometry.location);
                  var goldStar = {//creamos las propiedades para un nuevo marcador
                  path: google.maps.SymbolPath.CIRCLE,
                  strokeColor: '#276ED0',
                  fillColor: '#276ED0',
                  fillOpacity: .9,
                  strokeWeight: 1,
                  scale: 6,
                  };

                  var markeinput =new google.maps.Marker({});
    
                
                  markeinput.set("map", resultsMap);
                  markeinput.set("animation", google.maps.Animation.DROP);
                  markeinput.set("position", results[0].geometry.location);
                  markeinput.set("draggable", false);
                  markeinput.set("icon", goldStar);
                    
                  
                  } else {
                  alert('Geocode was not successful for the following reason: ' + status);
                 }
            });
           
          }
        }
      }
    }
     /*---------------------------------------------------------------------------------------*/

</script>
<!--
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABpVVe_0GyalUmY4SnuVktfNvSjXo2YJQ&libraries&libraries=places,geometry,drawing&callback=initAutocomplete"
         async defer></script>-->
@endsection 