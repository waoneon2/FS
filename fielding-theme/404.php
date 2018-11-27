<?php
get_header();

?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<div class="page_content_area">
	<div class="full_width_components">
		<div class="not_found">
			<div class="fs-row">
				<div class="fs-cell">
					<h1 class="heading_1">404 Error</h1>
					<p class="intro_serif">We're sorry, but the page you are looking for has moved or does not exist.  Let us help you find what you are looking for.</p>
				</div>
			</div>
			<div class="fs-row">
				<div class="fs-cell fs-lg-6 events_heading">
					<div class="search_wrap">
						<form action="<?php fielding_page_link( 'search' ); ?>" class="search_form">
							<input type="text" class="search_input" placeholder="Search...">
							<button class="search_submit icon_text" type="submit">Search</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

get_footer();