<?php
$label   = get_sub_field( 'label' );
$heading = get_sub_field( 'heading' );
$content = get_sub_field( 'content' );

$equalize_options = array(
	"target"   => ".js-equalize_child",
	"minWidth" => "500px"
);

if ( have_rows( 'facts' ) ) :
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
			</div>
		</div>
		<div class="fs-cell fs-lg-full js-equalize" data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
			<?php
				while ( have_rows( 'facts' ) ) :
					the_row();

					$color  = get_sub_field( 'facts_color_option' );
					$fact   = get_sub_field( 'fact' );
					$detail = get_sub_field( 'detail' );
			?>
			<div class="fs-cell fs-xs-full fs-sm-half fs-md-half fs-lg-3 js-equalize_child margin_btm">
				<div class="solo_stat_wrap">
					<div class="solo_stat">
					    <div class="solo_stat_text">
					        <h2 class="large_text <?php echo $color; ?>_text"><?php echo $fact; ?></h2>
							<p class="stat"><?php echo $detail; ?></p>
					    </div>
					</div>
				</div>
			</div>
			<?php
				endwhile;
			?>
		</div>
	</div>
</section>
<?php
endif;
