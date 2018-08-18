const express = require('express');
const bodyParser = require('body-parser');
const http    =require('http');
const morgan     = require('morgan');
const Particle = require('particle-api-js');
const moment = require('moment');
const mongoose   = require('mongoose');
/////Permite Obtener zona horaria de Colombia
const Moment = require('moment-timezone');
const socket = require('socket.io');

const dbConfig = require('./config/database.config.js');

const Variable = require('./app/models/variable.model.js');
const particle =  new Particle();


mongoose.Promise = global.Promise;

// Connecting to the database
mongoose.connect(dbConfig.url, {
    useNewUrlParser: true
}).then(() => {
    console.log("Successfully connected to the database");    
}).catch(err => {
    console.log('Could not connect to the database. Exiting now...');
    process.exit();
});


// create express app
const app = express();


// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }))

// parse requests of content-type - application/json
app.use(bodyParser.json())


//Cross Origin
app.use((req, res, next)=> {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT,DELETE");
  res.header("Access-Control-Allow-Headers","Content-Type,Origin,Content-Type, Access-Control-Allow-Headers, Authorization,Accept, X-Requested-With")
 // res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
// "Access-Control-Allow-Headers": "Content-Type,Origin,Content-Type, Access-Control-Allow-Headers, Authorization,Accept, X-Requested-With"
  next();
});


// define a simple route
app.get('/', (req, res) => {
    res.json({"message": "Welcome to EasyNotes application. Take notes quickly. Organize and keep track of all your notes."});
});

// Require Variables routes
require('./app/routes/variable.routes.js')(app);



// listen for requests
app.listen(3000, () => {
    console.log("Server is listening on port 3000");
});


////Funcionalidad de particle.io
///===================================================================================================
var token; // from result of particle.login
particle.login({username: 'direstrepo@misena.edu.co', password: 'Isabella7824*'}).then(
  function(data){
    ///console.log('API call completed on promise resolve: ', data.body.access_token);
    token=data.body.access_token;
   //// console.log('API call completed on promise resolve: ', token);
    var devicesPr = particle.listDevices({ auth: token });
    devicesPr.then(
      function(devices){
        
      devices.body.forEach(function(device) {
            /////  console.log(device.name, device.id);
            particle.getEventStream({ deviceId:device.id ,auth: token}).then(function(stream) {
            stream.on('event', function(data) {
                     //// console.log("Event: " +data.published_at);
                     /////Obtener Hora de Bogota/Colombia
                      var NewDate = new Date();
                      var Bogota=Moment.tz(NewDate,"America/Bogota");
                      var fecha_publicacion =Bogota.format('MM-DD-YYYY'); 
                      var fecha_publicacion_format =Moment(NewDate).format("MM-DD-YYYY"); 
                      var hora_publicacion =Bogota.format('h:mm:ss a'); 
                      var time_published=Bogota.format();
                      var coreid = data.coreid;
                      var name = data.name;
                      var ttl= data.ttl;
                      var datamedidad= data.data;
                      var published_at = data.published_at;
                      var equipo_id=data.coreid;
                      
                      ////Instancia del modelo para guardar datos de las varibles
                      var variable =  Variable({
                            data:datamedidad,
                            ttl:ttl,
                            published_at:published_at,
                            coreid:coreid,
                            name:name,
                            equipo_id:equipo_id,
                            fecha_publicacion:fecha_publicacion,
                            fecha_publicacion_format:fecha_publicacion_format,
                            hora_publicacion:hora_publicacion,
                            time_published:time_published,
                           
                      });

                      ///Guardar datos
                      variable.save();
                      console.log("fecha_publicacion_format:",fecha_publicacion_format);

                      console.log("EQUIPO:",coreid,"Data:",datamedidad,"---",hora_publicacion,"---",time_published);
                      console.log("DEVICE PARTICLE: ",data);
                    });
                  });  
               });
        },
      function(err) {
        console.log('List devices call failed: ', err);
      }
    );
  },
  function(err) {
    console.log('API call completed on promise fail: ', err);
  }
);


