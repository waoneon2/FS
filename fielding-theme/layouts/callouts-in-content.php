<?php
if ( have_rows( 'content_callouts' ) ) :
	while ( have_rows( 'content_callouts' ) ) :
		the_row();
		get_template_part( 'layouts/callout-in-content', get_row_layout() );
	endwhile;
endif;