<?php
/**
 * Template For Full Width Components - Gallery contact card
 *
 */
if ($acf_fc['acf_fc_layout'] == 'contact_information') {
	$acf = $acf_fc;
}
?>

<div class="contact">
	<header class="contact_header">
		<div class="contact_header_inner">
			<span class="contact_label">GET IN TOUCH</span>
			<h2 class="contact_name"><?php echo $acf['label'] ?></h2>
			<nav class="contact_social">

				<div class="social_nav social_nav_contact" itemscope itemtype="http://schema.org/Organization">
				    <link itemprop="url" href="//http://www.trincoll.edu/Pages/default.aspx">
				    <div class="social_nav_list">
				    	<?php if ($acf['social_links']): ?>
					    	<?php foreach ($acf['social_links'] as $acf_soc): ?>
						        <div class="social_nav_item">
						            <a class="social_nav_link" href="<?php echo esc_url($acf_soc['url']) ?>" target="_blank" itemprop="sameAs">
						                <span class="social_nav_icon">
						                    <svg class="icon icon_<?php echo $acf_soc['service'] ?>">
						                        <use xlink:href="<?php tric_icon($acf_soc['service']) ?>"></use>
						                    </svg>
						                </span>
						                <span class="social_nav_label"><?php echo $acf_soc['service'] ?></span>
						            </a>
						        </div>
					    	<?php endforeach ?>
				    	<?php endif ?>
				    </div>
				</div><!--.social_nav-->

			</nav>
		</div>
	</header>
	<div class="contact_body">
		<div class="contact_details">
			<div class="contact_details_group">

				<?php if($acf['location']): ?>
					<div class="contact_detail contact_detail_location">
						<span class="contact_detail_icon">
							<svg class="icon icon_marker">
								<use xlink:href="<?php tric_icon('marker') ?>"></use>
							</svg>
						</span>
						<div class="contact_detail_label">
							<span class="contact_detail_name"><?php echo $acf['name'] ?></span>
							<span class="contact_detail_sublabel"><?php echo $acf['location'] ?></span>
						</div>
					</div>
				<?php endif ?>

				<?php if($acf['hours']): ?>
					<div class="contact_detail">
						<span class="contact_detail_icon">
							<svg class="icon icon_clock">
								<use xlink:href="<?php tric_icon('clock') ?>"></use>
							</svg>
						</span>
						<span class="contact_detail_label"><?php echo $acf['hours'] ?></span>
					</div>
				<?php endif ?>

			</div>
			<div class="contact_details_group">

				<?php if($acf['email']): ?>
					<div class="contact_detail">
						<span class="contact_detail_icon">
							<svg class="icon icon_email">
								<use xlink:href="<?php tric_icon('email') ?>"></use>
							</svg>
						</span>
						<a class="contact_detail_label contact_detail_link" href="mailto:<?php echo $acf['email'] ?>"><?php echo $acf['email'] ?></a>
					</div>
				<?php endif ?>

				<?php if($acf['phone']): ?>
					<div class="contact_detail">
						<span class="contact_detail_icon">
							<svg class="icon icon_phone">
								<use xlink:href="<?php tric_icon('phone') ?>"></use>
							</svg>
						</span>
						<a class="contact_detail_label" href="tel:<?php echo preg_replace("/[^0-9]/", "", $acf['phone'] ) ?>"><?php echo $acf['phone'] ?></a>
					</div>
				<?php endif ?>

				<?php if($acf['fax']): ?>
					<div class="contact_detail">
						<span class="contact_detail_icon">
							<svg class="icon icon_printer">
								<use xlink:href="<?php tric_icon('printer') ?>"></use>
							</svg>
						</span>
						<a class="contact_detail_label" href="tel:<?php echo preg_replace("/[^0-9]/", "", $acf['fax'] ) ?>"><?php echo $acf['fax'] ?></a>
					</div>
				<?php endif ?>

			</div>
		</div>
	</div>
</div>