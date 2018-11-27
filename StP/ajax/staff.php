<?php require_once('../../../../wp-load.php');

	$args = array(
		'post_type' => 'staff',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC'
	);
	if ($_GET['staff'] == 'all') {

	} else if ($_GET['staff'] == 'school-staff-executive-leadership') {
		$args['tax_query'] = array(
			array(
		        'taxonomy' => 'education-staff',
		        'field' => 'slug',
		        'terms' => array( 'school-staff', 'executive-leadership' ),
		    ),
		);
	} else {
		$args['tax_query'] = array(
			array(
		        'taxonomy' => 'education-staff',
		        'field' => 'slug',
		        'terms' => $_GET['staff'],
		    ),
		);
	}



	$teachers = query_posts($args); ?>

	<div class="row-box">
		<?php $i = 0; $type = 1; foreach($teachers as $teacher) { ?>
				<?php
					if($i == 2){
						echo '</div><div class="row-box">';
						$i = 0;

						if($type == 1){
							$type = 2;
						} else {
							$type = 1;
						}
					}
				?>
			<a href="<?php echo get_the_permalink($teacher->ID); ?>" class="cell-box clearfix">
				<?php if($type == 1){ ?>
					<?php if ( has_post_thumbnail($teacher->ID) ) {
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($teacher->ID), 'full');
						echo '<div class="wrap-img"><img style="width: 100%; height: auto;" src="' . $image[0] . '" alt="' . get_the_title($teacher->ID) . '" /></div>';
					} ?>
					<div class="title-box">
						<h5><?php echo get_the_title($teacher->ID); ?></h5>
						<p><?php echo CFS()->get('grade', $teacher->ID); ?></p>
					</div>
				<?php } else { ?>
					<div class="title-box">
						<h5><?php echo get_the_title($teacher->ID); ?></h5>
						<p><?php echo CFS()->get('grade', $teacher->ID); ?></p>
					</div>
					<?php if ( has_post_thumbnail($teacher->ID) ) {
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($teacher->ID), 'full');
						echo '<div class="wrap-img"><img style="width: 100%; height: auto;" src="' . $image[0] . '" alt="' . get_the_title($teacher->ID) . '" /></div>';
					} ?>
				<?php }?>
			</a>
		<?php $i++; } ?>
	</div>
