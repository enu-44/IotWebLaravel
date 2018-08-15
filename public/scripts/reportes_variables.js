$(document).ready(function(){
    // Carga();
    moment().format();

      $('.datepicker').datepicker({
        autoclose: true
      });

      //Properties history
      if ($("#variable_historial").length > 0) {
          var  fecha_actual=moment().format('MM-DD-YYYY');
          $("#fechainicio").val(fecha_actual);
          $("#fechafin").val(fecha_actual);

          google.charts.load('current', {packages: ['corechart', 'line']});
          google.charts.setOnLoadCallback(drawBasic); 

      }

      Highcharts.setOptions({
          global: {
              useUTC: false
          }
      });
   

});

$('select#proyecto_id').on('change', function() {
        getUps();
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


              
                getDispositivos();
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
       getDispositivos();
  });


function getDispositivos(){    
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

             

              if( data!=null){
                  //Medidas en tiempo real
                  if ($("#content_variables_real_time").length > 0) {
                    getVariablesConfiguradas(data.id);
                  }

                  //Reporte de historial
                  if ($("#variable_historial").length > 0) {
                    $("#coreid_dispositivo").val(data.id_externo)
                    //$("#dispositivo_id").val(data.id)
                    getVariablesByDispositivo();
                  }
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


function getVariablesByDispositivo() {
    var dispositivo_id =  $('#dispositivo_id').val(); 
    if( dispositivo_id!=''){
       //alert(orientacion);
      var dataString = { 
                dispositivo_id : dispositivo_id
      };

      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/variables_config_by_id_dispositivo";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   


              $("#conf_variables_id").empty();
              var data= data.variables_configuradas;
              $.each(data, function(marker,data) {
                $("#conf_variables_id").append("<option value='"+data.name_configure+"'>"+data.alias_variable+" ("+ data.name_configure+")</option>");
            
              });

              //Actualizar select
              $('#conf_variables_id').trigger("chosen:updated");

            },
            error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
            },
      });

    }
}



//REAL TIME VAR
/*--------------------------------------------------------------------------------*/
var accessToken = "9f5ea3ea53061a600f501c97ff0015516d817bf2";
//var url = "https://api.spark.io/v1/devices";
var url = "https://api.particle.io/v1/devices/";
     

function getVariablesConfiguradas(dispositivo_id) {
    if( dispositivo_id!=''){
       //alert(orientacion);
      var dataString = { 
                dispositivo_id : dispositivo_id
      };

      var domain= document.location.origin;
      var token = $("#_token").val();
      var route=domain+"/variables_config_by_id_dispositivo";

      $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              type: "POST",
              url: route,
              data: dataString,
              dataType: "json",
              success: function(data){   

              var data= data.variables_configuradas;
              $.each(data, function(marker,data) {
                  var coreid=data.coreid_configure;
                  var nameevents=data.name_configure;
                  var alias=data.alias_variable;
                  $('#content_variables_real_time').slideDown('slow');
                  var box= $('<div id="medidasvariables'+data.id+'" class="box"><div class="box-header"><h3 class="box-title">'+alias+'</h3><div class="box-tools"><div class="input-group input-group-sm" style="width: 150px;"><input type="text" name="table_search" class="form-control pull-right" placeholder="Search"><div class="input-group-btn"><button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></div></div></div></div> <div class="box-body table-responsive no-padding"><div id="containerprueba" style=" height: 400px; width: 100%;"></div></div></div>');
                  $('#content_variables_real_time').append(box);
                  var oxi;
                  $('#medidasvariables'+data.id).highcharts({
                      chart: {
                          type: 'spline',
                          animation: Highcharts.svg, // don't animate in old IE
                          marginRight: 10,
                          events: {
                              load: function () {
                                  // set up the updating of the chart each second
                                  var series = this.series[0];
                                  //setInterval(function () {
                                    //  var x = (new Date()).getTime(), // current time
                                      //    y = Math.random();
                                      //series.addPoint([x, y], true, true);
                                  var eventSource = new EventSource(url + coreid + "/events/?access_token=" + accessToken);
                                 /// var eventSource = new EventSource(url + "events/?access_token=" + accessToken);
                                                eventSource.addEventListener('open', function(e) {
                                                console.log("Opened!"); }, false);
                                                eventSource.addEventListener('error', function(e) {console.log("Errored!"); }, false);
                                                eventSource.addEventListener(nameevents, function(e) {
                                                var parsedData = JSON.parse(e.data);
           
                                               ///console.log("si:",coreIDOxigeno);
                                               //  var x = (new Date()).getTime(), // current time
                                               var oxi=parseFloat(parsedData.data);
                                               var x = (new Date()).getTime(),
                                                                   y = parseFloat(parsedData.data);
                                                                series.addPoint([x, y],true,true);
                                                }, false);
                                 // }, 1000);
                              }
                          }
                      },
                      title: {
                          text: 'Medidas de '+alias
                      },
                      xAxis: {
                          type: 'datetime',
                          tickPixelInterval: 150
                      },
                      yAxis: {
                          title: {
                              text: alias
                          },
                          plotLines: [{
                              value: 0,
                              width: 1,
                              color: '#808080'
                          }]
                      },
                      tooltip: {
                          formatter: function () {
                              return '<b>' + this.series.name + '</b><br/>' +
                                  Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                                  Highcharts.numberFormat(this.y, 2);
                          }
                      },
                      legend: {
                          enabled: false
                      },
                      exporting: {
                          enabled: false
                      },
                      series: [{
                          name: alias,
                          data: (function () {
                              // generate an array of random data
                              var data = [],
                                  time = (new Date()).getTime(),
                                  i;
                              for (i = -19; i <= 0; i += 1) {
                                  data.push({
                                      x: time + i * 1000,
                                      y: oxi
                                  });
                              }
                              return data;
                          }())
                      }]
                  });

                });
                //$('#ciudad').trigger("chosen:updated");
              },
              error: function(xhr, status, error) {
                alert(error);
                //console.log(xhr);
            },
      });
   }
}


/*--------------------------------------------------------------------------------*/
//HISTORIAL REPORTS
/*--------------------------------------------------------------------------------*/
////  var urlservices="http://iot.bitnamiapp.com:3000/";
var urlservices="http://52.91.0.54:3000/";
  var urlvariablebyequipo=urlservices+"variablefecha";
    
  //Click para buscar variables registrda por equipos dependiendo de la fecha seleccionada
  ///===================================================================
  $(document).on('click','#btnBuscarHistorial', function() { 
    $('#loader').slideDown('slow');
    var datos= [];
    $("#lista_medidas").empty();
      var fecha_inicio = $("#fechainicio").val();
       var fecha_fin = $("#fechafin").val();
     // alert(fecha_publicacion);
      var coreid = $("#coreid_dispositivo").val();
      var name_variable= $("#conf_variables_id").val();

      var nombre_variable_selected=$("#conf_variables_id option:selected").text();

      var dataString={
             fecha_inicio:fecha_inicio,
             fecha_fin:fecha_fin,
             coreid:coreid,
             name_variable:name_variable
      }

     
      $.ajax ({
            url: urlvariablebyequipo,
            type: "POST",
            dataType: "json",
            data: dataString,
           success: function(data){
            $('#loader').slideUp('slow');
            var variables=[];
            variables=data.variable;
            var variablesdata=[];
            $.each(variables, function(index,variable) {
                    variablesdata.push([parseFloat(variable.data)]);

            });


          Highcharts.theme = {
             colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
                '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
             chart: {
                backgroundColor: {
                   linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                   stops: [
                      [0, '#2a2a2b'],
                      [1, '#3e3e40']
                   ]
                },
                style: {
                   fontFamily: '\'Unica One\', sans-serif'
                },
                plotBorderColor: '#606063'
             },
             title: {
                style: {
                   color: '#E0E0E3',
                   textTransform: 'uppercase',
                   fontSize: '20px'
                }
             },
             subtitle: {
                style: {
                   color: '#E0E0E3',
                   textTransform: 'uppercase'
                }
             },
             xAxis: {
                gridLineColor: '#707073',
                labels: {
                   style: {
                      color: '#E0E0E3'
                   }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                title: {
                   style: {
                      color: '#A0A0A3'

                   }
                }
             },
             yAxis: {
                gridLineColor: '#707073',
                labels: {
                   style: {
                      color: '#E0E0E3'
                   }
                },
                lineColor: '#707073',
                minorGridLineColor: '#505053',
                tickColor: '#707073',
                tickWidth: 1,
                title: {
                   style: {
                      color: '#A0A0A3'
                   }
                }
             },
             tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.85)',
                style: {
                   color: '#F0F0F0'
                }
             },
             plotOptions: {
                series: {
                   dataLabels: {
                      color: '#B0B0B3'
                   },
                   marker: {
                      lineColor: '#333'
                   }
                },
                boxplot: {
                   fillColor: '#505053'
                },
                candlestick: {
                   lineColor: 'white'
                },
                errorbar: {
                   color: 'white'
                }
             },
             legend: {
                itemStyle: {
                   color: '#E0E0E3'
                },
                itemHoverStyle: {
                   color: '#FFF'
                },
                itemHiddenStyle: {
                   color: '#606063'
                }
             },
             credits: {
                style: {
                   color: '#666'
                }
             },
             labels: {
                style: {
                   color: '#707073'
                }
             },

             drilldown: {
                activeAxisLabelStyle: {
                   color: '#F0F0F3'
                },
                activeDataLabelStyle: {
                   color: '#F0F0F3'
                }
             },

             navigation: {
                buttonOptions: {
                   symbolStroke: '#DDDDDD',
                   theme: {
                      fill: '#505053'
                   }
                }
             },

             // scroll charts
             rangeSelector: {
                buttonTheme: {
                   fill: '#505053',
                   stroke: '#000000',
                   style: {
                      color: '#CCC'
                   },
                   states: {
                      hover: {
                         fill: '#707073',
                         stroke: '#000000',
                         style: {
                            color: 'white'
                         }
                      },
                      select: {
                         fill: '#000003',
                         stroke: '#000000',
                         style: {
                            color: 'white'
                         }
                      }
                   }
                },
                inputBoxBorderColor: '#505053',
                inputStyle: {
                   backgroundColor: '#333',
                   color: 'silver'
                },
                labelStyle: {
                   color: 'silver'
                }
             },

             navigator: {
                handles: {
                   backgroundColor: '#666',
                   borderColor: '#AAA'
                },
                outlineColor: '#CCC',
                maskFill: 'rgba(255,255,255,0.1)',
                series: {
                   color: '#7798BF',
                   lineColor: '#A6C7ED'
                },
                xAxis: {
                   gridLineColor: '#505053'
                }
             },

             scrollbar: {
                barBackgroundColor: '#808083',
                barBorderColor: '#808083',
                buttonArrowColor: '#CCC',
                buttonBackgroundColor: '#606063',
                buttonBorderColor: '#606063',
                rifleColor: '#FFF',
                trackBackgroundColor: '#404043',
                trackBorderColor: '#404043'
             },

             // special colors for some of the
             legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
             background2: '#505053',
             dataLabelsColor: '#B0B0B3',
             textColor: '#C0C0C0',
             contrastTextColor: '#F0F0F3',
             maskColor: 'rgba(255,255,255,0.3)'
          };



            // Apply the theme
            Highcharts.setOptions(Highcharts.theme);
            Highcharts.chart('container', {
                global: {
                   useUTC: false
                },
                chart: {
                    type: 'spline',
                   
                },
                title: {
                    text: 'Medida de '+nombre_variable_selected+' durante '+ 
                    moment( new Date($("#fechainicio").val())).locale("es").format('LL')+
                    ' al '+
                     moment( new Date($("#fechafin").val())).locale("es").format('LL')
                },
                subtitle: {
                    text: 'valores de '+nombre_variable_selected+''
                },

                xAxis: {        
                    type: 'datetime',
                    
                    dateTimeLabelFormats: {
                      day: "%e. %b",
                      month: "%b '%y",
                      year: "%Y"
                    }
                },
                yAxis: {
                    title: {
                        text: 'Valor '+nombre_variable_selected+' (v/t)'
                    },
                    minorGridLineWidth: 0,
                    gridLineWidth: 0,
                    alternateGridColor: null,
                    
                },
               
                tooltip: {
                    valueSuffix: ' ' //sigla del valor obtenido
                },

                tooltip: {
                  formatter: function () {

                    var date =  moment(this.x).locale("es").format("LLLL");
                   // date.locale('es');

                    var tag = 'AM';
                    checkTime(this.x);
                    if(h > 12) {
                     h -= 12
                     tag = 'PM';
                    }
                    var hour= h + ':' + m + ':' + s + ' ' + tag;

                    return '<b>' + this.series.name + '</b><br/>' +
                      date+'<br/>' +
                      hour+'<br/>' +
                      //Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                      '<strong style="font-size:22px;">'+Highcharts.numberFormat(this.y, 2)+'<strong>';
                  }
                },
             
                series: [{
                    name: nombre_variable_selected,
                    data: (function () {
                                // generate an array of random data
                              var data = [];
                            
                              $.each(variables, function(index,variable) {
                                     var oxi=parseFloat(variable.data);
                                    var datetimeData = (new Date(variable.time_published)),
                                    datavar = parseFloat(variable.data);
                                    data.push({
                                        x: datetimeData,
                                        y: datavar
                                    });
                              });
                              return data;
                            }())
                      
                }],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            });


            $.each(variables, function(marker,variables){
            fecha= variables.published_at;
            var d = new Date(fecha);
            var n = d.toLocaleString();
            //// var fechalocal= moment(d, ["MM-DD-YYYY", "DD-MM-YYYY"], 'es');  
            ///console.log("Fecha: ",fechalocal);
             });


            var lista_medidas = $("#lista_medidas");
            var table = $('#example').DataTable( {
                data: data.variable,
                destroy: true,
                dom: 'Bfrtip',
                order: [[ 0, "desc" ]],
                lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 filas', '25 filas', '50 filas', 'Todo' ]
                   ],
                paging: true,
                buttons: [
                      'copy', 'csv', 'excel', 'print','pageLength','colvis',
                       {
                        extend: 'pdf',
                        message: 'Reporte de medidas de variables.'
                        //download: 'open'
                      }
                  ],
                  /*
                  columnDefs: [ {
                  targets: 2,
                  render: $.fn.dataTable.render.moment( 'X', 'Do MMM YY' )
                } ],*/
                "columns": [
                  { "data": "_id" },
                  { "data": "data" },
                  { "data": "time_published",
                  "render": function (data) {
                      var date = new Date(data);
                      var month = date.getMonth() + 1;
                      return  date.getDate() +"/" +(month.length > 1 ? month :  month) + "/" + date.getFullYear();
                  }
                  },
                  { "data": "coreid" },
                  { "data": "name" },
                ///  { "data": "fecha_publicacion" },
                  { "data": "hora_publicacion" }
                ]
            } );
           // alert("yes");
            }, 
           error: function(xhr) { 
           // $('#gifcargando').slideUp('slow');
           $('#loader').slideUp('slow');
            alert("Fallo la conexion al servidor"); }
          });
       // setTimeout('cargargrafico()',1000);
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic);

  });



function checkTime(date) {
  var dateselected = new Date(date);
  h = dateselected.getHours();
  m = dateselected.getMinutes();
  s = dateselected.getSeconds();
  if(h < 10)
   h = '0' + h;
  if(m < 10)
   m = '0' + m;
  if(s < 10)
   s = '0' + s;
  return h, m, s;
 }

///===================================================================
function drawBasic() {      
      var datagrafic = new google.visualization.DataTable();
      datagrafic.addColumn('datetime', 'Fecha y Hora');
      datagrafic.addColumn('number', 'Valor');
      var fecha_inicio = $("#fechainicio").val();
      var fecha_fin = $("#fechafin").val();
      var coreid = $("#coreid_dispositivo").val();
       var name_variable= $("#conf_variables_id").val();

      var dataString={
             fecha_inicio:fecha_inicio,
             fecha_fin:fecha_fin,
             coreid:coreid,
             name_variable:name_variable
      }
      
      variablesdata=[];
           $.ajax ({
                url: urlvariablebyequipo,
                type: "POST",
                dataType: "json",
                data:dataString,
                success: function(data){
                var concecutivo=0;
                var variables=[];
                variables=data.variable;
                  $.each(variables, function(marker,variables) {
                      concecutivo=concecutivo+1;
                      variablesdata.push([ new Date(variables.time_published), parseFloat(variables.data)]);
                      });
                      datagrafic.addRows(variablesdata);
                      var options = {
                          hAxis: {
                            title: 'Fecha',
                            format:'MMM d, y'
                          },
                          vAxis: {
                            title: 'Valor'
                          },
                          colors: ['#a52714']
                      };

                      ////var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                      var chart = new google.charts.Line(document.getElementById('chart_div'));
                      
                      chart.draw(datagrafic, options);

                      }, 
                      error: function(xhr) { alert("Request Error"); }
                    });

    }



/*-------------------------------------------------------------------------------*/







