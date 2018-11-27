<?php
if ( have_rows( 'sidebar_callouts' ) ) :
	get_template_part( 'layouts/callouts', 'sidebar' );
endif;