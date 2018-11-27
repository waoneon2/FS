<?php
$addresses = get_field( 'theme_addresses', 'option' );
$contact   = get_field( 'theme_contact', 'option' );

$copyright = 'Copyright &copy; ' . date( 'Y' ) . ' ' . FIELDING_TITLE;
?>
			</main>
			<footer id="footer" class="footer">
				<div class="fs-row clear">
					<div class="fs-cell fs-xs-full fs-md-3 fs-lg-4">
						<a href="<?php fielding_page_link( 'home' ); ?>" class="logo_footer"><?php echo FIELDING_TITLE; ?></a>
						<a href="<?php echo $contact; ?>" class="btn btn_white">Contact Us</a>
					</div>
					<div class="fs-cell fs-xs-full fs-md-3 fs-lg-4 address">
						<?php
							if ( array_filter( (array) $addresses ) ) :
								foreach ( $addresses as $address ) :
						?>
						<div class="address_item">
							<?php
								if ( $address["name"] ) :
							?>
							<h6 class="address_name"><?php echo $address["name"]; ?></h6>
							<?php
								endif;
								if ( $address["address"] ) :
							?>
							<p class="address_location"><?php echo $address["address"]; ?></p>
							<?php
								endif;
								if ( $address["phone"] ) :
									$phone_clean = str_ireplace( array( '-', '.' ), array( '', '' ), $address["phone"]);
							?>
							<a href="tel:+1<?php echo $phone_clean; ?>" class="address_phone"><?php echo $address["phone"]; ?></a>
							<?php
								endif;
							?>
						</div>
						<?php
								endforeach;
							endif;
						?>
					</div>
					<div class="fs-cell fs-xs-hide fs-sm-hide fs-lg-4">
						<nav class="social_nav clearfix">
							<?php fielding_menu( 'social_nav' ); ?>
						</nav>
					</div>
				</div>
				<div class="footer_nav_wrap">
					<div class="fs-row">
						<div class="fs-cell fs-xs-full fs-lg-7 fs-xl-8">
							<nav class="footer_nav">
								<?php fielding_menu( 'consistent_nav' ); ?>
							</nav>
						</div>
						<div class="fs-cell fs-xs-hide fs-sm-hide fs-lg-5 fs-xl-4">
							<p class="copyright"><?php echo $copyright; ?></p>
						</div>
					</div>
				</div>
				<div class="social_nav_wrap" aria-hidden="true">
					<div class="fs-row">
						<div class="fs-cell">
							<nav class="social_nav clearfix fs-xs-full fs-md-hide fs-lg-hide">
								<?php fielding_menu( 'social_nav' ); ?>
							</nav>
						</div>
					</div>
				</div>
				<div class="copyright_wrap" aria-hidden="true">
					<div class="fs-row">
						<div class="fs-cell fs-xs-full fs-md-hide fs-lg-hide fs-xl-hide">
							<p class="copyright"><?php echo $copyright; ?></p>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<?php
			$navigation_options = array(
				"gravity" => "right",
				"type"    =>"overlay",
				"labels"  => array(
					"open"   => "Close Menu",
					"closed" => "",
				),
			);
		?>

		<!-- Mobile Navigation -->

		<div class="mobile_navigation js-mobile_navigation fs-navigation-element fs-navigation-overlay-nav fs-navigation-overlay-right-nav fs-navigation__0 fs-light fs-navigation-enabled fs-navigation-animated fs-navigation-open" aria-hidden="true" data-navigation-handle=".js-mobile_handle" data-navigation-content=".js-navigation_push" data-navigation-options="{&quot;gravity&quot;:&quot;right&quot;,&quot;labels&quot;:{&quot;open&quot;:&quot;&quot;,&quot;closed&quot;:&quot;&quot;},&quot;type&quot;:&quot;overlay&quot;}">

			<a href="index.html" class="logo_main" itemscope="" itemtype="http://schema.org/CollegeOrUniversity">
				<span class="hide" itemprop="name">Fielding Graduate University</span>
			</a>

			<!-- Mobile Nav Controls -->
			<button type="button" class="mobile_navigation_handle js-mobile_handle close_button fs-navigation-handle fs-navigation-overlay-handle fs-navigation-overlay-right-handle fs-light fs-swap-element fs-navigation-enabled"></button>
			<!-- END: Mobile Nav Controls -->

			<!-- Site Search -->
			<div class="search_wrap">
				<form action="<?php fielding_page_link( 'search' ); ?>" class="search_form">
					<input type="text" class="search_input" placeholder="Search...">
					<input type="hidden" class="search_submit" value="Go">
					<button class="search_submit icon_text" type="submit">Search</button>
				</form>
			</div>
			<!-- END: Site Search -->

			<!-- Main Nav -->
			<nav class="main_nav clearfix" aria-labelledby="main_nav_label">
				<h2 class="visually_hidden" id="main_nav_label">Main Navigation</h2>
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
				</div>
			</nav>
			<!-- END: Main Nav -->

			<!-- Button Nav -->
			<div class="button_nav_wrap">
				<nav class="button_nav" aria-labelledby="button_nav_label">
					<h2 class="visually_hidden" id="button_nav_label">Button Navigation</h2>
					<div class="button_nav_list clearfix" role="navigation">
						<ul id="menu-utility-navigation-3" class="menu">
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-33">
								<a href="<?php echo $request_info ?>">Request Info</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-32">
								<a href="<?php echo $apply_now ?>">Apply Now</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<!-- END: Secondary Nav -->

			<!-- Secondary Nav -->
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
			<div class="secondary_nav_wrap">
				<nav class="secondary_nav" aria-labelledby="secondary_nav_label">
					<h2 class="visually_hidden" id="secondary_nav_label">Secondary Navigation</h2>
					<div class="secondary_nav_list clearfix" role="navigation">
						<ul id="menu-utility-navigation-4" class="menu">
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

		</div>

		<!-- END: Mobile Navigation -->

		<?php wp_footer(); ?>
		<script type="text/javascript">_satellite.pageBottom();</script>
	</body>
</html>
