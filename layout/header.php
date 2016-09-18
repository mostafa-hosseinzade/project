<?php
require_once 'Admin/Controller/DefaultController.php';
require_once 'Admin/lib/DB.php';
require_once 'Admin/lib/DBTable.php';
require_once 'Admin/Controller/LoginController.php';
$defaultController = new DefaultController();
$loginController = new LoginController();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Site made with Mobirise Website Builder v2.4.1, http://mobirise.com -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="Mobirise v2.4.1, mobirise.com">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/animate.css/animate.min.css">
        <link rel="stylesheet" href="assets/socicon/css/socicon.min.css">
        <link rel="stylesheet" href="assets/mobirise/css/style.css">
        <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">


    </head>
    <body>
        <section class="engine"><a rel="nofollow" href="http://mobirise.com">Mobirise offline website builder</a></section>
        <section class="mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--transparent mbr-navbar--sticky mbr-navbar--auto-collapse" id="menu-0">
            <div class="mbr-navbar__section mbr-section">
                <div class="mbr-section__container container">
                    <div class="mbr-navbar__container">
                        <div class="mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand">
                            <span class="mbr-navbar__brand-link mbr-brand mbr-brand--inline">
                                <a class="mbr-brand__logo" href="http://mobirise.com"><img class="mbr-navbar__brand-img mbr-brand__img" alt="" src="assets/images/logo.png"></a>
                                <span class="mbr-brand__name"><a class="mbr-brand__name text-white" href="http://mobirise.com">MOBIRISE</a></span>
                            </span>
                        </div>
                        <div class="mbr-navbar__hamburger mbr-hamburger text-white"><span class="mbr-hamburger__line"></span></div>
                        <div class="mbr-navbar__column mbr-navbar__menu">
                            <nav class="mbr-navbar__menu-box mbr-navbar__menu-box--inline-right">
                                <div class="mbr-navbar__column">
                                    <ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active mbr-buttons--only-links">
                                        <?php if (!$loginController->isLogin('user') && !$loginController->isLogin('admin')){ ?>
                                            <li class="mbr-navbar__item">
                                                <a class="mbr-buttons__link btn text-white" href="/project/login/register.php">ثبت نام</a>
                                            </li>
                                            <li class="mbr-navbar__item">
                                                <a class="mbr-buttons__link btn text-white" href="/project/login/login.php">ورود</a>
                                            </li>
                                        <?php }else{ ?>
                                            <li class="mbr-navbar__item">
                                                <a class="mbr-buttons__link btn text-white" href="/project/login/login.php">پروفایل</a>
                                            </li>
                                        <?php } ?>    
                                        <li class="mbr-navbar__item">
                                            <a class="mbr-buttons__link btn text-white" href="/project/showall.php">مقالات</a>
                                        </li>
                                        <li class="mbr-navbar__item">
                                            <a class="mbr-buttons__link btn text-white" href="/project/posts.php">بحث و گفتگو</a>
                                        </li>
                                        <li class="mbr-navbar__item active">
                                            <a class="mbr-buttons__link btn text-white" href="/project">صفحه اصلی</a>
                                        </li>
                                    </ul>
                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>