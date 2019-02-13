<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">

    <!--[if IE]>
    <meta http-equiv="x-ua-compatible" content="IE=9"/><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogger Outreach Online Ordering - Ocere</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Favicons
    ================================================== -->
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16"/>
    <!-- Bootstrap
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


    <!-- Custom Css
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Google Fonts
    ================================================== -->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,500,700,800,600' rel='stylesheet'
          type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-36454303-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-36454303-1');
    </script>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TQ2HKGB');</script>
    <!-- End Google Tag Manager -->

    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/2544056.js"></script>
    <!-- End of HubSpot Embed Code -->


</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQ2HKGB"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header>
    <div class="upper-menu">

        <div class="row">
            <div class="col-md-5 col-sm-4">
                <ul class="top-links hidden-xs">
                    <li><a href="https://www.ocere.com/who-we-are/meet-the-team/">About Us</a></li>
                    <li><a href="https://lp.ocere.com/blogger-outreach/">How it works</a></li>
                </ul>
            </div>
            <div class="col-md-7 col-sm-8">
                <ul class="right-align mobile-call">
                    <li>Call now:</li>
                    <li><a href="tel:01242525557"><img src="images/england.png" alt="">01242 525557</a></li>
                    <li><a href="tel:8008102458"><img src="images/usa.png" alt="">800-810-2458</a></li>
                    <li><a href="mail:info@ocere.com"><img src="images/mail.png" alt="">info@ocere.com</a></li>
                </ul>
            </div>

        </div>

    </div>
    <div class="down-menu">
        <nav class="navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="images/ocere-logo-new.png" alt="" class="img-responsive"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidd-sm"><a href="https://www.ocere.com/who-we-are/meet-the-team/">About Us</a></li>
                        <li class="hidd-sm"><a href="https://lp.ocere.com/blogger-outreach/">How it works</a></li>
                        <?php
                        include_once('functions.php');
                        if (!is_logged_in()) { ?>
                            <li><a href="/login.php">Login</a></li>
                            <li><a href="/sign_up.php">Create Account</a></li>
                            <?php
                        }
                        elseif (is_logged_in() &&  $_SESSION['userRole']=='admin'){?>
                            <?php if ($_SERVER['REQUEST_URI'] !== '/order.php') : ?>
                                <li><a class="custom_order"  href="/order.php">New Order</a></li>
                            <?php endif; ?>
                            <li><a href="/admin.php">Admin Panel</a></li>
                            <li><a href="/dashboard.php">Dashboard</a></li>
                            <li><a href="/profile.php">Profile</a></li>
                            <li><a href="/logout.php">Logout</a></li>
                       <?php }
                        else {
                            ?>
                            <?php if ($_SERVER['REQUEST_URI'] !== '/order.php') : ?>
                                <li><a class="custom_order"  href="/order.php">New Order</a></li>
                            <?php endif; ?>
                            <li><a href="/dashboard.php">Dashboard</a></li>
                            <li><a href="/profile.php">Profile</a></li>
                            <li><a href="/logout.php">Logout</a></li>

                            <?php
                        }
                        ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</header>
