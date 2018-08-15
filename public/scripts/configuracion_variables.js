  
$(document).ready(function(){
    // Carga();
    if ($("#proyecto_id").length > 0) {
     getUps(false);

     //getUps();
     //$("select#proyecto_id").change(getUps);
    }

});


$('select#proyecto_id').on('change', function() {
        getUps(true);
  });



function getUps(is_change){    
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

                if(is_change==false){
                   if ($("#unidadproductiva_update").length > 0) {
                    $('#unidadproductiva_id').val($('#unidadproductiva_update').val());
                    $('#unidadproductiva_id').trigger("chosen:updated");

                  }
                }

              
                getDispositivos(false);
                //getDispositivos();
                //$("select#unidadproductiva_id").change(getDispositivos);
                //$('#ciudad').trigger("chosen:updated");
              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
              },
      });
   } 
  }

  $('select#unidadproductiva_id').on('change', function() {
       getDispositivos(true);
  });


function getDispositivos(is_change){    
    if( $('#unidadproductiva_id').val()!=''){
      var unidadproductiva_id =  $('#unidadproductiva_id').val();

       //alert(orientacion);
      var dataString = { 
                unidadproductiva_id : unidadproductiva_id
      };
      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/dispositivos_by_up";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   

                $("#dispositivo_id").empty();
                var dispositivo=data.dispositivos;
                $(dispositivo).each(function(key,dispositivo){
                   $("#dispositivo_id").append("<option value='"+dispositivo.id+"'>"+dispositivo.name+" ("+ dispositivo.name_tipo_dispositivos+")</option>");
                });

                //Actualizar select
                $('#dispositivo_id').trigger("chosen:updated");

                //se ejecuta cuando se edita un item
                if(is_change==false){
                   if ($("#dispositivo_update").length > 0) {
                    $('#dispositivo_id').val($('#dispositivo_update').val());
                    $('#dispositivo_id').trigger("chosen:updated");
                   // $('#unidadproductiva_id').prop('disabled', true).trigger("chosen:updated");
                   // $('#proyecto_id').prop('disabled', true).trigger("chosen:updated");
                  }
                }
                
                getDispositivo();

              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
              },
      });
   } 
  }


  $('select#dispositivo_id').on('change', function() {
       getDispositivo()
  });



function getDispositivo() {
    if( $('#dispositivo_id').val()!=''){
      var dispositivo_id =  $('#dispositivo_id').val();
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
                 $('#coreid_configure').val(data.id_externo);
                 //$('#coreid_configure').prop('disabled', true);
                 
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






