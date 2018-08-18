var mongoose = require('mongoose');

var Variable =  mongoose.Schema({
  data:    { type: String, require: false },
  ttl:    { type: String, require: false },
  published_at: { type: Date, require: false },
  coreid:    { type: String, require: false },
 /// equipo_id: { type: Schema.ObjectId, ref: "Equipo" },
  equipo_id: { type: String, require: false  },
  name:    { type: String, require: false },
  fecha_publicacion:{ type: Date,require: false }, 
  fecha_publicacion_format:{ type: Date,require: false },
  hora_publicacion:{ type: String, require: false }, 
  time_published: { type: Date, require: false },
  modified: { type: Date, default: Date.now }  
});
/*
Tipoproyecto.path('model').validate(function (v) {
    return ((v != "") && (v != null));
});
*/
module.exports = mongoose.model('Variable', Variable);