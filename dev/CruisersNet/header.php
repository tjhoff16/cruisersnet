<!DOCTYPE html>
<html lang="en-US">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="shortcut icon" type="image/x-icon"  href="">     
    <link rel="apple-touch-icon" sizes="57x57" href="">
    <link rel="apple-touch-icon" sizes="72x72" href="">
    <link rel="apple-touch-icon" sizes="114x114" href="">
    <link rel="apple-touch-icon" sizes="144x144" href="">  
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>

    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link href="<?php bloginfo('template_directory'); ?>/css/styles.css" rel="stylesheet">
    <link href="<?php bloginfo('template_directory'); ?>/css/icoMoon.css" rel="stylesheet">
    <link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- <link href="http://v2.cruisersnet.net/wp-content/themes/circle_1.10/style.css" rel="stylesheet"> -->

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    
    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>
	
<!-- Begin Header -->
<header>

	<div class="header-top">
		<div class="container">
			<nav id="top-nav">
				<div class="top-nav-wrap">
					<div class="home-link"><a name="top" href="<?php bloginfo('url'); ?>"><i class="glyphicon glyphicon-home"></i></a></div>
					<?php wp_nav_menu(array('menu'=>'Top Menu','container'=>false,'menu_class'=>'nav nav-pills pull-right','walker'=>new CNet_Top_Nav_Walker)); ?>
				</div>
				<div class="clear"></div>
			</nav>
		</div>
	</div> <!-- /.header-top -->
	
	<div class="header-mid">
		<div class="container">
			<div class="col-sm-4 logo">
				<img src="<?php bloginfo('template_directory'); ?>/images/cnet-logo-2014.png" alt="SSECN Logo" />
			</div>
			<div class="col-sm-4 logo-text">
				<div class="logo-top">The <span>S</span>alty <span>S</span>outheast</div>
				<div class="logo-mid"><span>C</span>ruisers' <span>N</span>et</div>
				<div class="logo-low">Cruisers Helping Cruisers</div>
			</div>
			<div class="col-sm-4 social-search">
				<div class="social-icons">
					<a href="<?php the_field('facebook_url','option'); ?>" target="_blank"><div class="social-icon facebook"><i class="fa fa-facebook"></i></div></a>
					<a href="<?php the_field('twitter_url','option'); ?>" target="_blank"><div class="social-icon twitter"><i class="fa fa-twitter"></i></div></a>
					<a href="<?php the_field('google_plus_url','option'); ?>" target="_blank"><div class="social-icon google"><i class="fa fa-google-plus"></i></div></a>
					<a href="<?php the_field('linkedin_url','option'); ?>" target="_blank"><div class="social-icon linkedin"><i class="fa fa-linkedin"></i></div></a>
					<a href="<?php the_field('flickr_url','option'); ?>" target="_blank"><div class="social-icon flickr"><i class="fa fa-flickr"></i></div></a>
				</div>
				<div class="clear"></div>
				<div class="search-box">
					<form action="#" method="post">
						<input type="text" name="s" class="search-input" />
						<button type="submit" name="submit" class="search-submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- /.header-mid -->
	
	<div class="header-low">
		<div class="container">
			<div class="col-sm-12 sponsors text-center">
				<?php get_template_part('part','sponsors'); ?>
			</div>
		</div>
	</div> <!-- /.header-low -->
	
</header>
<!-- End Header -->