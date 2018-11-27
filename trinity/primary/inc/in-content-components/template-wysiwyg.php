<?php
/**
 * Template For in content component  - wysiwyg
 */
if ($acf_fc['acf_fc_layout'] == 'wysiwyg') {
	$acf = $acf_fc;
}
?>

<div class="wysiwyg_block">
   <div class="typography">
   		<?php echo $acf['content'] ?>
    </div>
 </div>