<?php
Utils::isIdentity();
$identity = Utils::getIdentity();
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title> Gestión de Horas </title>
        <link rel="icon" type="image/x-icon" href="<?= base_url ?>assets/img/favicon.ico"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="<?= base_url ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/plugins.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url ?>assets/css/forms/theme-checkbox-radio.css">
        <link href="<?= base_url ?>assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="<?= base_url ?>plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url ?>assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" type="text/css" href="<?= base_url ?>plugins/dropify/dropify.min.css">
        <link href="<?= base_url ?>assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
        <!--  END CUSTOM STYLE FILE  -->

        <link rel="stylesheet" type="text/css" href="<?= base_url ?>plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url ?>plugins/table/datatable/custom_dt_html5.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url ?>plugins/table/datatable/dt-global_style.css">
        <link href="<?= base_url ?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>plugins/animate/animate.css" rel="stylesheet" type="text/css" />
        <script src="<?= base_url ?>plugins/sweetalerts/promise-polyfill.js"></script>
        <link href="<?= base_url ?>plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
        <!-- upload !-->
        <link href="<?= base_url ?>plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url ?>plugins/autocomplete/autocomplete.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link href="<?= base_url ?>assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url ?>assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
        <!--  END CUSTOM STYLE FILE  -->
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link href="<?= base_url ?>assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
        <!--  END CUSTOM STYLE FILE  -->
        <link rel="stylesheet" type="text/css" href="<?= base_url ?>plugins/jquery-step/jquery.steps.css">
        <style>
            #formValidate .wizard > .content {
                min-height: 25em;
            }
            #example-vertical.wizard > .content {
                min-height: 24.5em;
            }
        </style>
    </head>
    <body class="sidebar-noneoverflow">

        <!--  BEGIN NAVBAR  -->
        <div class="header-container">
            <header class="header navbar navbar-expand-sm">

                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

                <div class="nav-logo align-self-center">
                    <a class="navbar-brand" href="<?= base_url ?>dashboard/index"><img alt="logo" src="<?= base_url ?>assets/img/logo.svg" style="display:none;"> <span class="navbar-brand-name">Gestión de Horas</span></a>
                </div>

                <ul class="navbar-item flex-row mr-auto">
                    <li class="nav-item align-self-center search-animated">
                        <form class="form-inline search-full form-inline search" role="search" style="display:none;">
                            <div class="search-bar">
                                <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Buscar...">
                            </div>
                        </form>
                        <svg style="display:none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </li>
                </ul>

                <ul class="navbar-item flex-row nav-dropdowns">
                    <li class="nav-item dropdown language-dropdown more-dropdown">
                        <div class="dropdown custom-dropdown-icon">
                            <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url ?>assets/img/ar.png" class="flag-width" alt="flag"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>

                            <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="customDropdown">
                                <a class="dropdown-item" data-img-value="de" data-value="de" href="javascript:void(0);"><img src="<?= base_url ?>assets/img/ar.png" class="flag-width" alt="flag"> Español</a>

                            </div>
                        </div>
                    </li>



                    <li class="nav-item dropdown notification-dropdown" style="display: none;">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                        </a>
                        <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="notificationDropdown">
                            <div class="notification-scroll">

                                <div class="dropdown-item">
                                    <div class="media server-log">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Server Rebooted</h6>
                                                <p class="">45 min ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Licence Expiring Soon</h6>
                                                <p class="">8 hrs ago</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-item">
                                    <div class="media file-upload">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        <div class="media-body">
                                            <div class="data-info">
                                                <h6 class="">Kelly Portfolio.pdf</h6>
                                                <p class="">670 kb</p>
                                            </div>

                                            <div class="icon-status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media">
                                <img src="<?= base_url ?>assets/img/p9.jpeg" class="img-fluid" alt="admin-profile">
                                <div class="media-body align-self-center">
                                    <h6><span>Hola,</span> <?= $identity['nombre'] ?></h6>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </a>
                        <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
                            <div class="">
                                <div class="dropdown-item">
                                    <a class="" href="<?= base_url ?>login/cambiar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Cambiar password</a>
                                </div>
                                <div class="dropdown-item">
                                    <a class="" href="<?= base_url ?>login/salir"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Cerrar Sesión</a>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </header>
        </div>
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN TOPBAR  -->
            <div class="topbar-nav header navbar" role="banner">
                <nav id="topbar">
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-logo">
                            <a href="<?= base_url ?>dashboard/index">
                                <img src="<?= base_url ?>assets/img/logo.svg" class="navbar-logo" alt="logo">
                            </a>
                        </li>
                        <li class="nav-item theme-text">
                            <a href="<?= base_url ?>dashboard/index" class="nav-link"> FX Sistemas </a>
                        </li>
                    </ul>

                    <ul class="list-unstyled menu-categories" id="topAccordion">
                        <li class="menu single-menu">
                            <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span>Personal</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </a>
                            <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#topAccordion">
                                <li>
                                    <a href="<?= base_url ?>horas/mis"> Mis Horas </a>
                                </li>
                                <li>
                                    <a href="<?= base_url ?>liquidacion/mis"> Mis liquidaciones </a>
                                </li>
                            </ul>
                        </li>
                        <?php if (Utils::isAdmin()) { ?>
                            <li class="menu single-menu">
                                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                        <span>Horas y Equipos</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </a>
                                <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#topAccordion">
                                    <li>
                                        <a href="<?= base_url ?>personas/index"> Personas </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url ?>trabajo/index"> Equipos de trabajo </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url ?>empresas/index"> Empresas </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url ?>proyectos/index"> Proyectos </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu single-menu">
                                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                        <span>Liquidaciones</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </a>
                                <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#topAccordion">
                                    <li>
                                        <a href="<?= base_url ?>liquidacion/invoice"> Liquidaciones </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url ?>liquidacion/nuevo"> Liquidación Pagos </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu single-menu">
                                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                                        <span>Usuarios</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </a>
                                <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                                    <li>
                                        <a href="<?= base_url ?>usuarios/index"> Usuarios </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url ?>historia/index"> Auditoría </a>
                                    </li>
                                </ul>

                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
            <!--  END TOPBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
