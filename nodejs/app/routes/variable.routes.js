module.exports = (app) => {
    const variable = require('../controllers/variable.controller.js');
    /*
    // Create a new Note
    app.post('/notes', notes.create);
    // Retrieve all Notes
    app.get('/notes', notes.findAll);
    // Retrieve a single Note with noteId
    app.get('/notes/:noteId', notes.findOne);
    // Update a Note with noteId
    app.put('/notes/:noteId', notes.update);
    // Delete a Note with noteId
    app.delete('/notes/:noteId', notes.delete);
    */

    //Link routes and functions
    //app.get('/variable/:coreid/:fecha_publicacion', variable.findByVarableByEquipo);
    //app.get('/variables', variable.findAllVariable);
    //app.post('/variable', variable.addVariable);
    app.post('/variablefecha', variable.findByVarableByEquipoRangFechas);
    //app.put('/variable/:id', variable.updateVariable);
    //app.delete('/variable/:id', variable.deleteVariable);
    // Retrieve a single Note with noteId
    app.get('/variable/:variableId', variable.findOne);
}