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



// create express app
const app = express();

// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }))

// parse requests of content-type - application/json
app.use(bodyParser.json())

// define a simple route
app.get('/', (req, res) => {
    res.json({"message": "Welcome to EasyNotes application. Take notes quickly. Organize and keep track of all your notes."});
});

// listen for requests
app.listen(3000, () => {
    console.log("Server is listening on port 3000");
});








/*

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



///Libreria de particle instancia
const particle =  Particle();




// create express app
const app = express();

// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }))

// parse requests of content-type - application/json
app.use(bodyParser.json())

// define a simple route
app.get('/', (req, res) => {
    res.json({"message": "Welcome to EasyNotes application. Take notes quickly. Organize and keep track of all your notes."});
});

// listen for requests
app.listen(3000, () => {
    console.log("Server is listening on port 3000");
});









*/