@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          <a href="{{ url('/unidades_productivas') }}"  class="btn btn-danger btn-icon"><i class="zmdi zmdi-arrow-back"></i></a>
          Unidad Productiva <small>.</small></h2>
    </div>
    <div class="card-body card-padding">
      <form  role="form" method="POST" action="{{ url('/unidades_productivas')}}" enctype="multipart/form-data">
        @include('pages.unidad_productiva.partials.forms')
      </form>
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

    $("#icon").fileinput({
        initialPreview: [
            '<img src="/{{$unidadproductiva->path_unidad_productiva}}" width="300" />'
        ],
        showUpload: false,
        overwriteInitial: true,
        //uploadUrl: "/file-upload-batch/1",
        //uploadAsync: false,
        minFileCount: 0,
        maxFileCount: 1,
        //initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        //initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        //purifyHtml: true, // this by default purifies HTML data for preview
    }).on('filesorted', function(e, params) {
        console.log('File sorted params', params);
    }).on('fileuploaded', function(e, params) {
        console.log('File uploaded params', params);
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
           showUp();
           
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
                      //google.maps.drawing.OverlayType.MARKER,
                      google.maps.drawing.OverlayType.CIRCLE,
                      google.maps.drawing.OverlayType.POLYGON,
                      //google.maps.drawing.OverlayType.POLYLINE,
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




  ///Mostrar unidades productivas georeferenciadas
  /*---------------------------------------------------------------------------------------*/

  function showUp() {

      var centerUP= "{{$unidadproductiva->coords_ubicacion}}"
      var ordersplir= centerUP.split(",");
      ///Se  obtiene la latitud en la posision 0
      var lat=ordersplir[0];
      ///Se  obtiene la longitud en la posision 1
      var lng=ordersplir[1];

      var markerBounds = new google.maps.LatLngBounds();


     



      //map.setCenter(centerUP);
      //map.setZoom(12);


      ///poligono
      //---------------------------------------------------------------
      // Define the LatLng coordinates for the polygon.ç
      var poligono="{{$unidadproductiva->poligono}}";
      if(poligono==""){
                    ///toastr.warning("Notificacion: " + "  poligono"+poligono," Mensajeria");      
      }else{
        ///Se define un array vacio
        var poligonoCoords = [];
        ///Se crea un split apartir de |
        var splitpoligono= poligono.split("|");
       
        ///Se  recorre la variable que contine el split
        $.each(splitpoligono,function(number){
          ///Se  halla la posicion de las coordendas
          var latlongpoli=splitpoligono[number];
          ///Se  crear un nuevo split para obtener latitud y longitud
          var ordersplir= latlongpoli.split(",");
          ///Se  obtiene la latitud en la posision 0
          var lat=ordersplir[0];
          ///Se  obtiene la longitud en la posision 1
          var lng=ordersplir[1];
          ///Se agregan los datos obtenidos al array del poligono y se parsean a float
          poligonoCoords.push({lat: parseFloat(lat), lng: parseFloat(lng)});

          var centerUP = new google.maps.LatLng(lat,lng);
          
          //map.addOverlay(new GMarker(centerUP));
          markerBounds.extend(centerUP);
         
                              
        });

        map.setCenter(markerBounds.getCenter());
        map.fitBounds(markerBounds);
        // Construccion  del poligono.

        Uppoligono = new google.maps.Polygon({
          paths: poligonoCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 3,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });
                   
                      //////Funcionalidad para no duplicar formas
      google.maps.event.addListener(Uppoligono, 'map_changed', function() {
                     //console.log('visible_changed triggered');
      });
      Uppoligono.setVisible(false);
      Uppoligono.setVisible(true);
      Uppoligono.setMap(map);
    }
    //---------------------------------------------------------------

    ////Configuracion de circulos
    //---------------------------------------------------------------
    var circulos="{{$unidadproductiva->circulo}}";
    ///circulos
    //---------------------------------------------------------------
    if(circulos==""){
                     
    }else{


      /// Se crea un split
      var split= circulos.split(",");
      var latitude=split[0];
      var longitude=split[1];

      var radiusUP= "{{$unidadproductiva->radius}}";
      var radius=parseFloat(radiusUP);

      ///Se obtiene latitud y longitud de cada una pociones
      center = new google.maps.LatLng(latitude,longitude);
                  
      circleUP = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            clickable: true,
            center: center,
            radius: radius,
            editable: false,
            draggable: false
        });

        google.maps.event.addListener(circleUP, 'map_changed', function() {
                          //console.log('visible_changed triggered');
        });
        circleUP.setVisible(false);
        circleUP.setVisible(true);
        circleUP.setMap(map);

        
        //map.addOverlay(new GMarker(centerUP));
        map.fitBounds(circleUP.getBounds());

    }
    ////Configuracion de rectangulos
    //---------------------------------------------------------------
    var rectangulos="{{$unidadproductiva->rectangulo}}";
    ///Rectangulo
    //---------------------------------------------------------------
    if(rectangulos==""){
                     
    }else{
                    /// Se crea un split
                 var split1= rectangulos.split("|");
                 
                 ///Se obtiene las posiciones de NorteEsast y SouthWest
                  var getNorthEast=split1[0];
                  var getSouthWest=split1[1];
                  ///Se obtiene latitud y longitud de cada una pociones
                  var latlongNorthEast= getNorthEast.split(",");
                  var norte=parseFloat(latlongNorthEast[0]);
                  var este=parseFloat(latlongNorthEast[1]);

                  var latlongSouthWest= getSouthWest.split(",");
                  var sur=parseFloat(latlongSouthWest[0]);
                  var oeste=parseFloat(latlongSouthWest[1]);
                  
                  var boundss = {
                    north: norte,
                    south: sur,
                    east:  este,
                    west: oeste
                  };
                
                // Definir el rectángulo y establezca su propiedad editable en false.
                rectangleUP = new google.maps.Rectangle({
                          bounds: boundss,
                          editable: false,
                          draggable: true,
                          strokeColor: '#FF0000',
                          strokeOpacity: 0.8,
                          strokeWeight: 2,
                          fillColor: '#FF0000',
                          fillOpacity: 0.35,
                        });

                
                google.maps.event.addListener(rectangleUP, 'map_changed', function() {
                 //console.log('visible_changed triggered');
                });
                rectangleUP.setVisible(false);
                rectangleUP.setVisible(true);

                rectangleUP.setMap(map);
      }

      ///Marker
      //---------------------------------------------------------------


        var markers="{{$unidadproductiva->marker}}";
        //var coords = marker.split(",", 2);
                  var coords= markers.split(",");
                  var latitud= coords[0];
                  var longitud= coords[1];
                  var latLngUP = new google.maps.LatLng(latitud,longitud);
                  //  bounds.extend(latLng);
                  //if(bounds.contains(latLng)) {
                 markerUP = new google.maps.Marker({
                      position: latLngUP,
                      map: map,
                      animation:google.maps.Animation.DROP,
                      draggable:true,
                      title: "{{$unidadproductiva->name_unidad_productiva}}"
                    });
                google.maps.event.addListener(markerUP, 'map_changed', function() {
                //console.log('visible_changed triggered');
                });
                markerUP.setVisible(false);
                markerUP.setVisible(true);
    ///Contenido de Info window
    //---------------------------------------------------------------
                 
                 var imageup="{{$unidadproductiva->path_unidad_productiva}}"
                ///  console.log(data.image_up);
                  if(imageup===''){
                     var windowContent = '<b>Nombre UP:</b>  {{$unidadproductiva->name_unidad_productiva}}<br><b>Proyecto:</b>{{$unidadproductiva->proyecto_id}}<br><b>Coords Ubicacion:</b><br>{{$unidadproductiva->coords_ubicacion}}<br>'+'<a href="#" class="btn btn-link " target="_blank">'+'detalles'+'</a>';
                 
                  }else{
                    var windowContent = '<b>Nombre UP:</b>{{$unidadproductiva->name_unidad_productiva}}<br><b>Proyecto:</b>{{$unidadproductiva->proyecto_id}}<br><b>Coords Ubicacion:</b><br>{{$unidadproductiva->coords_ubicacion}}<br><b>Foto:</b><br><img src="/{{$unidadproductiva->path_unidad_productiva}}" width="150">'+'<br><a href="#" class="btn btn-link" target="_blank">'+'detalles'+'</a>';
                  }
               
          //evento click Marker
          //---------------------------------------------------------------
          if(markerUP!=null){
             var infoWindow=new google.maps.InfoWindow();
                google.maps.event.addListener(markerUP, 'click', function() {
                  // Open this map's infobox
                  infoWindow.open(map, markerUP);
                  infoWindow.setContent(windowContent);
                  map.panTo(markerUP.getPosition());
                  // infoWindow.show();
                });
          } 
          

          //evento click poligono
          //---------------------------------------------------------------
          if(Uppoligono!=null){
            google.maps.event.addListener(Uppoligono, 'click', function(event) {
                  // Open this map's infobox
                  infoWindow.open(map);
                  infoWindow.setContent(windowContent);
                 // map.panTo(boundspoligono.getCenter());
                  infoWindow.setPosition(event.latLng);
                  // infoWindow.show();
                });
          }
                 

          //evento click circle
          //---------------------------------------------------------------
           if(circleUP!=null){
             google.maps.event.addListener(circleUP, 'click', function(event) {
               
                  // Open this map's infobox
                  infoWindow.setContent(windowContent);
                 // map.panTo(boundspoligono.getCenter());
                  //infoWindow.setPosition(event.latLng);

                  infoWindow.setPosition(circleUP.getCenter());
                  infoWindow.open(map);
                  // infoWindow.show();
                });
          }
                
          ///Click en el mapa que oculta el infoWindow
          //---------------------------------------------------------------
          google.maps.event.addListener(map, 'click', function() {
              infoWindow.setMap(null);
          });
     
        
        //END MARKER DATA
        // end loop through json
    }

  /*---------------------------------------------------------------------------------------*/
  //google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABpVVe_0GyalUmY4SnuVktfNvSjXo2YJQ&libraries&libraries=places,geometry,drawing&callback=initAutocomplete"
         async defer></script>

@endsection 