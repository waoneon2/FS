<?php if ( have_rows( 'full_width_callouts' ) ) : ?>
<aside class="full_width_components">
	<?php
	while ( have_rows( 'full_width_callouts' ) ) :
		the_row();
		get_template_part( 'layouts/callout-full-width', get_row_layout() );
	endwhile;
	?>
</aside>
<?php endif;

