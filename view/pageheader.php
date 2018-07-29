<?php
$flag = 'ENT_SUBSTITUTE';
require_once APPROOT . '/model/userauth/SessMemHD.php';
require_once APPROOT . '/model/language/clsLangs.php';
require_once APPROOT . '/config/labels/model/clsLabel.php';

$objLang = new Languages();
//$objLang->set_LcEnabled(1);
$objLang->execute();
$LangShort = $objLang->get_Shortname($objLang->get_IdByLanguage($SelLang));

$objLabel = New Labels;
$lblLogout = $objLabel->get_Label("lblLogout", $SelLang);
$lblLanguage = $objLabel->get_Label("lblLanguage", $SelLang);
$lblBodyChangePassword = $objLabel->get_Label("lblBodyChangePassword", $SelLang);
$lblClassifications = $objLabel->get_Label("lblClassifications", $SelLang);
$lblRegions = $objLabel->get_Label("lblRegions", $SelLang);
$lblLocations = $objLabel->get_Label("lblLocations", $SelLang);
$lblLocalities = $objLabel->get_Label("lblLocalities", $SelLang);
$lblNavigation = $objLabel->get_Label("lblNavigation", $SelLang);
$lblHi = $objLabel->get_Label("lblHi", $SelLang);
$lblMyProfile = $objLabel->get_Label("lblMyProfile", $SelLang);
$lblAccountSettings = $objLabel->get_Label("lblAccountSettings", $SelLang);
$lblAvailable = $objLabel->get_Label("lblAvailable", $SelLang);
?>
<!DOCTYPE html>
<html lang="<?= $objLang->get_Shortname($objLang->get_IdByLanguage($SelLang)); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="Test">

        <link rel="icon" type="image/png" href="/assets/images/icon.png">
        <title>Test</title>
        <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css">

        <link href="/<?=APPBASE?>assets/css/style.css" rel="stylesheet"> <!-- MANDATORY -->
        <link href="/<?=APPBASE?>assets/css/theme.css" rel="stylesheet"> <!-- MANDATORY -->
        <link href="/<?=APPBASE?>assets/css/ui.css" rel="stylesheet"> <!-- MANDATORY -->
        <link href="/<?=APPBASE?>assets/css/custom.css" rel="stylesheet">
        <link href="/<?=APPBASE?>assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <!-- BEGIN BODY -->
    <body class="<?=$UserTheme?>">
        <section>
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar">
                <div class="logopanel">
                    <h1><a href="">&nbsp;</a></h1>
                </div>
                <div class="sidebar-inner">
                    <!--<div class="sidebar-top small-img clearfix">
                        <div class="user-image">
                            <img src="assets/images/avatars/avatar.png" class="img-responsive img-circle">
                        </div>
                        <div class="user-details">
                            <h4><?= $First ?> <?=$Last ?></h4>
                            <div class="dropdown user-login">
                                <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                                    <i class="online"></i><?= $lblAvailable ?><i class="fas fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="busy"></i> Busy</a></li>
                                    <li><a href="#"><i class="turquoise"></i> Invisible</a></li>
                                    <li><a href="#"><i class="away"></i> Away</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                    <div class="menu-title">
                        <span><?=$lblNavigation?></span>
                        <div class="pull-right menu-settings">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
                                <i class="icon-settings"></i>
                            </a>

                        </div>
                    </div>
                    <ul class="nav nav-sidebar">
<?php
require_once APPROOT . '/view/page_nav-sidebar.php';
?>
                    </ul>
                    <div class="sidebar-footer clearfix">
                        <a class="pull-left footer-settings" href="/<?=APPBASE?>users/settings.php" data-rel="tooltip" data-placement="top" data-original-title="<?= $lblAccountSettings ?>">
                            <i class="icon-settings"></i>
                        </a>
                        <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
                            <i class="icon-size-fullscreen"></i></a>
                        <a class="pull-left btn-effect" href="/<?=APPBASE?>logout.php?SelLang=<?= $SelLang ?>&E=1" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="<?= $lblLogout ?>">
                            <i class="icon-power"></i></a>
                    </div>
                </div>
            </div>
            <!-- END SIDEBAR -->
            <div class="main-content">
                <!-- BEGIN TOPBAR -->
                <div class="topbar">
                    <div class="header-left">
                        <div class="topnav">
                            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
                            <ul class="nav nav-icons">
<?php
require_once APPROOT . '/view/page_nav-topbar.php';
?>
                            </ul>
                        </div>
                    </div>
                    <div class="header-right">
                        <ul class="header-menu nav navbar-nav">
<?php
// Pass Selected Language as $SelLang = ID;
// showValue(this.value);
// $SelLang = 3;
//require_once APPROOT . '/model/language/clsLangs.php';
if ($objLang->get_Count() > 0) {
?>
                            <!-- BEGIN USER DROPDOWN -->
                            <li class="dropdown" id="language-header">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-globe"></i>
                                    <span><?= $lblLanguage ?></span>
                                </a>
                                <ul class="dropdown-menu">
<?php
    $me = $_SERVER['PHP_SELF'];
    parse_str($_SERVER['QUERY_STRING'],$query);

    for ($l=0; $l<$objLang->get_Count(); $l++) {
        //$LId = $objLang->get_ID($l);
        $LImg = $objLang->get_Image($l);
        $LName = $objLang->get_Name($l);

        $params = array_replace($query, array('language' => $objLang->get_ID($l)));
        $req = $me . '?' . http_build_query($params);
?>
                                    <li>
                                        <a href="<?= $req ?>" data-lang="<?= $lblLANG ?>"><img src="<?= $LImg ?>" alt="flag-<?= $LName ?>"> <span><?= $LName ?></span></a>
                                    </li>
<?php
    }
?>
                                </ul>
                            </li>
                            <!-- END USER DROPDOWN -->
<?php
}
?>
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!--<li class="dropdown" id="notifications-header">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-danger badge-header">6</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header clearfix">
                                        <p class="pull-left">12 Pending Notifications</p>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list withScroll mCustomScrollbar _mCS_12" data-height="220" style="height: 220px;"><div class="mCustomScrollBox mCS-light" id="mCSB_12" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-star p-r-10 f-18 c-orange"></i>
                                                            Steve have rated your photo
                                                            <span class="dropdown-time">Just now</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-heart p-r-10 f-18 c-red"></i>
                                                            John added you to his favs
                                                            <span class="dropdown-time">15 mins</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-file-alt p-r-10 f-18"></i>
                                                            New document available
                                                            <span class="dropdown-time">22 mins</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="far fa-image p-r-10 f-18 c-blue"></i>
                                                            New picture added
                                                            <span class="dropdown-time">40 mins</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-bell p-r-10 f-18 c-orange"></i>
                                                            Meeting in 1 hour
                                                            <span class="dropdown-time">1 hour</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-bell p-r-10 f-18"></i>
                                                            Server 5 overloaded
                                                            <span class="dropdown-time">2 hours</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-comment p-r-10 f-18 c-gray"></i>
                                                            Bill comment your post
                                                            <span class="dropdown-time">3 hours</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="far fa-image p-r-10 f-18 c-blue"></i>
                                                            New picture added
                                                            <span class="dropdown-time">2 days</span>
                                                        </a>
                                                    </li>
                                                </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                                    </li>
                                    <li class="dropdown-footer clearfix">
                                        <a href="#" class="pull-left">See all notifications</a>
                                        <a href="#" class="pull-right">
                                            <i class="icon-settings"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <!-- END NOTIFICATION DROPDOWN -->
                            
                            <!-- BEGIN MESSAGES DROPDOWN -->
                            <!--<li class="dropdown" id="messages-header">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-paper-plane"></i>
                                    <span class="badge badge-primary badge-header">
                                        8
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header clearfix">
                                        <p class="pull-left">
                                            You have 8 Messages
                                        </p>
                                    </li>
                                    <li class="dropdown-body">
                                        <ul class="dropdown-menu-list withScroll mCustomScrollbar _mCS_13" data-height="220" style="height: 220px;"><div class="mCustomScrollBox mCS-light" id="mCSB_13" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                                                    <li class="clearfix">
                                                        <span class="pull-left p-r-5">
                                                            <img src="assets/images/avatars/avatar3.png" alt="avatar 3">
                                                        </span>
                                                        <div class="clearfix">
                                                            <div>
                                                                <strong>Alexa Johnson</strong> 
                                                                <small class="pull-right text-muted">
                                                                    <span class="glyphicon glyphicon-time p-r-5"></span>12 mins ago
                                                                </small>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                        </div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="pull-left p-r-5">
                                                            <img src="assets/images/avatars/avatar4.png" alt="avatar 4">
                                                        </span>
                                                        <div class="clearfix">
                                                            <div>
                                                                <strong>John Smith</strong> 
                                                                <small class="pull-right text-muted">
                                                                    <span class="glyphicon glyphicon-time p-r-5"></span>47 mins ago
                                                                </small>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                        </div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="pull-left p-r-5">
                                                            <img src="assets/images/avatars/avatar5.png" alt="avatar 5">
                                                        </span>
                                                        <div class="clearfix">
                                                            <div>
                                                                <strong>Bobby Brown</strong>  
                                                                <small class="pull-right text-muted">
                                                                    <span class="glyphicon glyphicon-time p-r-5"></span>1 hour ago
                                                                </small>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                        </div>
                                                    </li>
                                                    <li class="clearfix">
                                                        <span class="pull-left p-r-5">
                                                            <img src="assets/images/avatars/avatar6.png" alt="avatar 6">
                                                        </span>
                                                        <div class="clearfix">
                                                            <div>
                                                                <strong>James Miller</strong> 
                                                                <small class="pull-right text-muted">
                                                                    <span class="glyphicon glyphicon-time p-r-5"></span>2 days ago
                                                                </small>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                                        </div>
                                                    </li>
                                                </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><div class="mCSB_draggerContainer"><div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></ul>
                                    </li>
                                    <li class="dropdown-footer clearfix">
                                        <a href="mailbox.html" class="pull-left">See all messages</a>
                                        <a href="#" class="pull-right">
                                            <i class="icon-settings"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
                            <!-- END MESSAGES DROPDOWN -->
                            <!-- BEGIN USER DROPDOWN -->
                            <li class="dropdown" id="user-header">
                                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img data-name="<?= substr($First, 0, 1). substr($Last, 0, 1)?>" data-char-count='2' data-font-size='45' data-seed='2' class="profile" alt="user image"/>
                                    <span class="username"><?= $lblHi ?>, <?= htmlentities($First, (int) $flag, "Windows-1252", true) ?> <?=  htmlentities($Last, (int) $flag, "Windows-1252", true) ?></span>
                                    <input type="hidden" id="U_Pid" value="<?= PARTNER ?>">
                                </a>
                                <ul class="dropdown-menu">
                                    <!--<li>
                                        <a href="#"><i class="icon-user"></i><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-calendar"></i><span>My Calendar</span></a>
                                    </li>-->
                                    <li>
                                        <a href="/<?=APPBASE?>users/settings.php"><i class="icon-user"></i><span><?= $lblAccountSettings ?></span></a>
                                    </li>
                                    <li>
                                        <a href="/<?=APPBASE?>logout.php?SelLang=<?= $SelLang ?>&E=1"><i class="icon-logout"></i><span><?= $lblLogout ?></span></a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER DROPDOWN -->
                            <!-- CHAT BAR ICON -->
                            <!--<li id="quickview-toggle"><a href="#"><i class="fas fa-plus fa-1"></i></a></li>-->
                        </ul>
                    </div>
                    <!-- header-right -->
                </div>
                <div class='mainContSpinner' style="display:none;"><div class='row'><div class='col-md-12'><div class='contSpinner'><h1><i class='fas fa-sync fa-pulse fa-1'></i></h1></div></div></div></div>

                <!-- END TOPBAR -->
