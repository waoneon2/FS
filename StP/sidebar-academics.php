<div class="section-19-bottom" style="margin-top:190px;">
	<div class="main-container btn-section">
		<div class="long-short-container schedule-tour-form">
			<?php echo do_shortcode('[contact-form-7 id="287" title="Contact form 1"]'); ?>
			<div class="button-group-delimited clearfix">
				<a href="/apply-now/"><span>More information about applying</span></a>
			</div>
		</div>
	</div>
</div>
<div class="section-19">
	<div class="main-container">
		<div class="bg-box">
			<h5>Explore more of St Paul’s</h5>
				<?php
					$args = array(
						'post_type' => 'academics',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'post__not_in' => array(get_the_ID())
					);
					$academics = query_posts($args);
				?>
			<ul class="list-school-bottom">
				<?php foreach($academics as $academic) { the_post(); ?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="wrap-img">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php } ?>
							<?php $grades = CFS()->get('grades'); ?>
							<div class="box"><div class="title-box"><div class="cell-box"><h6><span><?php the_title(); ?> <?php if(!empty($grades)) { echo '(' . $grades . ')'; } ?></span></h6></div></div></div>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
