var map;
var center;
   
$(document).ready(function(){
    // Carga();
    if ($("#proyecto_id").length > 0) {
     getUps();
     $("select#proyecto_id").change(getUps);
    }

    getDispositivosRemote();

});



function getUps(){    
    if( $('#proyecto_id').val()!=''){
      var proyecto_id =  $('#proyecto_id').val();
   
       //alert(orientacion);
      var dataString = { 
                proyecto_id : proyecto_id
      };
      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/up_by_proyecto";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   
                $("#unidadproductiva_id").empty();
                var ups=data.unidades_productivas;
                $(ups).each(function(key,ups){
                   $("#unidadproductiva_id").append("<option value='"+ups.id+"'>"+ups.name_unidad_productiva+"</option>");
                });

                //Actualizar select
                $('#unidadproductiva_id').trigger("chosen:updated");

                if ($("#unidadproductiva_update").length > 0) {
                    $('#unidadproductiva_id').val($('#unidadproductiva_update').val());
                    $('#unidadproductiva_id').trigger("chosen:updated");


                    $("input[name=unidadproductiva_id]").val($('#unidadproductiva_update').val());


                    $('#unidadproductiva_id').prop('disabled', true).trigger("chosen:updated");
                    $('#proyecto_id').prop('disabled', true).trigger("chosen:updated");
                }

                getUpsById();
                $("select#unidadproductiva_id").change(getUpsById);
                 

                //$('#ciudad').trigger("chosen:updated");
              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
              },
      });
   } 
  }


  function getUpsById(){ 

    if( $('#unidadproductiva_id').val()!=''){
    var unidadproductiva_id =  $('#unidadproductiva_id').val();
   
       //alert(orientacion);
      var dataString = { 
                unidadproductiva_id : unidadproductiva_id
      };
      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/up_by_id";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   
                //console.log(data)
                getUpMap(data)
                 

                //$('#ciudad').trigger("chosen:updated");
              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
              },
      });
   } 
  }


  function getDispositivosRemote(){
    var coreID = "230035000547353138383138";
    var accessToken = "9f5ea3ea53061a600f501c97ff0015516d817bf2";
    //var url = "https://api.spark.io/v1/devices";
    var urlsdevices = "https://api.particle.io/v1/devices/";
    $.ajax({
                    type: "GET",
                    url: urlsdevices,
                    data: {
                         access_token: accessToken
                    },
                    success:function(data) {

                   
                        var select_equipos = $("#dispositivos_remotos");
                        data.forEach(function(device) {
                        
                          ///$("#equipos").text(device.name); 
                          select_equipos.append("<option value="+device.id+" selected>"+device.name+"</option>");    
                        });

                        select_equipos.trigger("chosen:updated");

                        if ($("#dispositivo_remotos_id").length > 0) {
                          $('#dispositivos_remotos').val($("#dispositivo_remotos_id").val());
                          $('#dispositivos_remotos').trigger("chosen:updated");
                        }

                        //// getIdEquipos(id);
                        getIdEquipos(); //this calls it on load
                        $("select#dispositivos_remotos").change(getIdEquipos);
                    }
              });
  }



  function getIdEquipos(){
    var urlsdevices = "https://api.particle.io/v1/devices/";
    var accessToken = "9f5ea3ea53061a600f501c97ff0015516d817bf2";

    var id=$("#dispositivos_remotos option:selected").val();
       

    /// alert("id:.."+id);
    $.ajax({
                type: "GET",
                url: urlsdevices+id,
                data: {
                     access_token: accessToken
                },
                success:function(data) {
                  /// console.log("Data: ",data);
                  /// console.log("DataSelect:",data.name);
                  ///Si es unce lular ejecuta esta accion
                  if(data.cellular==true){

                  $("#cellular").val(data.cellular);
                  $("#connected").val(data.connected);
                  $("#current_build_target").val(data.current_build_target);
                  $("#id").val(data.id);
                  $("#id_externo").val(data.id);
                  $("#imei").val(data.imei);
                  $("#last_app").val(data.last_app);
                  $("#last_heard").val(data.last_heard);
                  $("#last_iccid").val(data.last_iccid);
                  $("#last_ip_address").val(data.last_ip_address);
                  $("#name").val(data.name);
                  $("#platform_id").val(data.platform_id);
                  $("#product_id").val(data.product_id);
                  $("#status").val(data.status);
                  }  ///Si no es unce lular ejecuta esta accion
                  else{
                  $("#cellular").val(data.cellular);
                  $("#connected").val(data.connected);
                  $("#current_build_target").val('');
                  $("#id_externo").val(data.id);
                  $("#imei").val('');
                  $("#last_app").val(data.last_app);
                  $("#last_heard").val(data.last_heard);
                  $("#last_iccid").val('');
                  $("#last_ip_address").val(data.last_ip_address);
                  $("#name").val(data.name);
                  $("#platform_id").val(data.platform_id);
                  $("#product_id").val(data.product_id);
                  $("#status").val(data.status);
                  }
                },
                    //// getIdEquipos(id);
      });
  }

 ///Google maps
/*---------------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------*/


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
      }
    }
    ////Eliminar todas las formas dibujdas en el mapa
    function deleteAllShape() {
      for (var i = 0; i < all_overlays.length; i++) {
        all_overlays[i].overlay.setMap(null);
      }
      all_overlays = [];
      $("#coords_dispositivo").val('');
    }



///Iniciar el mapa
/*---------------------------------------------------------------------------------------*/
function initAutocomplete() {
      var latitude = 4.570868,
          longitude = -74.29733299999998,
          center = new google.maps.LatLng(latitude,longitude),
          /// bounds = new google.maps.Circle({center: center, radius: radius}).getBounds(),
          mapOptions = {
                    center: center,
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    scrollwheel: false,
                    fullscreenControl:true,
          };
          map = new google.maps.Map(document.getElementById("map"), mapOptions);
          dibujarFormasMapa();

}


///dibujar formas mapa
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
                      google.maps.drawing.OverlayType.MARKER
                     
                    ]
                  },
                  markerOptions: {
                    icon: '/img/ico3small2.gif',
                    draggable: true
                  },
                  map: map
                });

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
             
              // Clear the current selection when the drawing mode is changed, or when the
              // map is clicked.
              google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
              google.maps.event.addListener(map, 'click', clearSelection);
              google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
              google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);

              /////Funcion cuando se dibuja un marker
              google.maps.event.addListener(drawingManager, 'overlaycomplete', function(marker) {
                if (marker.type == google.maps.drawing.OverlayType.MARKER) {
                  var latitud = marker.overlay.getPosition().lat();
                  var longitud = marker.overlay.getPosition().lng();
                  $('#coords_dispositivo').val(latitud+","+longitud);
                }
               
               
              });
              ///Evento obtener coordenadas de la posicion del marker  dragend
            google.maps.event.addListener(drawingManager, 'markercomplete', function (marker) {
                google.maps.event.addListener(marker, 'drag', function () {
                    document.getElementById("coords_dispositivo").value = this.getPosition().lat()+","+ this.getPosition().lng();
        
                });
            });
              
    } 



function getUpMap(data) {

      var infoWindow=new google.maps.InfoWindow();
      var markerEquipo= new google.maps.Marker({});
      var Uppoligono= new google.maps.Polygon({});
      var circleUP= new google.maps.Circle({});
      var rectangleUP= new google.maps.Rectangle({});
      var markerUP = new google.maps.Marker({}); 

      // Create the autocomplete object, restricting the search to geographical
      // location types.
      ///Inicio Configuracion Mapa 
      var id = $("#unidadproductiva_id option:selected").val();
      if(id!=null){
         
     ///////Mostrar unidades productiva seleccionada
     /*---------------------------------------------------------------------------------------*/
      
      var markerBounds = new google.maps.LatLngBounds();

      var datos;
      datos=data.unidad_productiva;
      ///console.log(datos);
      //END MARKER DATA
      ///Obtener Localizacion de Unidad Productiva seleccionada por defecto
      var ubicacion_up=datos.coords_ubicacion;
      var coordsup= ubicacion_up.split(",");
      var latitude= coordsup[0];
      var longitude= coordsup[1];
      ///Se alamacenan los datos obtenidos e la variable centerUP
      ///Se Inicia el mapa
      var centerUP = new google.maps.LatLng(latitude,longitude);
      map.setCenter(centerUP);
      //map.setZoom(18);

      ///poligono
      //---------------------------------------------------------------
      // Define the LatLng coordinates for the polygon.  
      var poligono=datos.poligono;
      if(poligono=="" || poligono==null){
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
              markerBounds.extend(centerUP);         
          });

          map.setCenter(markerBounds.getCenter());
          map.fitBounds(markerBounds);

          // Construccion  del poligono.
          Uppoligono.setPaths(poligonoCoords);
          Uppoligono.set("strokeColor", '#FF0000');
          Uppoligono.set("strokeOpacity", 0.8);
          Uppoligono.set("strokeWeight", 3);
          Uppoligono.set("fillColor", '#FF0000');
          Uppoligono.set("fillOpacity", 0.35);

         
          Uppoligono.setMap(map);
      }


      //---------------------------------------------------------------
      ////Configuracion de circulos
      //---------------------------------------------------------------
      var circulos=datos.circulo;
      ///circulos
      //---------------------------------------------------------------
      if(circulos=="" || circulos==null){
                       
      }else{

      /// Se crea un split
      var split= circulos.split(",");
      var latitude=split[0];
      var longitude=split[1];

      var radiusUP= datos.radius;
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

        circleUP.setMap(map);

        ///console.log(latitude+"  "+longitude+"  "+radius);

        //map.addOverlay(new GMarker(centerUP));
        map.fitBounds(circleUP.getBounds());
      }


      ///Configuracion de rectangulos
      //---------------------------------------------------------------
      var rectangulos=datos.rectangulo;
      ///Rectangulo
      //---------------------------------------------------------------
            if(rectangulos=="" || rectangulos==null){
                       
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

            ////toastr.success("Notificacion: " + " piscinas"+oeste," Mensajeria"); 
            // Definir el rectángulo y establezca su propiedad editable en false.
                    
            rectangleUP.set("bounds", boundss);
            rectangleUP.set("editable", false);
                    rectangleUP.set("draggable", true);
                    rectangleUP.set("strokeColor", '#FF0000');
                    rectangleUP.set("strokeOpacity", 0.8);
                    rectangleUP.set("strokeWeight", 2);
                    rectangleUP.set("fillColor", '#FF0000');
                    rectangleUP.set("fillOpacity", 0.35);
                    rectangleUP.setMap(map);
        }

            //---------------------------------------------------------------
            ///Marker
            //---------------------------------------------------------------
            var markers=datos.marker;
            if(markers=="" || markers==null){
                       
            }else{
                 //var coords = marker.split(",", 2);
                    var coords= markers.split(",");
                    var latitud= coords[0];
                    var longitud= coords[1];
                    var latLngUP = new google.maps.LatLng(latitud,longitud);
                    //  bounds.extend(latLng);
                    //if(bounds.contains(latLng)) {
                    markerUP.set("map", map);
                    markerUP.set("animation", google.maps.Animation.DROP);
                    markerUP.set("position", latLngUP);
                    markerUP.set("title", datos.nombre_unidad_productiva);
                    markerUP.set("draggable", true);
            }
              
           
                    ///Obtener nombre del proyecto
                    
                    if(datos.image_up==''){
                      var windowContent = '<b>Nombre UP:</b>'+datos.name_unidad_productiva+'<br><b>Proyecto:</b>'+datos.name_proyecto+'<br><b>Coords Ubicacion:</b><br>'+datos.coords_ubicacion+'<br>'+'<a href="#" class="btn btn-link " target="_blank">'+'detalles'+'</a>';
                   
                    }else{
                      var windowContent = '<b>Nombre UP:</b>'+datos.name_unidad_productiva+'<br><b>Proyecto:</b>'+datos.name_proyecto+'<br><b>Coords Ubicacion:</b><br>'+datos.coords_ubicacion+'<br><b>Foto:</b><br><img src="/'+datos.path_unidad_productiva+'" width="150">'+'<br><a href="#" class="btn btn-link" target="_blank">'+'detalles'+'</a>';
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


          if ($("#id_update_dispositivo").length > 0) {
            getDispositivo()
          }
      }else{

        var centerpoint = new google.maps.LatLng(4.570868,-74.29733299999998);
        map.setCenter(centerpoint);
        map.setZoom(5);
        //toastr.error("Notificacion: " + "Sin Unidad Productiva para mostrar"," Mensajeria");  

      }     
    }


function getDispositivo() {
    if( $('#id_update_dispositivo').val()!=''){
    var dispositivo_id =  $('#id_update_dispositivo').val();
   
       //alert(orientacion);
      var dataString = { 
                dispositivo_id : dispositivo_id
      };
      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/dispositivo_by_id";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   

              var data= data.dispositivo;
              if (data.length !== 0) {

                 var markerEquipo = new google.maps.Marker({}); 
                  ///console.log(data.coordsUbicacionEquipo);
                  ///infoWindow
                  var infoWindow = new google.maps.InfoWindow();
                   /// console.log(infoWindow);
                   ///MarkerEquipo
                   //---------------------------------------------------------------
                    var markersEquipo=data.coords_dispositivo;
                    //var coords = marker.split(",", 2);
                    var coordsEquipo= markersEquipo.split(",");
                    var latitud= coordsEquipo[0];
                    var longitud= coordsEquipo[1];
                    var latLngEquipo = new google.maps.LatLng(latitud,longitud);
                    //  bounds.extend(latLng);
                    //if(bounds.contains(latLng)) {
                    ////Agregando propiedades
                    markerEquipo.set("icon", '/img/ico3small2.gif');
                    markerEquipo.set("map", map);
                    markerEquipo.set("animation", google.maps.Animation.DROP);
                    markerEquipo.set("position", latLngEquipo);
                    markerEquipo.set("title", data.name);
                    markerEquipo.set("draggable", true);

                    //poligonoCoords.push();
                    var windowContentEquipo = '<b>Descripcion Equipo:</b><br>'+data.descripcion_dispositivo+'<br><b>Conectado:</b>'+data.connected+'<br><b>Coords Ubicacion:</b><br>'+data.coords_dispositivo+'<br><b>Nombre Equipo:</b><br>'+data.name+'<br>';


                    //evento click MarkeEquipo
                    //---------------------------------------------------------------
                    google.maps.event.addListener(markerEquipo, 'click', function() {
                      infoWindow.open(map, markerEquipo);
                      infoWindow.setContent(windowContentEquipo);
                      infoWindow.setOptions({maxWidth:750}); 
                      map.panTo(markerEquipo.getPosition());
                    });


                     ///Click en el mapa que oculta el infoWindow
              //---------------------------------------------------------------
                    google.maps.event.addListener(map, 'click', function() {
                      infoWindow.setMap(null);
                    });
               } 
                //$('#ciudad').trigger("chosen:updated");
              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
            },
      });
   }

}
