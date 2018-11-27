<?php
/**
 * Template Name: Search
 */

get_header();
?>
<div class="fs-row">
	<div class="fs-cell">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<div class="page_content_area">
	<div class="full_width_callouts">
		<div class="fs-row">
			<div class="fs-cell margined_lg_bottom">
				<h1 class="heading_1">Search</h1>
				<script>
				  (function() {
				    var cx = '011125037378944117833:n3_zbiffqrm';
				    var gcse = document.createElement('script');
				    gcse.type = 'text/javascript';
				    gcse.async = true;
				    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
				        '//www.google.com/cse/cse.js?cx=' + cx;
				    var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(gcse, s);
				  })();
				</script>
				<gcse:search></gcse:search>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();