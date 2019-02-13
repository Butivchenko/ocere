<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ocere official Site</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    
    <!-- Favicons
    ================================================== -->
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <!-- Bootstrap 
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
	
	<!-- Custom Css 
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <!-- Google Fonts 
    ================================================== -->

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,500,700,800,600' rel='stylesheet' type='text/css'>

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
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-36454303-1');
	</script>


	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TQ2HKGB');</script>
<!-- End Google Tag Manager -->

  </head>
  <body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQ2HKGB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<header>
		<div class="img">
			<a href=""><img src="images/ocere-logo.png" alt="" class="img-responsive"></a>
			<div class="right-text">
				<p>Speak to us right now: <a href="tel:">+44 (0) 1242 525557</a></p>
			</div>
		</div>
	</header>
	<!-- Wrapper -->
	<div id="wrapper" class="body">
		<section class="page-cover">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="">
							<div class="row">
								<div class="col-sm-12">
									<?php //echo "<pre>";
										//print_r($_POST);

										$table = "<p>Hi Admin,</p><p></p><p>Below are enquiry details</p><p></p><table>";
										foreach($_POST as $k=>$v) {
											$tr = "<tr><td>$k: </td><td>$v</td>";
											$table .= $tr;
										}
										$table .= "</table>";
										//echo $table;
										

										$to = "tomparling@gmail.com, ben@ocere.com, tom@ocere.com, remi@ocere.com, info@ocere.com";
										//$to = "er.savindersingh@gmail.com, hello.savinder@gmail.com, hi.savinder@gmail.com";
										$subject = "Step 2 Completed: Enquiry Submitted on Ocere Web Tool";

										// Always set content-type when sending HTML email
										$headers = "MIME-Version: 1.0" . "\r\n";
										$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

										// More headers
										//$headers .= 'From: <info@forms.ocere.com>' . "\r\n";

										mail($to,$subject,$table,$headers);

										
									?>
									<small><b>Thank You!</b></small>
								</div>
							</div>
						</h5>
					</div>
					<div class="col-sm-12">
						<p>
							Your order has been placed, our team member will get back to you soon for the next steps. <br>
							For any questions or query please email us at <a href="">info@ocere.com</a>
						</p>
					</div><br>
					<div class="col-sm-12"><a href="index.php" class="btn-trial">Back to Home</a></div>
				</div>
			</div>
		</section>
		
		
		<?php include('footer.php') ?>
			
