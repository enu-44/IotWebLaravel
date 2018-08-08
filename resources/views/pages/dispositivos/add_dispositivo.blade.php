@extends('layouts.master_page')
@section('content')
<div class="card">
    <div class="card-header">
        <h2> 
          <a href="{{ url('/unidades_productivas') }}"  class="btn btn-danger btn-icon"><i class="zmdi zmdi-arrow-back"></i></a>
          Dispositivo <small>.</small></h2>
    </div>
    <div class="card-body card-padding">
      <form  role="form" method="POST" action="{{ url('/')}}" enctype="multipart/form-data">
        
      </form>
  </div>
</div>
@endsection 