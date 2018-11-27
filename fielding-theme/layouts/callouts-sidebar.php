<?php
if ( have_rows( 'sidebar_callouts' ) ) :
?>
<aside class="fs-cell fs-cell-right fs-lg-3 sidebar">
	<?php
	while ( have_rows( 'sidebar_callouts' ) ) :
		the_row();
		get_template_part( 'layouts/callout-sidebar', get_row_layout() );
	endwhile;
	?>
</aside>
<?php
endif;
