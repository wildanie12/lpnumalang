
<!--
=========================================================
Paper Kit 2 - v2.2.0
=========================================================

Product Page: https://www.creative-tim.com/product/paper-kit-2
Copyright 2019 Creative Tim (https://www.creative-tim.com)
Licensed under MIT (https://github.com/creativetimofficial/paper-kit-2/blob/master/LICENSE.md)

Coded by Creative Tim
Website Developed by Badar Wildanie (082228111059)

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=site_url('LPNU LOGO XS.png')?>">
    <link rel="icon" type="image/png" href="<?=site_url('LPNU LOGO XS.png')?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        <?=((isset($ui_title)) ? $ui_title : 'Tidak ada judul')?>
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="<?=site_url('lib/fontawesome-free-5.14.0-web/css/all.min.css')?>" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?=site_url('lib/paper-kit-2')?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=site_url('lib/paper-kit-2')?>/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?=site_url('css/custom.css')?>" rel="stylesheet" />
    <?php 
        if (isset($ui_css)) {
            if (is_array($ui_css)) {
                foreach ($ui_css as $css) {
    ?>
    <link rel="stylesheet" type="text/css" href="<?=site_url($css)?>">
    <?php 
                }
            }
        }
    ?>
</head>

<body class="index-page sidebar-collapse front-end">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light " color-on-scroll="300">
        <div class="container-fluid">
            <div class="navbar-translate pl-md-4 pl-2 ">
                <a class="navbar-brand p-0" href="<?=base_url()?>" rel="tooltip" title="Beranda LPNU Malang" data-placement="bottom">
                    <img src="<?=site_url('Lpnu Logo Landscape Malang XS.png')?>" class="front-end-logo">
                </a>
                <button class="navbar-toggler navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end pr-md-4 pr-2 " id="navigation">
                <ul class="navbar-nav">
                    <?php 
                        if (empty($ui_navbar)) {
                            $ui_navbar = [
                                "Menu #1|fas fa-home|#",
                                "Menu #2|fas fa-list|#",
                                "Dropdown #3" => [
                                    "Sub #1|fab fa-facebook|https://www.facebook.com/",
                                    "Sub #2|fab fa-twitter|https://www.twitter.com/",
                                    "Sub #3|fab fa-instagram|https://www.instagram.com/"
                                ],
                                "Menu #4|fas fa-chart-line|#",
                            ];
                        }
                        else {
                            if (!is_array($ui_navbar)) {
                                $ui_navbar = [
                                    "Menu #1|fas fa-home|#",
                                    "Menu #2|fas fa-list|#",
                                    "Dropdown #3" => [
                                        "Sub #1|fab fa-facebook|https://www.facebook.com/",
                                        "Sub #2|fab fa-twitter|https://www.twitter.com/",
                                        "Sub #3|fab fa-instagram|https://www.instagram.com/"
                                    ],
                                    "Menu #4|fas fa-chart-line|#",
                                ];
                            }
                        }

                        foreach ($ui_navbar as $navbar => $child) {
                            if (is_numeric($navbar)) {
                                $navbar = explode('|', $child);
                                $navbar_text = $navbar[0];
                                $navbar_icon = $navbar[1];
                                $navbar_link = $navbar[2];
                    ?>
                    <li class="nav-item">
                        <a href="<?=$navbar_link?>" class="nav-link"><i class="<?=$navbar_icon?>"></i> <?=$navbar_text?></a>
                    </li>
                    <?php 
                            }
                            else {
                                $navbar_toggle_text = $navbar;
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle='dropdown'><i class="nc-icon nc-book-bookmark"></i> <?=$navbar_toggle_text?></a>
                        <ul class="dropdown-menu">
                            <?php
                                foreach ($child as $navbar) {
                                    $navbar = explode('|', $navbar);
                                    $navbar_text = $navbar[0];
                                    $navbar_icon = $navbar[1];
                                    $navbar_link = $navbar[2];
                            ?>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="<?=$navbar_link?>">
                                    <i class="<?=$navbar_icon?>"></i>
                                    <?=$navbar_text?>
                                </a>
                            </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </li>
                    <?php 
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="main">
        <?php $this->renderSection('content')?>
    </div>
    <footer class="bg-dark mt-4">
        <div class="container-fluid container-wildanie py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-6 d-flex flex-row align-items-center">
                    <img src="<?=site_url('LPNU LOGO XS.png')?>" style="height: 120px">
                    <div class="text-white ml-3">
                        <h5 class="mb-0" style="line-height: 20px; font-weight: 400">Lembaga <br/>Perekonomian <br/>Nahdlatul Ulama'</h5>
                        <span class="font-weight-bold">Malang</span><br/>
                        <div class="pt-1">&copy; 2021 LPNU Malang</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav class="navbar navbar-default navbar-expand-sm bg-transparent navbar-light justify-content-end" style="box-shadow: 0 0 0 !important">
                        <ul class="navbar-nav">
                            <?php 
                                if (empty($ui_navbar)) {
                                    $ui_navbar = [
                                        "Menu #1|fas fa-home|#",
                                        "Menu #2|fas fa-list|#",
                                        "Dropdown #3" => [
                                            "Sub #1|fab fa-facebook|https://www.facebook.com/",
                                            "Sub #2|fab fa-twitter|https://www.twitter.com/",
                                            "Sub #3|fab fa-instagram|https://www.instagram.com/"
                                        ],
                                        "Menu #4|fas fa-chart-line|#",
                                    ];
                                }
                                else {
                                    if (!is_array($ui_navbar)) {
                                        $ui_navbar = [
                                            "Menu #1|fas fa-home|#",
                                            "Menu #2|fas fa-list|#",
                                            "Dropdown #3" => [
                                                "Sub #1|fab fa-facebook|https://www.facebook.com/",
                                                "Sub #2|fab fa-twitter|https://www.twitter.com/",
                                                "Sub #3|fab fa-instagram|https://www.instagram.com/"
                                            ],
                                            "Menu #4|fas fa-chart-line|#",
                                        ];
                                    }
                                }

                                foreach ($ui_navbar as $navbar => $child) {
                                    if (is_numeric($navbar)) {
                                        $navbar = explode('|', $child);
                                        $navbar_text = $navbar[0];
                                        $navbar_icon = $navbar[1];
                                        $navbar_link = $navbar[2];
                            ?>
                            <li class="nav-item">
                                <a href="<?=$navbar_link?>" class="nav-link"><i class="<?=$navbar_icon?>"></i> <?=$navbar_text?></a>
                            </li>
                            <?php 
                                    }
                                    else {
                                        $navbar_toggle_text = $navbar;
                            ?>
                            <li class="nav-item dropup">
                                <a href="#" class="nav-link" data-toggle='dropdown'><i class="nc-icon nc-book-bookmark"></i> <?=$navbar_toggle_text?></a>
                                <ul class="dropdown-menu">
                                    <?php
                                        foreach ($child as $navbar) {
                                            $navbar = explode('|', $navbar);
                                            $navbar_text = $navbar[0];
                                            $navbar_icon = $navbar[1];
                                            $navbar_link = $navbar[2];
                                    ?>
                                    <li class="dropdown-item">
                                        <a class="dropdown-link" href="<?=$navbar_link?>">
                                            <i class="<?=$navbar_icon?>" style="top: 3px"></i>
                                            <?=$navbar_text?>
                                        </a>
                                    </li>
                                    <?php 
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php 
                                    }
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
    <?php $this->renderSection('modalContent')?>
    <!--   Core JS Files   -->
    <script src="<?=site_url('lib/paper-kit-2')?>/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?=site_url('lib/paper-kit-2')?>/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?=site_url('lib/paper-kit-2')?>/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?=site_url('lib/paper-kit-2')?>/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?=site_url('lib/paper-kit-2')?>/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="<?=site_url('lib/paper-kit-2')?>/js/plugins/moment.min.js"></script>
    <script src="<?=site_url('lib/paper-kit-2')?>/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="<?=site_url('lib/paper-kit-2')?>/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
    <script src="<?=site_url('js/default.js')?>" type="text/javascript"></script>
    <script src="<?=site_url('js/dynamic-img.js')?>" type="text/javascript"></script>
    <?php 
        if (isset($ui_js)) {
            if (is_array($ui_js)) {
                foreach ($ui_js as $js) {
    ?>
    <script src="<?=site_url($js)?>"></script>
    <?php 
                }
            }
        }
    ?>

    <?php $this->renderSection('jsContent')?>
</body>

</html>
