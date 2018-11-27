<?php
/**
 * Template Name: Support
 */
?>
<?php get_header('support'); ?>
	<?php
		$args = array(
			'post_parent' => $post->ID,
			'post_type' => 'page',
            'orderby'   => 'menu_order',
			'order' => 'ASC'
		);
		$child_query = new WP_Query( $args );
	?>
	<div id="content" class="content-padding">
		<?php while ( $child_query->have_posts() ) : $child_query->the_post();?>
			<?php if($post->post_name == 'donate') { ?>
				<div class="section-31" id="donate">
					<div class="main-container">
						<div class="short-container">
							<?php the_content(); ?>
                            <form action="https://www.paypal.com/cgi-bin/webscr" class="donate-section" method="post" id="paypal">
                                <div class="wrap-range-slider"><input type="text" id="rangeSlider1" name="amount" value=""></div>
                                <p>or</p>
                                <div class="wrap-btn clearfix">
                                    <a href="#" class="btn-event" data-from="50">$50</a>
                                    <a href="#" class="btn-event" data-from="100">$100</a>
                                    <a href="#" class="btn-event" data-from="200">$200</a>
                                    <div class="btn-event-ot"><span>Other $</span><input type="number" class="btn-event-other"></div>
                                </div>
                                <div class="clearfix donation-purpose">
                                    <p>Donation Purpose:</p>
                                    <input type="radio" id="p1" name="purpose" value="Annual Fund" required><label for="p1">Annual Fund</label><br>
                                    <input type="radio" id="p2" name="purpose" value="Auction" required><label for="p2">Auction</label><br>
                                    <input type="radio" id="p3" name="purpose" value="Other" required><input type="text" name="purpose_other" placeholder="Other&hellip;"><br>
                                </div>
                                <div class="large-section clearfix">
                                    <div class="wrap-img"><img src="<?php echo CFS()->get('donate_image'); ?>" /></div>
                                    <div class="text-box">
                                        <?php echo CFS()->get('donate_text'); ?>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" onclick="submitDonateForm()" class="donate-btn"><span>Donate</span></a>
                                <input type="hidden" name="cmd" value="_donations">
                                <input type="hidden" name="custom">
                                <input type="hidden" name="hosted_button_id" value="7975979">
                                <input type="hidden" name="business" value="cbradshaw@sp-academy.org">
                                <input type="hidden" name="no_shipping" value="2">
                                <input type="hidden" name="return" value="<?= home_url('/thank-you/') ?>">
                                <input type="hidden" name="cancel_return" value="<?= home_url('/support/') ?>">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="lc" value="US">
                                <input type="hidden" name="bn" value="PP-DonationsBF">
                            </form>
						</div>
					</div>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-left"></div>
				</div>
			<?php } ?>
			<?php if($post->post_name == 'why-give') { ?>
				<div class="section-32" id="why-give">
					<div class="main-container">
						<div class="long-short-container">
							<?php the_content(); ?>
                            <div class="wrap-img"><img src="<?php echo CFS()->get('why_image'); ?>" alt="Picture" /></div>
                            <div class="text-box">
                                <?php echo CFS()->get('why_left_text'); ?>
                            </div>
                            <div class="clear"></div>
                            <?php echo CFS()->get('why_bottom_text'); ?>
						</div>
					</div>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-right"></div>
				</div>
			<?php } ?>
			<?php if($post->post_name == 'passive-fundraising') { ?>
				<div class="section-32" id="passive-fundraising">
					<div class="main-container">
						<div class="short-container">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-left"></div>
				</div>
			<?php } ?>
			<?php if($post->post_name == 'volunteer') { ?>
				<div class="section-32" id="volunteer">
					<div class="main-container">
						<div class="short-container">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="wrap-transform-line"><hr class="transform-line transform-line-right"></div>
				</div>
				<?php } ?>
				<?php if($post->post_name == 'annual-auction') { ?>
				<div class="section-32" id="annual-auction">
					<div class="main-container">
						<div class="short-container">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>
