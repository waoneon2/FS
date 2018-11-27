<?php
$page_title = array();
$head_title = get_bloginfo( 'name' );

if ( is_404() ) {
	$page_title[] = 'Not Found';
} elseif ( ! is_home() && ! is_front_page() ) {
	$page_title[] = wp_title( '', false );
}

if ( ! empty( $head_title ) && false === strpos( $head_title, FIELDING_TITLE ) ) {
	$page_title[] = $head_title;
}

$page_title[] = FIELDING_TITLE;
?><!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">

		<title><?php echo implode( $page_title, ' &middot; ' ) ?></title>

		<?php get_template_part( 'layouts/favicon' ); ?>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class( 'fs-grid' ); ?>>
		<script src="//assets.adobedtm.com/c876840ac68fc41c08a580a3fb1869c51ca83380/satelliteLib-edd5ccfb7c084d3f75e1086236d2a1061d4e7ddd.js"></script>
		<script>
/*
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-1322288-7', 'auto');
			ga('send', 'pageview');
*/
		</script>

		<a href="#page" id="skip_to_content" class="skip_link">Skip to Main Content</a>
		<div class="page_wrapper js-navigation_push">
			<?php 
				$live_chat	 	= get_field('live_chat', 'option');
				$phone_number	= get_field('phone_number', 'option');
				$calender	 	= get_field('calender', 'option');
				$request_info	= get_field('request_info', 'option');
				$apply_now	 	= get_field('apply_now', 'option');
				
				$phone_view_part[1] = substr($phone_number, 0, 3);
				$phone_view_part[2] = substr($phone_number, 3, 3);
				$phone_view_part[3] = substr($phone_number, 6);
				$phone_view = $phone_view_part[1].'-'.$phone_view_part[2].'-'.$phone_view_part[3];
			?>
			<header id="header" class="header" role="banner">
				<!-- Header Row -->
				<div class="fs-row">
					<!-- Header Cell -->
					<div class="fs-cell fs-all-12 clearfix header_container">
						<!-- Site Logo -->
						<a href="index.html" class="logo_main" itemscope="" itemtype="http://schema.org/CollegeOrUniversity">
							<h1 class="hide" itemprop="name">Fielding Graduate University</h1>
						</a>
						<!-- END: Site Logo -->
						<a class="live_chat" href="<?php echo $live_chat ?>">Live Chat</a>
						<!-- Mobile Nav Controls -->
						<button type="button" class="mobile_navigation_handle js-mobile_handle fs-lg-hide fs-xl-hide"></button>
						<!-- END: Mobile Nav Controls -->
						<!-- Wrap for mobile -->
						<div class="fs-sm-hide fs-md-hide header_wrap">
							<!-- Quick Nav -->
							<div class="quick_nav_wrap">
								<nav class="quick_nav" aria-labelledby="quick_nav_label">
									<h2 class="visually_hidden" id="quick_nav_label">Quick Navigation</h2>
									<div class="quick_nav_list clearfix" role="navigation">
										<?php $args = array(
											'menu' 			=> get_nav_menu_locations()['utility_nav'],
											'items_wrap' 	=> '<ul id="%1$s" class="menu">%3$s</ul>',
											'container'		=> false,
											'menu_class' 	=> 'nav navbar-nav',
											'walker'		=> new Fielding_Utility_Nav_Walker()
										);
										wp_nav_menu( $args  ); ?>
									</div>
								</nav>
							</div>
							<!-- END: Quick Nav -->
							<!-- Secondary Nav -->
							<div class="secondary_nav_wrap">
								<nav class="secondary_nav" aria-labelledby="secondary_nav_label">
									<h2 class="visually_hidden" id="secondary_nav_label">Secondary Navigation</h2>
									<div class="secondary_nav_list clearfix" role="navigation">
										<ul id="menu-utility-navigation-1" class="menu">
											<li class="chat menu-item menu-item-type-post_type menu-item-object-page menu-item-32">
												<a href="<?php echo $live_chat ?>">Live Chat</a>
											</li>
											<li class="phone menu-item menu-item-type-post_type menu-item-object-page menu-item-31">
												<a href="tel:<?php echo $phone_number ?>"><?php echo $phone_view  ?></a>
											</li>
											<li class="calendar menu-item menu-item-type-post_type menu-item-object-page menu-item-33">
												<a href="<?php echo $calender ?>">Calendar</a>
											</li>
										</ul>
									</div>
								</nav>
							</div>
							<!-- END: Secondary Nav -->
							<!-- Site Search -->
							<div class="search_wrap">
								<form action="<?php fielding_page_link( 'search' ); ?>" class="search_form">
									<input type="text" class="search_input" placeholder="Search...">
									<input type="hidden" class="search_submit" value="Go">
									<button class="search_submit icon_text" type="submit">Search</button>
								</form>
							</div>
							<!-- END: Site Search -->
						</div>
						<!-- END: Wrap for mobile -->
					</div>
					<!-- END: Header Cell -->
				</div>
				<!-- END: Header Row -->
				<!-- Main Nav -->
				<div class="main_nav_placeholder"></div>
				<nav class="main_nav clearfix" aria-labelledby="main_nav_label">
					<h2 class="visually_hidden" id="main_nav_label">Main Navigation</h2>
					<div class="fs-row">
						<div class="fs-cell">
							<div class="main_nav_inner">
								<div class="main_nav_group">
									<div class="main_nav_list" role="navigation">
										<?php $args = array(
											'menu' 			=> get_nav_menu_locations()['main_nav'],
											'items_wrap' 	=> '<ul id="%1$s" class="menu">%3$s</ul>',
											'container'		=> false,
											'menu_class' 	=> 'nav navbar-nav',
											'walker'		=> new Fielding_Navigation_Walker()
										);
										wp_nav_menu( $args  ); ?>
									</div>
								</div>
								<div class="main_nav_group">
									<!-- Button Nav -->
									<div class="button_nav_wrap">
										<nav class="button_nav" aria-labelledby="button_nav_label">
											<h2 class="visually_hidden" id="button_nav_label">Button Navigation</h2>
											<div class="button_nav_list clearfix" role="navigation">
												<ul id="menu-utility-navigation-2" class="menu">
													<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-33">
														<a href="<?php echo $request_info ?>" <?php fielding_new_window(true) ?>>Request Info</a>
													</li>
													<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32">
														<a href="<?php echo $apply_now ?>" <?php fielding_new_window(true) ?>>Apply Now</a>
													</li>
												</ul>
											</div>
										</nav>
									</div>
									<!-- END: Secondary Nav -->
								</div>
							</div>
						</div>
					</div>
				</nav>
				<!-- END: Main Nav -->
			</header>
			<main id="page" class="page_main" tabindex="-1">
				
