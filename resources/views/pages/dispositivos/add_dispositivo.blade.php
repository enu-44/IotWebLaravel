@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          <a href="{{ url('/dispositivos') }}"  class="btn btn-danger btn-icon"><i class="zmdi zmdi-arrow-back"></i></a>
          Dispositivo <small>.</small></h2>
    </div>
    <div class="card-body card-padding">
      <form  role="form" method="POST" action="{{ url('/dispositivos')}}">
      	 <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
      	 @include('pages.dispositivos.partials.forms')
        
      </form>
  </div>
</div>
@endsection 
@section('footer') 
<script type="text/javascript">
    $(document).ready(function($){
      $(".home").removeClass('active');
      $(".li_menu").addClass('active');
      $(".li_dispositivo").addClass('active');
    }); 
    
</script>

<script src="{{ URL::asset('scripts/dispositivos.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABpVVe_0GyalUmY4SnuVktfNvSjXo2YJQ&libraries&libraries=places,geometry,drawing&callback=initAutocomplete"
         async defer></script>
@endsection 