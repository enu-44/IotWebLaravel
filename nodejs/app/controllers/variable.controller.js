const Variable = require('../models/variable.model.js');
const moment = require('moment');
const Moment = require('moment-timezone');




// Find a single note with a noteId
exports.findOne = (req, res) => {
    Variable.findById(req.params.variableId)
    .then(variable => {
        if(!variable) {
            return res.status(404).send({
                message: "variable not found with id " + req.params.variableId
            });            
        }
        res.send(variable);
    }).catch(err => {
        if(err.kind === 'ObjectId') {
            return res.status(404).send({
                message: "variable not found with id " + req.params.variableId
            });                
        }
        return res.status(500).send({
            message: "Error retrieving variable with id " + req.params.variableId
        });
    });
};



// Find a single note with a noteId
exports.findByVarableByEquipoRangFechas = (req, res) => {
    let coreid = req.body.id_externo;
    let name_variable = req.body.name_variable;


    let isodateinit = new Date(req.body.fecha_inicio).toISOString()
    let isodateend =  new Date(req.body.fecha_fin).toISOString()

   
    let fecha_inicio = new Date(req.body.fecha_inicio);
    let fecha_fin = new Date(req.body.fecha_fin);

    let fecha_publicacion_format_init =Moment(fecha_inicio).format("MM-DD-YYYY");
    let fecha_publicacion_format_end =Moment(fecha_fin).format("MM-DD-YYYY");

    //Variable.find({'name':name_variable },{'coreid':coreid },{'fecha_publicacion':{"$gte": new Date(isodateinit), "$lte":  new Date(isodateend)}})
    //Variable.find({'name':name_variable,'coreid':coreid,'fecha_publicacion':{"$gte": new Date(isodateinit), "$lte":  new Date(isodateend)}})
    Variable.find({name:name_variable,coreid:coreid,fecha_publicacion:{$gte: new Date(isodateinit), $lte:  new Date(isodateend)} })
    .then(variables => {
        res.send(
            {
                //isodateinit:isodateinit,
                //isodateend:isodateend,
                //name_variable:name_variable,
                //coreid:coreid,
                status: 'OK',
                variables:variables
            });
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving variables."
        });
    });


/*
    Variable.find({'name':name_variable,'coreid':coreid,'fecha_publicacion':{"$gte": new Date(isodateinit), "$lte":  new Date(isodateend)}})
    .then(variables => {
        res.send(
            {
                isodateinit:isodateinit,
                isodateend:isodateend,
            name_variable:name_variable,
            coreid:coreid,
            status: 'OK',
            variables:variables
            });
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while retrieving variables."
        });
    });*/
};


