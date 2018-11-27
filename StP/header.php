<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <script src="//cdn.optimizely.com/js/3399740646.js"></script>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700' rel='stylesheet' type='text/css' />
	<!--[if lt IE 10]>
		<link href="<?php echo esc_url(get_template_directory_uri()); ?>/public/css/ie.css" rel="stylesheet">
		<script src="<?php echo esc_url(get_template_directory_uri()); ?>/public/js/jquery.placeholder.min.js"></script>
		<script src="<?php echo esc_url(get_template_directory_uri()); ?>/public/js/ie-placeholder.js"></script>
	<![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php get_template_part('snippet', 'gtm'); ?>
	<div class="wrapper header-animate theme-1">
		<div class="desctop-schedule"><a href="#modal-form" class="popup-btn">Schedule tour</a></div>
		<div class="mobile-menu">
			<div class="search-box">
				<a href="#" class="open-btn">&nbsp;</a>		
				<?php get_search_form(); ?>					
			</div>
			<nav>
				<?php wp_nav_menu(array('theme_location' => 'main', 'container' => false, 'menu_class' => '', 'link_before' => '<span>', 'link_after' => '</span>')); ?>		
			</nav>
			<div class="apply-now"><a href="<?php echo site_url(); ?>/apply-now/"><span>Apply Now</span></a></div>
			<div class="mobile-schedule"><a href="#modal-form" class="popup-btn">Schedule tour</a></div>
			<!--<ul class="contact-menu">
				<li class="phone"><a href="tel:+3607383321"><span>360.738.3321</span></a></li>
				<li><a href="#">Q&amp;A</a></li>
				<li><a href="#">SPA Directory</a></li>
				<li><a href="#">Employment</a></li>
				<li class="fb"><a href="#">&nbsp;</a></li>
			</ul>-->
			<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => false, 'menu_class' => 'contact-menu')); ?>
		</div>
		<div class="content-section">
			<header>
				<div class="wrap-header-container">
					<div class="table-header-container">
						<div class="header-container">
							<div class="table-section">
								<a href="#" class="mobile-menu-btn">
									<span>&nbsp;</span>
									<span>&nbsp;</span>
									<span>&nbsp;</span>
								</a>
								<div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/public/images/logotype.png" alt="<?php bloginfo('name'); ?>"></a></div>
								<div class="group-box">
									<nav>
										<div class="menu">
											<?php wp_nav_menu(array('theme_location' => 'main', 'container' => false, 'menu_class' => '')); ?>	
										</div>
										<div class="search-box">
											<a href="#" class="open-btn">&nbsp;</a>								
											<?php get_search_form(); ?>		
											<a href="#" class="close-btn" style="display: none;">close</a>																							
										</div>
										<div class="apply-now"><a href="/apply-now/">Apply Now</a></div>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div class="content-area">





















