        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Principal</span>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false"><i class="mdi mdi-help"></i><span class="hide-menu">Suporte</span></a></li>
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Gerenciar</span>
                        </li>      
                        @foreach($pages_list as $value)
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-contents-list', $value->modules_id)!!}" aria-expanded="false">
                                <i class="mdi mdi-lead-pencil"></i>
                                <span class="hide-menu">{!!$value->module!!}</span>
                            </a>
                        </li>
                        @endforeach
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-categories')!!}" aria-expanded="false"><i class="mdi mdi-sitemap"></i><span class="hide-menu">Categorias</span></a>
                        </li>
                        </a></li>                      
                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-notification-clear-all"></i>
                                <span class="hide-menu">P??ginas</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                @foreach($pages_unic as $value)
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-contents-unic', $value->modules_id)!!}" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i>
                                        <span class="hide-menu"> {!!$value->module!!}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-users')!!}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">Usu??rios</span>
                            </a>
                        </li> 
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Plugins</span>
                        </li> 
                        
                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                                <i class="mdi mdi-star"></i>
                                <span class="hide-menu">An??ncios</span>
                            </a>
                            <ul aria-expaned="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-adverts')!!}" class="sidebar-link">
                                         <i class="icon-flag"></i>                                        
                                        <span class="hide-menu"> Banners</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-advertisers')!!}" class="sidebar-link">
                                         <i class="fas fa-users"></i>                                        
                                        <span class="hide-menu"> Anunciantes</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-adverts-locations')!!}" class="sidebar-link">
                                         <i class="fas fa-th"></i>                                        
                                        <span class="hide-menu"> M??dulos</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-adverts-reports')!!}" class="sidebar-link">
                                         <i class="ti-bar-chart"></i>                                        
                                        <span class="hide-menu"> Relat??rios</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-polls')!!}" aria-expanded="false">
                                <i class="mdi mdi-radiobox-marked"></i>
                                <span class="hide-menu">Enquete</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-newsletters')!!}" aria-expanded="false">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">Newletters</span>
                            </a>
                        </li>
{{--                         <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false">
                                <i class="mdi mdi-comment-multiple-outline"></i>
                                <span class="hide-menu">Coment??rios</span>
                            </a>
                        </li>  --}}
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Configura????es</span>
                        </li> 
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{!!route('cms-settings-site')!!}" aria-expanded="false">
                                <i class="mdi mdi-widgets"></i><span class="hide-menu">Site</span>
                            </a>
                        </li>
{{--                         <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/" aria-expanded="false">
                                <i class="mdi mdi-tag"></i><span class="hide-menu">SEO</span>
                            </a>
                        </li>   --}}
{{--                         <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-image-filter-drama"></i><span class="hide-menu">Banco de dados</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-db-backup')!!}" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i><span class="hide-menu"> Backup</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{!!route('cms-db-clean')!!}" class="sidebar-link">
                                        <i class="mdi mdi-octagram"></i><span class="hide-menu"> Limpeza</span>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="sidebar-item"> 
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-notification-clear-all"></i><span class="hide-menu">Administra????o</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="{!!route('cms-modules')!!}" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> P??ginas / M??dulos</span></a></li>
                                <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><i class="mdi mdi-octagram"></i><span class="hide-menu"> Defini????es</span></a></li>
                            </ul>
                        </li>                                                   
                    </ul>
                </nav>
            </div>
        </aside>