<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title> <?php echo isset($this->titulo) ? $this->titulo : ''; ?></title>
        <meta name="description" content="Sistema de inventario">
        <meta name="author" content="Frank Arellan oroya">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>public/app/css/bootstrap-endes.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/keyboard.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/keyboard-previewkeyset.css">
        <!--<link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/keyboard-basic.css">-->

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/smartadmin-production.min.css">
        <!--<link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/smartadmin-skins.min.css">-->

        <!-- SmartAdmin RTL Support  -->
        <!--<link rel="stylesheet" type="text/css" media="screen" href="<?= BASE_URL; ?>public/css/smartadmin-rtl.min.css">-->		

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?= BASE_URL; ?>public/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= BASE_URL; ?>public/img/favicon/favicon.ico" type="image/x-icon">
    </head>

    <!--

    TABLE OF CONTENTS.
   
    Use search to find needed section.
   
    ===================================================================
    
    |  01. #CSS Links                |  all CSS links and file paths  |
    |  02. #FAVICONS                 |  Favicon links and file paths  |
    |  03. #GOOGLE FONT              |  Google font link              |
    |  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
    |  05. #BODY                     |  body tag                      |
    |  06. #HEADER                   |  header tag                    |
    |  07. #PROJECTS                 |  project lists                 |
    |  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
    |  09. #MOBILE                   |  mobile view dropdown          |
    |  10. #SEARCH                   |  search field                  |
    |  11. #NAVIGATION               |  left panel & navigation       |
    |  12. #RIGHT PANEL              |  right panel userlist          |
    |  13. #MAIN PANEL               |  main panel                    |
    |  14. #MAIN CONTENT             |  content holder                |
    |  15. #PAGE FOOTER              |  page footer                   |
    |  16. #SHORTCUT AREA            |  dropdown shortcuts area       |
    |  17. #PLUGINS                  |  all scripts and plugins       |
    
    ===================================================================
    
    -->

    <!-- #BODY -->
    <!-- Possible Classes

            * 'smart-style-{SKIN#}'
            * 'smart-rtl'         - Switch theme mode to RTL
            * 'menu-on-top'       - Switch to top navigation (no DOM change required)
            * 'no-menu'			  - Hides the menu completely
            * 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
            * 'fixed-header'      - Fixes the header
            * 'fixed-navigation'  - Fixes the main menu
            * 'fixed-ribbon'      - Fixes breadcrumb
            * 'fixed-page-footer' - Fixes footer
            * 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
    -->
    <body class="">
        <input type="hidden" id="hdnID" name="hdnID" value="<?= $_SESSION["rol"] ?>">
        <!-- HEADER -->
        <header id="header" >
            <div id="logo-group"><span id="logo"><img src="<?= BASE_URL; ?>public/img/logo.png" alt="SmartAdmin"></span></div>

            <!-- pulled right: nav area -->
            <div class="pull-right">
                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->				
                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="<?= BASE_URL; ?>index.php/auth/auth/cerrar" title="Cerrar Sesi&oacute;n" data-action="userLogout" data-logout-msg="Puedes asegurarte m&aacute;s si cierras el navegador despu&eacute;s de cerrar sesi&oacute;n."><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->
                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->				
            </div>
            <!-- end pulled right: nav area -->
        </header>
        <!-- END HEADER -->

        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">
            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?= BASE_URL; ?>public/img/avatars/male.png" alt="me" class="online" /> 
                        <span><?= $_SESSION["usuario"] ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                </span>
            </div>
            <!-- end user info -->

            <!-- NAVIGATION : This navigation is also responsive-->
            <nav>
                <!-- 
                NOTE: Notice the gaps after each icon usage <i></i>..
                Please note that these links work a bit different than
                traditional href="" links. See documentation for details.
                -->				
                <ul>
                    <!--</ul></li>-->
                    <?php $i = 1; ?>
                    <?php foreach ($_SESSION["MENU"] as $value) : ?>
                        <?php $array = (array) $value; ?>

                        <?php if ($array["ID_PADRE"] == 0) : ?>
                            <?php if ($i != 1) : ?>
                            </ul>
            <!--</li>-->
                        <?php endif; ?>
                        <?php // if ($array["NOMBRE"] == 'Imprenta' || $array["NOMBRE"] == 'Limpiar BD'): //LUEGO BORRAR?>
                        <?php if ($array["NOMBRE"] == 'Procesamiento' || $array["NOMBRE"] == 'Base de Datos'): //LUEGO BORRAR?>
                            <li class="active">
                                <a href="#" title="<?= $array["NOMBRE"] ?>"><i class="fa fa-lg fa-fw <?= $array["IMAGEN"] ?>"></i><span class="menu-item-parent"><?= $array["NOMBRE"] ?></span></a>
                                <ul>
                                <?php endif; //LUEGO BORRAR ?>
                            <?php else : ?>
                                <?php if (in_array($array["ID"], array(2, 3, 4,5,6, 18))): //LUEGO BORRAR?>
                                    <li class="">
                                        <?php if (strpos($array["NOMBRE"], 'BD', 1) > 0) : ?>
                                            <a href="<?= $array["URL"] ?>" title="<?=$array["NOMBRE"] ?>">
                                            <?php else : ?>
                                                <a href="<?= BASE_URL . $array["URL"] ?>" title="<?= $array["NOMBRE"] ?>">
                                                <?php endif; ?>    
                                                <span class="menu-item-parent"><?= $array["NOMBRE"] ?></span></a>
                                    </li>
                                <?php endif; //LUEGO BORRAR?>
                            <?php endif; ?>
                            <?php $i = $i + 1; ?>
                        <?php endforeach; ?>                                                             
                    </ul></li>
                </ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"><i class="fa fa-arrow-circle-left hit"></i></span>
        </aside>
        <!-- END NAVIGATION -->
        <!-- MAIN PANEL -->
        <div id="main" role="main" style="background-color:white;">