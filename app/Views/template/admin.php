<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
* Web Developer / Programmer : M. Badar Wildanie
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?=((isset($ui_title)) ? $ui_title : '[Tidak ada Judul]')?></title>
    <!-- Favicon -->
    <link rel="icon" href="<?=site_url('lib/argon-dashboard/img')?>/brand/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?=site_url('lib/fontawesome-free-5.14.0-web/css/all.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?=site_url('lib/argon-dashboard/css')?>/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?=site_url('css/custom.css')?>">
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

<body style="background: url('<?=site_url('images/background-logged.jpg')?>');">
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white pt-2" id="sidenav-main">
        <div class="scrollbar-inner">
            <div class="sidebar-button-in-sidenav d-inline-block d-lg-none pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </div>
            <!-- Brand -->
            <div class="sidenav-header align-items-center mb-2">
                <a class="navbar-brand p-0" href="javascript:void(0)">
                    <div class="d-flex justify-content-center">
                        <img src="<?=site_url('LPNU LOGO XS.png')?>" class="navbar-brand-img" alt="..." style="max-height: 70px;">
                        <div class="ml-2 text-left">
                            <h4 class="text-uppercase mb-0" style="font-size: 11pt; line-height: 15px; font-weight: bolder;">
                                Lembaga <br/>
                                Perekonomian <br/>
                                Nahdlatul Ulama
                            </h4> 
                            <span style="font-size: 10pt">Kab. Malang</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <?php 
                            if (empty($ui_sidebar)) {
                                // Jika Sidebar belum di tulis di kontroller 
                                $ui_sidebar = array(
                                    "Menu #1|fas fa-tachometer-alt|primary|#",
                                    "Menu #2|fas fa-newspaper|primary|#",
                                    "Menu #3|fas fa-store|primary|#",
                                    "Menu #4|fas fa-ruler-combined|primary|#",
                                    "Menu #5|fas fa-cog|primary|#",
                                );
                            }
                            else {
                                // Jika Sidebar sudah di tulis tapi bukan array 
                                if (!is_array($ui_sidebar)) {
                                    $ui_sidebar = array(
                                        "Menu #1|fas fa-tachometer-alt|primary|#",
                                        "Menu #2|fas fa-newspaper|primary|#",
                                        "Menu #3|fas fa-store|primary|#",
                                        "Menu #4|fas fa-ruler-combined|primary|#",
                                        "Menu #5|fas fa-cog|primary|#",
                                    );
                                }
                            }

                            foreach ($ui_sidebar as $sidebar) {
                                $sidebar = explode('|', $sidebar); 
                                $sidebar_text = $sidebar[0];
                                $sidebar_icon = $sidebar[1];
                                $sidebar_color = $sidebar[2];
                                $sidebar_link = $sidebar[3];

                                $active_class = "";
                                if (isset($ui_sidebar_active)) {
                                    if ($sidebar_text == $ui_sidebar_active) {
                                        $active_class = "active";
                                    }
                                    else {
                                        $active_class = "";
                                    }
                                }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?=$active_class?>" href="<?=site_url($sidebar_link)?>">
                                <i class="<?=$sidebar_icon?> text-<?=$sidebar_color?>"></i>
                                <span class="nav-link-text"><?=$sidebar_text?></span>
                            </a>
                        </li>
                        <?php 
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom p-1">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center mr-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <?php 
                            if (empty($ui_navbar)) {
                                $ui_navbar = array(
                                    "Menu #1|fas fa-clipboard-list|#",
                                    "Menu #2|fas fa-chart-line|#",
                                );
                            }
                            else {
                                if (!is_array($ui_navbar)) {
                                    $ui_navbar = array(
                                        "Menu #1|fas fa-clipboard-list|#",
                                        "Menu #2|fas fa-chart-line|#",
                                    );
                                }
                            }

                            foreach ($ui_navbar as $navbar) {
                                $navbar = explode('|', $navbar);
                                $navbar_text = $navbar[0];
                                $navbar_icon = $navbar[1];
                                $navbar_link = $navbar[2];

                                $navbar_active_class = '';
                                if (isset($ui_navbar_active)) {
                                    if ($ui_navbar_active == $navbar_text) {
                                        $navbar_active_class = 'active';
                                    }
                                    else {
                                        $navbar_active_class = '';
                                    }
                                }
                            
                        ?>
                        <li class="nav-item mr-2">
                            <a href="<?=site_url($navbar_link)?>" class="nav-link text-uppercase text-sm <?=((isset($navbar[3])) ? 'primary' : '')?> <?=$navbar_active_class?>" style="font-weight: bolder">
                                <i class="<?=$navbar_icon?>"></i>
                                <span class="ml-2 d-none d-md-inline-block"><?=$navbar_text?></span>
                            </a>
                        </li>
                        <?php 
                            }
                        ?>
                    </ul>

                    <?php 
                        if (isset($userdata)) {
                    ?>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="<?=site_url('images/profile/' . $userdata['avatar'])?>">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm font-weight-bold"><?=$userdata['nama_lengkap']?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat datang!</h6>
                                </div>
                                <a href="#" class="dropdown-item">
                                    <i class="mr-2 fas fa-user-circle" style="width: 15px"></i>
                                    <span>Lihat Profil</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="mr-2 fas fa-user-edit" style="width: 15px"></i>
                                    <span>Edit Profil</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="mr-2 fas fa-sign-out-alt" style="width: 15px"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </nav>

        <?php $this->renderSection('content')?>
    </div>
    <?php $this->renderSection('modalContent')?>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/jquery/dist/jquery.min.js"></script>
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/js-cookie/js.cookie.js"></script>
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/chart.js/dist/Chart.min.js"></script>
    <script src="<?=site_url('lib/argon-dashboard/vendor')?>/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="<?=site_url('lib/argon-dashboard/js')?>/argon.js?v=1.2.0"></script>
    <script src="<?=site_url('js')?>/default.js"></script>
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