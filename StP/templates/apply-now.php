<?php
/**
 * Template Name: Apply Now
 */
?>
<?php get_header("apply_now"); ?>
<div id="content" class="content-padding">
	<?php wp_reset_query(); ?>
	<?php $fields = CFS()->get('content');?>
	<?php $a = 0; foreach ($fields as $field) { ?>
		<?php if(!empty($field)) {  ?>
			<div class="section-10">
				<div class="main-container">
					<div class="inside-small-container">
						<?php echo $field['content_box']; ?>
					</div>
				</div>
				<?php if(($a % 2) == 0) { ?>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-right"></div>
				<?php } else { ?>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-left"></div>
				<?php } ?>
			</div>
		<?php } ?>
	<?php  $a++; } ?>
</div>
<script src="<?= get_template_directory_uri() . '/public/js/virtual_pageviews.js' ?>"></script>
<?php get_footer(); ?>
