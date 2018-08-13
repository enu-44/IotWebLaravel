@extends('layouts.master_page')
@section('content')

<section id="content">
    <div class="container">
        <div class="c-header">
            <h2>{{ Auth::user()->name }} {{ Auth::user()->last_name }} <small>Web/UI Developer, Edinburgh, Scotland</small></h2>
        </div>

        <div class="card" id="profile-main">
            <div class="pm-overview c-overflow">
                <div class="pmo-pic">
                    <div class="p-relative">
                        <a href="">
                           
                            @if(Auth::user()->path==='' || Auth::user()->path===NULL)
                             <img class="img-responsive" src="/img/icon_foto.png" alt="">
                            
                            @else
                            <img class="img-responsive" src="http://localhost:8000/{{ Auth::user()->path }}" alt="">
                            @endif
                        </a>

                        <div class="dropdown pmop-message">
                            <a data-toggle="dropdown" href="" class="btn palette-White bg btn-float z-depth-1">
                                <i class="zmdi zmdi-comment-text-alt"></i>
                            </a>

                            <div class="dropdown-menu">
                                <textarea placeholder="Write something..."></textarea>

                                <button class="btn bgm-green btn-float"><i class="zmdi zmdi-mail-send"></i></button>
                            </div>
                        </div>

                        <a data-toggle="modal" data-target="#exampleModal" class="pmop-edit">
                            <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">{{ __('Update Profile Picture') }}</span>
                        </a>
                    </div>


                    <div class="pmo-stat">
                        <h2 class="m-0 c-white"></h2>
                        IOT 
                    </div>
                </div>

                <div class="pmo-block pmo-contact hidden-xs">
                    <h2>Contact</h2>

                    <ul>
                        <li><i class="zmdi zmdi-phone"></i> {{ Auth::user()->phone }}</li>
                        <li><i class="zmdi zmdi-email"></i> {{ Auth::user()->email }}</li>
                        
                        <li>
                            <i class="zmdi zmdi-pin"></i>
                            <address class="m-b-0 ng-binding">
                                {{ Auth::user()->address }}
                            </address>
                        </li>
                    </ul>
                </div>

                
            </div>

            <div class="pm-body clearfix">
                <ul class="tab-nav tn-justified">
                    <li class="active waves-effect"><a href="profile-about.html">Perfil</a></li>
                    <!--<li class="waves-effect"><a href="profile-photos.html">Photos</a></li>
                    <li class="waves-effect"><a href="profile-connections.html">Connections</a></li>-->
                </ul>


                <div class="pmb-block">
                    <div class="pmbb-header">
                        <h2><i class="zmdi zmdi-account m-r-5"></i> Informacion Basica</h2>

                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a data-pmb-action="edit" href="">Editar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="pmbb-body p-l-30">
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Nombre Completo</dt>
                                <dd>{{ Auth::user()->name }}  {{ Auth::user()->last_name }} </dd>
                            </dl>
                            <!--<dl class="dl-horizontal">
                                <dt>Gender</dt>
                                <dd>Female</dd>
                            </dl>-->
                            <dl class="dl-horizontal">
                                <dt>Identificacion</dt>
                                <dd>{{ Auth::user()->identification }} </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Fecha Registro</dt>
                                <dd>{{ Auth::user()->created_at }} </dd>
                            </dl>
                           <!-- <dl class="dl-horizontal">
                                <dt>Martial Status</dt>
                                <dd>Single</dd>-->
                            </dl>
                        </div>

                        <div class="pmbb-edit">
                            <form  role="form" method="POST" action="{{ url('/update_info_basic')}}">
                            @csrf
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Nombre</dt>
                                <dd>
                                    <div class="fg-line"> 
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nombre">
                                    </div>

                                </dd>

                                
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Apellido</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" placeholder="Apellido">
                                    </div>

                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Identificcion</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" name="identification" class="form-control" value="{{ Auth::user()->identification }}" placeholder="Identificacion">
                                    </div>

                                </dd>
                            </dl>

                            <div class="m-t-30">
                                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                <button data-pmb-action="reset" class="btn btn-danger btn-sm">Cancelar</button>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                </div>


                <div class="pmb-block">
                    <div class="pmbb-header">
                        <h2><i class="zmdi zmdi-phone m-r-5"></i> Informacion de contacto</h2>

                        <ul class="actions">
                            <li class="dropdown">
                                <a href="" data-toggle="dropdown">
                                    <i class="zmdi zmdi-more-vert"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a data-pmb-action="edit" href="">Editar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="pmbb-body p-l-30">
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Direccion</dt>
                                <dd>{{ Auth::user()->address }}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Telefono</dt>
                                <dd>{{ Auth::user()->phone }}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Email</dt>
                                <dd>{{ Auth::user()->email }}</dd>
                            </dl>
                           
                        </div>

                        <div class="pmbb-edit">
                            <form  role="form" method="POST" action="{{ url('/update_info_contact')}}">
                            @csrf
                             <dl class="dl-horizontal">
                                <dt class="p-t-10">Direccion</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" placeholder="Direccion">
                                    </div>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Telefono</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" placeholder="Telefono">
                                    </div>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Email</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email" disabled="disabled">
                                    </div>
                                </dd>
                            </dl>
                           

                            <div class="m-t-30">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button data-pmb-action="reset" class="btn btn-danger btn-sm">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  role="form" method="POST" action="{{ url('/update_profile') }}" enctype="multipart/form-data">
                          @csrf
                     
                          
                          <div class="form-group">
                               <label >Seleccione una imagen de perfil</label>
                                <input id="" class="file " name="image"  type="file" multiple class="file" data-show-upload="false" data-show-caption="true" data-overwrite-initial="false" data-min-file-count="1">
                          </div>
                         
                          <div class="form-group ">
                                  <button type="submit" id="subir" class="btn btn-danger">
                                    Guardar
                                  </button>
                          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>

@endsection  