<?php 
$menuData=[];
$menujson = html_entity_decode(getOption('menu'));
if(!empty($menujson)){
	$menuData = json_decode($menujson,true);
}
// echo getBody()['module'];	
// echo '<pre>';
// print_r($menuData);
// echo '</pre>';
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta tag -->
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="Radix" content="Responsive Multipurpose Business Template">
		<meta name='copyright' content='Radix'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<!-- Title Tag -->
        <title><?php echo (!empty($data['pageTitle']))?$data['pageTitle']:false; ?></title>
		
		<?php 
		$faviconUrl = getOption('header_favicon');
		if(!empty($faviconUrl)):
		?>
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="<?php echo $faviconUrl; ?>">	
		<?php endif; ?>
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">
		
		<!-- Bootstrap Css -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/bootstrap.min.css?ver=<?php echo rand(); ?>">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/font-awesome.min.css?ver=<?php echo rand(); ?>">
		<!-- Slick Nav CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/slicknav.min.css?ver=<?php echo rand(); ?>">
		<!-- Cube Portfolio CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/cubeportfolio.min.css?ver=<?php echo rand(); ?>">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/magnific-popup.min.css?ver=<?php echo rand(); ?>">
		<!-- Fancy Box CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/jquery.fancybox.min.css?ver=<?php echo rand(); ?>">
		<!-- Nice Select CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/niceselect.css?ver=<?php echo rand(); ?>">
		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/owl.theme.default.css?ver=<?php echo rand(); ?>">
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/owl.carousel.min.css?ver=<?php echo rand(); ?>">
		<!-- Slick Slider CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/slickslider.min.css?ver=<?php echo rand(); ?>">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/animate.min.css?ver=<?php echo rand(); ?>">
		
		<!-- Radix StyleShet CSS -->
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/reset.css?ver=<?php echo rand(); ?>">	
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/style.css?ver=<?php echo rand(); ?>">
        <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/responsive.css?ver=<?php echo rand(); ?>">	

		<!-- Radix Color CSS -->
		<link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES;?>/css/color/color1.css?ver=<?php echo rand(); ?>">
		<link rel="stylesheet" href="#" id="colors">	
		<?php head(); ?>
    </head>
    <body>
	
		<!-- Preloader -->
		 <div class="preloader">
		  <div class="preloader-inner">
			<div class="single-loader one"></div>
			<div class="single-loader two"></div>
			<div class="single-loader three"></div>
			<div class="single-loader four"></div>
			<div class="single-loader five"></div>
			<div class="single-loader six"></div>
			<div class="single-loader seven"></div>
			<div class="single-loader eight"></div>
			<div class="single-loader nine"></div>
		  </div>
		</div>
		<!-- End Preloader -->
		
		
		<!-- Start Header -->
		<header id="header" class="header">
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-12">
							<!-- Contact -->
							<ul class="contact">
								<li><i class="fa fa-headphones"></i> <?php echo getOption('general_hotline');?></li>
								<li><i class="fa fa-envelope"></i> <a href="mailto:info@yourmail.com"><?php echo getOption('general_email');?></a></li>
								<li><i class="fa fa-clock-o"></i>Opening: <?php echo getOption('general_time');?></li>
							</ul>
							<!--/ End Contact -->
						</div>
						<div class="col-lg-6 col-12">
							<div class="topbar-right">
								<!-- Search Form -->
								<div class="search-form active">
									<a class="icon" href="#"><i class="fa fa-search"></i></a>
									<form class="form" method="get" action="<?php echo _WEB_HOST_ROOT.'/tim-kiem.html';?>">
										<input placeholder="<?php echo getOption('header_search'); ?>" type="search" value="<?php echo (!empty(getBody()['keyword']))?getBody()['keyword']:false; ?>" name="keyword">
										<!-- <input type="hidden" name="module" value="search"> -->
									</form>
								</div>
								<!--/ End Search Form -->
								<!-- Social -->
								<ul class="social">
									<li><a target="_blank" href="<?php echo getOption('general_twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
									<li><a target="_blank" href="<?php echo getOption('general_facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
									<li><a target="_blank" href="<?php echo getOption('general_linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
									<li><a target="_blank" href="<?php echo getOption('general_behance'); ?>"><i class="fa fa-behance"></i></a></li>
									<li><a target="_blank" href="<?php echo getOption('general_youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
								</ul>
								<!--/ End Social -->
							</div>
						</div>
					</div>
				</div>	
			</div>
			<!--/ End Topbar -->
			<!-- Middle Bar -->
			<div class="middle-bar">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-12">
							<!-- Logo -->
							<?php 
							$logoUrl = getOption('header_logo');
							if(!empty($logoUrl)):
							?>
							<div style="position: absolute;border-radius: 0 0 30px 30px;">
								<a href="<?php echo _WEB_HOST_ROOT;?>"><img src="<?php echo $logoUrl;?>" alt="logo"></a>
							</div>
							<?php else: ?>
								<h2 style="color: white;padding-top:5%;"><?php echo getOption('general_sitename'); ?></h2>
							<?php endif; ?>
							
							<!--/ End Logo -->
							<button class="mobile-arrow"><i class="fa fa-bars"></i></button>
							<div class="mobile-menu"></div>
						</div>
						<div class="col-lg-10 col-12">
							<!-- Main Menu -->
							<div class="mainmenu">
								<nav class="navigation">
									
									<?php 
									getMenu($menuData);
									?>
								</nav>
								<!-- Button -->
								<div class="button">
									<a href="<?php echo getOption('header_quote_link'); ?>" class="btn"><?php echo getOption('header_quote_text'); ?></a>
								</div>
								<!--/ End Button -->
							</div>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
			<!--/ End Middle Bar -->		
		</header><!--/ End Header -->