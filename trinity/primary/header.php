<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Trinity_College
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="icon" href="<?php echo get_template_directory_uri() ?>/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" href="<?php echo get_template_directory_uri() ?>/android-chrome-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/android-chrome-256x256.png" />
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/android-chrome-256x256.png" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

	<?php wp_head(); ?>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-57MQD6L');</script>
	<!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-57MQD6L"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<!-- Alert -->
	<?php get_template_part( 'inc/partials/feature', 'alert' ); ?>

	<div id="page" class="page_wrapper">
		<header class="header" id="header" itemscope itemtype="http://schema.org/WPHeader">
			<div class="header_ribbon">
				<div class="fs-row">
					<div class="fs-cell">
						<div class="header_ribbon_inner">

							<div class="logo logo_header logo_icon" itemscope itemtype="http://schema.org/Organization">
								<a class="logo_link" itemprop="url" href="<?php echo network_site_url() ?>">
									<span class="logo_link_label">Trinity College</span>
									<span class="logo_link_icon">
										<svg class="icon icon_logo">
											<use xlink:href="<?php tric_icon('logo') ?>"></use>
										</svg>
									</span>
								</a>
								<meta content="<?php echo get_template_directory_uri() ?>/images/logo-schema.png" itemprop="logo">
							</div><!-- .logo -->

							<div class="header_group">
								<nav class="utility_nav utility_nav_lg" aria-label="Utility Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
								    <div class="utility_nav_list" role="navigation">
								    	<?php $current_blog =  get_current_blog_id() ?>
								    	<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
								    		<?php if (tric_navigation('exposed') ): ?>
										        <?php foreach (tric_navigation('exposed') as $object): ?>
										        	<div class="utility_nav_item">
										        	    <a class="utility_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
										        	        <span class="utility_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
										        	    </a>
										        	</div>
										        <?php endforeach ?>
										    <?php else: ?>
										    	<?php $href = (is_user_logged_in() && ($current_blog == 1)) ? 'href="'. admin_url('nav-menus.php') .'"' : '' ?>
										    	<div class="utility_nav_item">
									        	    <a class="utility_nav_link" <?php echo $href ?>>
									        	        <span class="utility_nav_link_label" itemprop="name">Navigation - Exposed</span>
									        	    </a>
									        	</div>
										    <?php endif ?>
								        <?php restore_current_blog() ?>
								    </div>
								</nav><!-- .utility_nav -->

								<button class="js-mobile-sidebar-handle mobile_sidebar_handle mobile_sidebar_handle_primary" title="open menu" onclick="return resetSearchFooter()">
								    <span class="mobile_sidebar_handle_icon mobile_sidebar_handle_icon_open">
								        <svg class="icon icon_menu">
								            <use xlink:href="<?php tric_icon('menu') ?>"></use>
								        </svg>
								    </span>
								    <span class="mobile_sidebar_handle_icon mobile_sidebar_handle_icon_close">
								        <svg class="icon icon_close">
								            <use xlink:href="<?php tric_icon('close') ?>"></use>
								        </svg>
								    </span>
								    <span class="mobile_sidebar_handle_label mobile_sidebar_handle_label_primary">Menu</span>
								</button>
							</div><!-- .header_group -->

						</div>
					</div>
				</div>
			</div>

			<!-- Breadcrump -->
			<?php get_template_part( 'inc/partials/navigation', 'breadcrumb' ); ?>

		</header><!-- #header -->
	<div id="content" class="page_inner">