<aside id="s-user-alerts" class="sidebar">
                <ul class="tab-nav tn-justified tn-icon m-t-10" data-tab-color="teal">
                   
                    
                    <li><a class="sua-notifications" href="#sua-notifications" data-toggle="tab"><i class="zmdi zmdi-notifications"></i></a></li>
                    
                </ul>

                <div class="tab-content">
                    
                    <div class="tab-pane fade" id="sua-notifications">
                        <ul class="sua-menu list-inline list-unstyled palette-Orange bg">
                            <li><a href=""><i class="zmdi zmdi-volume-off"></i> Mute</a></li>
                            <li><a href=""><i class="zmdi zmdi-long-arrow-tab"></i> View all</a></li>
                            <li><a href="" data-ma-action="sidebar-close"><i class="zmdi zmdi-close"></i> Close</a></li>
                        </ul>

                        <div class="list-group lg-alt c-overflow">
                            <a href="" class="list-group-item media">
                                <div class="pull-left">
                                    <img class="avatar-img" src="/img/profile-pics/1.jpg" alt="">
                                </div>

                                <div class="media-body">
                                    <div class="lgi-heading">David Villa Jacobs</div>
                                    <small class="lgi-text">Sorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mattis lobortis sapien non posuere</small>
                                </div>
                            </a>

                            <a href="" class="list-group-item media">
                                <div class="pull-left">
                                    <img class="avatar-img" src="/img/profile-pics/5.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lgi-heading">Candice Barnes</div>
                                    <small class="lgi-text">Quisque non tortor ultricies, posuere elit id, lacinia purus curabitur.</small>
                                </div>
                            </a>

                            <a href="" class="list-group-item media">
                                <div class="pull-left">
                                    <img class="avatar-img" src="/img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lgi-heading">Jeannette Lawson</div>
                                    <small class="lgi-text">Donec congue tempus ligula, varius hendrerit mi hendrerit sit amet. Duis ac quam sit amet leo feugiat iaculis</small>
                                </div>
                            </a>

                            <a href="" class="list-group-item media">
                                <div class="pull-left">
                                    <img class="avatar-img" src="/img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lgi-heading">Darla Mckinney</div>
                                    <small class="lgi-text">Duis tincidunt augue nec sem dignissim scelerisque. Vestibulum rhoncus sapien sed nulla aliquam lacinia</small>
                                </div>
                            </a>

                            <a href="" class="list-group-item media">
                                <div class="pull-left">
                                    <img class="avatar-img" src="/img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="lgi-heading">Rudolph Perez</div>
                                    <small class="lgi-text">Phasellus a ullamcorper lectus, sit amet viverra quam. In luctus tortor vel nulla pharetra bibendum</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </aside>

            <aside id="s-main-menu" class="sidebar">
                <div class="smm-header">
                    <i class="zmdi zmdi-long-arrow-left" data-ma-action="sidebar-close"></i>
                </div>

                <ul class="smm-alerts">
                   
                    <li data-user-alert="sua-notifications" data-ma-action="sidebar-open" data-ma-target="user-alerts">
                        <i class="zmdi zmdi-notifications"></i>
                    </li>
                  
                </ul>

                <ul class="main-menu">
                    <li class="active home">
                        <a href="/"><i class="zmdi zmdi-home"></i> Home</a>
                    </li>
                    <li class="sub-menu li_administrador">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-widgets"></i> Administrador</a>
                        <ul>
                            <li class="li_tipoproyectos"><a href="{{ url('tipoproyectos') }}">Tipo de Proyectos</a></li>
                            <li class="li_tipodispositivos"><a href="{{ url('tipodispositivos') }}">Tipo de Dispositivos</a></li>
                          
                            <li class="li_tipovariables"><a href="{{ url('tipovariables') }}">Tipo de Variables</a></li>

                            <!--<li class="sub-menu">
                                <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-accounts"></i> Usuarios</a>
                                <ul>
                                    <li><a href="#">Lista de usuarios</a></li>
                                </ul>
                            </li>-->
                        </ul>
                    </li>
                    <li class="sub-menu li_menu">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-grid"></i> Menu</a>

                        <ul>
                            <li class="li_proyectos"><a href="{{ url('proyectos') }}"> Proyectos</a></li>
                        
                            <li class="li_unidadproductiva"><a href="{{ url('unidades_productivas') }}">Unidades Productivas</a></li>

                            <li><a href="colored-header.html">Registrar Dispositivos</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="zmdi zmdi-star-circle"></i> Plan Carrera</a></li>
                    <li><a href="#"><i class="zmdi zmdi-balance-wallet"></i> Mis Billeteras</a></li>
                     <li><a href="#"><i class="zmdi zmdi-help"></i> Ayuda</a></li>
                    
                    
                </ul>
            </aside>