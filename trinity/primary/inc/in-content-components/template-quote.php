<?php
/**
 * Template For in content component  - topic row
 */
if ($acf_fc['acf_fc_layout'] == 'testimonial') {
	$acf = $acf_fc;
}
?>


<blockquote class="quote_card <?php echo $acf['image'] ?  'theme_image' :  'theme_yellow' ?> ">

	<?php if ($acf['image']) : ?>
		<div class="js-background quote_card_background" data-background-options='{"source": {
		"0px": "<?php echo $acf['image'] ?>",
		"500px": "<?php echo $acf['image'] ?>",
		"980px": "<?php echo $acf['image'] ?>",
		"1360px": "<?php echo $acf['image'] ?>"
		}}'></div>
	<?php endif ?>

	<div class="quote_card_inner">
		<div class="quote_card_content" >
			  <span class="quote_card_icon">
				<svg class="icon icon_quote">
					 <use xlink:href="<?php tric_icon('quote') ?>"></use>
				</svg>
			  </span>
			<div class="quote_card_body" ">
				<p><?php echo $acf['quote'] ?> </p>
			</div>
			<cite class="quote_card_cite" >
				<span class="quote_card_cite_name"><?php echo $acf['quote_attribution'] ?></span>
				<span class="quote_card_cite_label"><?php echo $acf['quote_attribution_context'] ?> </span>
			</cite>
		</div>
	</div>
</blockquote>