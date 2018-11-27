<?php
$label      = get_field( 'finder_label' );
$heading    = get_field( 'finder_heading' );
$content    = get_field( 'finder_content' );
$link_title = get_field( 'finder_link_title' );
$link_url   = get_field( 'finder_link_url' );
$link_new_window = get_field( 'finder_link_new_window' );

$carousel_options = array(
	"matchHeight" => true,
	"contained"   => false,
	"theme" => "combo_pager",
	"show"  => array(
		"740px" => 2,
		"980px" => 3,
	),
);

$equalize_options = array(
	"target" => ".js-equalize_child",
);

if ( have_rows( 'groups' ) ) :
?>
<article class="program_wrap margined_lg">
    <div class="fs-row">
        <div class="fs-cell fs-all-full">
            <h2 class="media_carousel_label"><?php echo $label; ?></h2>
			<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
			<p class="larger"><?php echo $content; ?></p>
	        <div class="js-carousel js-equalize program_carousel" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
				<?php
					while ( have_rows( 'groups' ) ) :
						the_row();

						$heading  = get_sub_field( 'heading' );
						$programs = get_sub_field( 'programs' );
				?>
		        <div class="program_box_wrap">
				    <div class="program_box js-equalize_child">
				        <h3 class="heading_3"><?php echo $heading; ?></h3>
				        <?php
					        while ( have_rows( 'programs' ) ) :
					        	the_row();

					        	$program = get_sub_field( 'program' );
				        ?>
				        <a href="<?php echo get_the_permalink( $program->ID ); ?>"><?php echo get_the_title( $program->ID ); ?></a>
				        <?php
					        endwhile;
				        ?>
				    </div>
				</div>
				<?php
					endwhile;
				?>
		    </div>
	        <a href="<?php echo $link_url; ?>" class="carousel_link"<?php fielding_new_window( $link_new_window ); ?>><?php echo $link_title; ?></a>
		</div>
    </div>
</article>
<?php
endif;