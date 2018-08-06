@csrf
<input type="hidden" name="id">
<div class="form-group">
    <div class="fg-line">
     <label class="fg-label">Nombre</label>
     <input type="text" name="name"   class="input-sm form-control fg-input " required>
     @if ($errors->has('name'))
     <div class="has-error">
      <small class="help-block">{{ $errors->first('name') }}</small>
    </div>
    @endif
  </div>
</div>

<div id="content_sigla" style="display: none;" class="form-group">
  <div class="fg-line">
   <label class="fg-label">Sigla</label>
   <input type="text" name="sigla"   class="input-sm form-control fg-input ">
   @if ($errors->has('sigla'))
   <div class="has-error">
    <small class="help-block">{{ $errors->first('sigla') }}</small>
  </div>
  @endif
  </div>
</div>

<div class="form-group">
  <div class="fg-line">
   <label class="fg-label">Descripcion</label>
  <textarea class="form-control rounded-0" name="description" rows="5" required></textarea>
   @if ($errors->has('description'))
   <div class="has-error">
    <small class="help-block">{{ $errors->first('description') }}</small>
  </div>
  @endif
  </div>
</div>


@if(!empty($tipo_proyectoslist))
  <div  class="form-group">
    <div class="fg-line">
      <label class="fg-label">Tipo Proyecto</label>   
        <select name="tipo_proyecto_id" id="tipo_proyecto_id" class="chosen" data-placeholder="Tipo Proyecto..." required="true">
        <option></option>

          @foreach($tipo_proyectoslist as $item)
            <option value="{{$item->id}}">{{$item->name_tipo_proyecto}}</option>
          @endforeach
        </select>
          @if ($errors->has('tipo_proyecto_id'))
            <div class="has-error">
                <small class="help-block">{{ $errors->first('tipo_proyecto_id') }}</small>
            </div>
          @endif
    </div>
  </div>
@else


@endif




<div class="form-group ">
  <button type="submit" id="subir" class="btn btn-danger">
    Guardar
  </button>
</div>