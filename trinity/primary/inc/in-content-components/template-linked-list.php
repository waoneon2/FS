<?php
/**
 * Template For in content component  - topic row
 */
if ($acf_fc['acf_fc_layout'] == 'link_list') {
	$acf = $acf_fc;
}
?>

<!-- Linked List -->
<div class="linked_list">
	<header class="linked_list_header">
		<h2 class="linked_list_title" itemprop="name">
			<span class="linked_list_title_icon">
	             <svg class="icon icon_link">
	                <use xlink:href="<?php tric_icon('link') ?>"></use>
	            </svg>
			</span>
			<span class="linked_list_title_label"><?php echo $acf['title'] ?></span>
		</h2>
	</header>
	<div class="linked_list_body">
		<ul class="linked_list_group">
			<?php if ($acf['links']): ?>
				<?php foreach($acf['links'] as $row) : ?>
					<li class="linked_list_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<a class="linked_list_link" <?php tric_tblank($row['url_links']) ?> href="<?php echo $row['url_links'] ?>" itemprop="url">
							<span class="linked_list_link_inner">
								<span class="linked_list_label" itemprop="name"><?php echo $row['title_links'] ?></span>
								<span class="linked_list_icon">
									<svg class="icon icon_arrow_right">
						                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
						            </svg>
								</span>
							</span>
						</a>
					</li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>
</div>
<!-- END: Linked List -->
