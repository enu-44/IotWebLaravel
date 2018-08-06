@extends('layouts.master_page')
@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="card">
    <div class="card-header">
        <h2><small>Vestibulum purus quam scelerisque, mollis nonummy metus</small></h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
        {{ __('You are logged in!') }}
        {{ Auth::user()->name }} {{ Auth::user()->last_name }}
        <ul class="actions">
            <li>
                <a href="">
                    <i class="zmdi zmdi-check-all"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="zmdi zmdi-trending-up"></i>
                </a>
            </li>
            <li class="dropdown">
                <a href="" data-toggle="dropdown">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="">Change Date Range</a>
                    </li>
                    <li>
                        <a href="">Change Graph Type</a>
                    </li>
                    <li>
                        <a href="">Other Settings</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="card-body" style="padding:30px;">
           
         <!-- <div style=" overflow-x: auto;white-space: nowrap;" >
          <table width="100%"  class="mdl-data-table" id="table">
              <table width="100%" id="table" class="table table-striped table-bordered nowrap" >
              <thead>
                <tr>
                  <th >#</th>
                  <th >Name (Symbol)</th>
                  <th >Market Cap</th>
                  <th >Price (USD)</th>
                   <th >24 Hour VWAP</th>
                  <th >24 Hour Volume</th>
                  <th>Available Supply</th>
                  <th>% 24 Hour</th>
                </tr>
              </thead>
              <tbody id="Crypto">
              </tbody>
            </table>-->

        <!--</div>-->
        
           
    </div>
</div>
@endsection

@section('footer')   



@endsection  
