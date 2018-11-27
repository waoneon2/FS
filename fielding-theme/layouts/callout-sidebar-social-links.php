<?php
$heading = get_sub_field( 'heading' );

if ( have_rows( 'links' ) ) :
?>
<article class="sidebar_callout_wrap sidebar_component margined_md">
	<div class="sidebar_callout sidebar_img sidebar_gray_light">
		<div class="sidebar_content">
			<h4 class="heading_dashed"><?php echo $heading; ?></h4>
			<nav class="social_nav clearfix">
				<ul id="menu-social-navigation" class="menu">
					<?php
						while ( have_rows( 'links' ) ) :
							the_row();

							$icon = get_sub_field( 'social_icon' );
							$link_title = get_sub_field( 'link_title' );
							$link_url   = get_sub_field( 'link_url' );
					?>
					<li class="<?php echo $icon; ?> menu-item">
						<a href="<?php echo $link_url; ?>" target="_blank"><?php echo $link_title; ?></a>
					</li>
					<?php
						endwhile;
					?>
				</ul>
			</nav>
		</div>
	</div>
</article>
<?php
endif;