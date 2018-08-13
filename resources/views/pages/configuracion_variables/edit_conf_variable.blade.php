@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          <a href="{{ url('/configurarvariables') }}"  class="btn btn-danger btn-icon"><i class="zmdi zmdi-arrow-back"></i></a>
          Configuracion de variables <small>.</small></h2>
    </div>
    <div class="card-body card-padding">
      <form  role="form" method="POST" action="{{ url('/configurarvariables')}}">
      	 <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
      	 @include('pages.configuracion_variables.partials.forms')
        
      </form>
  </div>
</div>
@endsection 
@section('footer') 
<script type="text/javascript">
    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu_variables").addClass('active');
      $(".li_configuracion_variable").addClass('active');
    }); 
</script>

<script src="{{ URL::asset('scripts/configuracion_variables.js') }}"></script>
@endsection 