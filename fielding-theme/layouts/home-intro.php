<?php
$label      = get_field( 'intro_label' );
$heading    = get_field( 'intro_heading' );
$content    = get_field( 'intro_content' );
$link_title = get_field( 'intro_link_title' );
$link_url   = get_field( 'intro_link_url' );
$link_new_window = get_field( 'intro_link_new_window' );
?>
<section class="introduction_section margined_lg">
	<div class="fs-row">
		<div class="fs-cell-centered fs-lg-10">
			<div class="introduction_wrapper">
				<header class="introduction_header">
					<h2 class="introduction_label"><?php echo $label; ?></h2>
					<h3 class="introduction_title"><?php echo $heading; ?></h3>
				</header>
				<div class="introduction_description">
					<p><?php echo $content; ?></p>
				</div>
				<?php if ( $link_title && $link_url ) : ?>
				<footer class="introduction_footer">
					<a class="introduction_button" href="<?php echo $link_url; ?>"<?php fielding_new_window( $link_new_window ); ?>><?php echo $link_title; ?></a>
				</footer>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>