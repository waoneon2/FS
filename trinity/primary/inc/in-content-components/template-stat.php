<?php
/**
 * Template For in content component  - topic row
 */
if ($acf_fc['acf_fc_layout'] == 'facts_and_stats') {
	$acf = $acf_fc;
}
?>

<div class="stat <?php echo $acf['image'] ? 'theme_image' : 'theme_green' ?>">

	<?php if ($acf['image']): ?>
		<div class="js-background stat_background" data-background-options='{"source": {
			"0px": "<?php tric_image($acf['image'], '555x740') ?>",
			"500px": "<?php tric_image($acf['image'], '740x416') ?>",
			"980px": "<?php tric_image($acf['image'], '980x654') ?>",
			"1360px": "<?php tric_image($acf['image'], '980x552') ?>"
		}}'></div>
	<?php endif ?>

	<div class="stat_inner">
		<div class="stat_content"">
			<span class="stat_label">
				<?php echo $acf['figure']; ?>
			</span>
			<div class="stat_body">
				<p><?php echo $acf['context']; ?></p>
			</div>
		</div>
	</div>
</div>