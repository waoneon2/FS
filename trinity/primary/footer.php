<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Trinity_College
 */
?>

	</div><!-- #content -->

	<?php $current_blog =  get_current_blog_id() ?>
	<!-- footer_id = [footer-primary, footer-info, footer-social] -->
	<footer class="footer" id="footer" itemscope itemtype="http://schema.org/WPFooter">
		<div class="footer_ribbon">
			<div class="fs-row">
				<div class="fs-cell">
					<div class="footer_ribbon_inner">
						<div class="footer_ribbon_group">
							<div class="logo logo_footer logo_icon" itemscope itemtype="http://schema.org/Organization">
							    <a class="logo_link" itemprop="url" href="<?php echo network_site_url() ?>">
							        <span class="logo_link_label">Trinity College</span>
							        <span class="logo_link_icon">
							            <svg class="icon icon_logo">
							                <use xlink:href="<?php tric_icon('logo') ?>"></use>
							            </svg>
							        </span>
							    </a>
							    <meta content="<?php echo get_template_directory_uri() ?>/images/logo-schema.png" itemprop="logo">
							</div><!--.logo_footer-->

							<div class="footer_ribbon_mini_group">
								<div class="footer_address" itemscope itemtype="http://schema.org/PostalAddress">
									<a class="footer_address_link" href="https://www.google.com/maps/place/300+Summit+St,+Hartford,+CT+06106/data=!4m2!3m1!1s0x89e6533b575037eb:0xae1c576e17982be3?sa=X&ved=0ahUKEwjrhPqIyr_bAhUDxVkKHesqBlgQ8gEIJjAA" target="_blank">
										<span class="footer_address_name" itemprop="name">Trinity College</span>
										<span class="footer_address_street" itemprop="streetAddress">300 Summit Street, </span>
										<span class="footer_address_city" itemprop="addressLocality">Hartford</span>
										<span class="footer_address_state" itemprop="addressRegion">CT</span>
										<span class="footer_address_zip" itemprop="postalCode">06106</span>
									</a>
									<a class="footer_address_phone" itemprop="telephone" href="tel:(860) 297-2000">
										<span class="footer_address_label">(860) 297-2000</span>
									</a>
								</div><!--.footer_address-->
							</div>
						</div>
						<div class="footer_ribbon_group">
							<div class="social_nav social_nav_base" itemscope itemtype="http://schema.org/Organization">
							    <link itemprop="url" href="//http://www.trincoll.edu/Pages/default.aspx">
							    <div class="social_nav_header">
							        <h2 class="social_nav_title">Social Navigation</h2>
							    </div>
							    <div class="social_nav_list">
							    	<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
							    	<?php if (tric_navigation('footer-social') ): ?>
								    	<?php foreach (tric_navigation('footer-social') as $object): ?>
								    		<?php if (tric_social_filter($object->title)): ?>
										        <div class="social_nav_item">
										            <a class="social_nav_link" href="<?php echo esc_url($object->url) ?>" target="_blank" itemprop="sameAs">
										                <span class="social_nav_icon">
										                    <svg class="icon icon_<?php echo $object->title ?>">
										                        <use xlink:href="<?php tric_icon($object->title) ?>"></use>
										                    </svg>
										                </span>
										                <span class="social_nav_label"><?php echo $object->title ?></span>
										            </a>
										        </div>
											<?php endif ?>
								    	<?php endforeach ?>
								    <?php endif ?>
							    	<?php restore_current_blog() ?>
							    </div>
							</div><!--.social_nav-->

							<div class="quick_nav_wrapper">
								<header class="quick_nav_header">
									<h2 class="quick_nav_title">Information For</h2>
								</header>
								<nav class="quick_nav" aria-label="" itemscope itemtype="http://schema.org/SiteNavigationElement">
								    <div class="quick_nav_list" role="navigation">
								    	<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
											<?php if (tric_navigation('footer-info') ): ?>
										    	<?php foreach (tric_navigation('footer-info') as $object): ?>
											        <div class="quick_nav_item">
											            <a class="quick_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
											                <span class="quick_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
											            </a>
											        </div>
										        <?php endforeach ?>
										    <?php else : ?>
										    	<?php $href = (is_user_logged_in() && ($current_blog == 1)) ? 'href="'. admin_url('nav-menus.php') .'"' : '' ?>
										    	<div class="quick_nav_item">
										    	    <a class="quick_nav_link" <?php echo $href ?> itemprop="url">
										    	        <span class="quick_nav_link_label" itemprop="name">Navigation - Footer Info</span>
										    	    </a>
										    	</div>
										    <?php endif ?>
								        <?php restore_current_blog() ?>
								    </div>
								</nav>
							</div><!--.quick_nav_wrapper-->

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_sole">
			<div class="fs-row">
				<div class="fs-cell">
					<div class="footer_sole_inner">
						<nav class="footer_nav" aria-label="Footer Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
							<div class="footer_nav_list" role="navigation">
								<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
									<?php if (tric_navigation('footer-primary') ): ?>
										<?php foreach (tric_navigation('footer-primary') as $object): ?>
											<div class="footer_nav_item">
												<a class="footer_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
													<span class="footer_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
												</a>
											</div>
										<?php endforeach ?>
									<?php else: ?>
										<?php $href = (is_user_logged_in() && ($current_blog == 1)) ? 'href="'. admin_url('nav-menus.php') .'"' : '' ?>
										<div class="footer_nav_item">
											<a class="footer_nav_link" <?php echo $href ?> itemprop="url">
												<span class="footer_nav_link_label" itemprop="name">Navigation - Footer Primary</span>
											</a>
										</div>
									<?php endif ?>
								<?php restore_current_blog() ?>
							</div>
						</nav>
						<p class="footer_copyright">©<?=date("Y")?></p>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #footer -->
</div><!-- #page -->

<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
	<div class="js-mobile-sidebar mobile_sidebar" id="mobile_sidebar" tabindex="-1">

		<div class="site_search site_search_sm" id="site_search_sm" itemscope itemtype="http://schema.org/WebSite" role="search">
		    <meta itemprop="url" content="<?php echo home_url( '/' ) ?>">
		    <form class="site_search_form" id="tric_nav_bar_search" itemprop="potentialAction" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
		        <meta itemprop="target" content="<?php echo home_url( '/' ) ?>?s=<?php the_search_query(); ?>">
		        <label class="site_search_label" for="search_term_string_sm">Search</label>
		        <input aria-live="polite" class="site_search_input" itemprop="query-input" type="search" id="search_term_string_sm" name="s" value="<?php the_search_query(); ?>" placeholder="Search by keyword">
		        <button class="site_search_button" type="submit" title="submit" aria-label="submit">
		            <span class="site_search_button_label">Submit Search Query</span>
		            <span class="site_search_button_icon">
		                <svg class="icon icon_search">
		                    <use xlink:href="<?php tric_icon('search') ?>"></use>
		                </svg>
		            </span>
		        </button>
		    </form>
		</div><!--.site_search-->

		<nav class="js-main-nav js-main-nav-sm main_nav main_nav_sm" aria-label="Mobile Site Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	   		<?php $args = array(
				'menu' 			=> 'nested-pages',
				'items_wrap' 	=> '<div id="%1$s" class="main_nav_list" role="navigation">%3$s</div>',
				'container'		=> false,
				'menu_class' 	=> 'nav navbar-nav',
				'walker'		=> new tric_walker_nav_menu()
			);
			wp_nav_menu( $args  ); ?>
		</nav><!--nav .js-main-nav-->

		<nav class="secondary_nav secondary_nav_sm" aria-label="Mobile Secondary Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
		    <div class="secondary_nav_list" role="navigation">
	    		<?php if (tric_navigation('secondary') ): ?>
			        <?php foreach (tric_navigation('secondary') as $object): ?>
			        	<div class="secondary_nav_item">
			        	    <a class="secondary_nav_link arrow_right" href="<?php echo esc_url($object->url) ?>" itemprop="url">
			        	        <span class="secondary_nav_link_icon">
			        	            <svg class="icon icon_arrow_right">
			        	                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
			        	            </svg>
			        	        </span>
			        	        <span class="secondary_nav_link_label" itemprop="name"><?php echo $object->title ?></span>
			        	    </a>
			        	</div>
			        <?php endforeach; ?>
			    <?php else: ?>
			    	<?php $href = (is_user_logged_in() && ($current_blog == 1)) ? 'href="'. admin_url('nav-menus.php') .'"' : '' ?>
			    	<div class="secondary_nav_item">
			    	    <a class="secondary_nav_link arrow_right" <?php echo $href ?> itemprop="url">
			    	        <span class="secondary_nav_link_label" itemprop="name">Navigation - Secondary</span>
			    	    </a>
			    	</div>
			    <?php endif ?>
		    </div>
		</nav><!--.secondary_nav-->

		<nav class="utility_nav utility_nav_sm" aria-label="Utility Navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<div class="utility_nav_list" role="navigation">
				<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>
				<?php foreach (tric_navigation('exposed') as $object): ?>
				<div class="utility_nav_item">
					<a class="utility_nav_link" href="<?php echo esc_url($object->url) ?>" itemprop="url">
						<span class="utility_nav_link_label" itemprop="name">
							<?php echo $object->title ?>
						</span>
					</a>
				</div>
				<?php endforeach ?>
				<?php restore_current_blog() ?>
			</div>
		</nav>
		<!-- .utility_nav -->

	</div>
<?php restore_current_blog() ?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b7b6efef93d47ed"></script>
<?php wp_footer(); ?>

</body>
</html>

<?php $c_blog_id = get_current_blog_id() ?>
<?php (get_current_blog_id() > 1) ? switch_to_blog(1) : '' ?>

	<?php if ($c_blog_id > 1):
		$args = [
		    'post_type' => 'page',
		    'meta_key' => '_wp_page_template',
		    'meta_value' => '404.php'
		];
		$pages  = get_posts( $args );
		$post   = $pages[0];
	endif ?>

	<script>
	(function() {
	    var cx = "<?php the_field('google_cse_id'); ?>";
	    if(cx.trim() === ""){
	    	cx = "011737558837375720776:mbfrjmyam1g";
	    }
	    var gcse = document.createElement('script');
	    gcse.type = 'text/javascript';
	    gcse.async = true;
	    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(gcse, s);
	  })();
	</script>
	<script>
		var WWW_ROOT = "";
		var STATIC_ROOT = get_template_directory_uri();
	</script>
<?php restore_current_blog() ?>