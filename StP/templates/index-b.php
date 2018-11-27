<?php
/**
 * Template Name: Index B
 */
?>
<?php get_header('b'); ?>
    <!-- Content -->
	<div id="content">
        <div class="video-container">
            <div class="video-section">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="inside-container"><a href="#video" class="img-video popup-modal"><span>&nbsp;</span></a></div>
                    <div id="video" class="mfp-hide white-popup-block">
                        <?php the_content(); ?>
                        <button title="Close (Esc)" type="button" class="mfp-close video-close">?</button>
                    </div>
                    <div class="wrap-text-box">
                        <div class="inside-container">
                            <a href="<?php echo CFS()->get('link_in_video_learn_more'); ?>" class="text-box">
                                <div class="left-box">Provide your child with a personalized education they need to excel</div>
                                <div class="right-box">LEARN MORE</div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="section-1 main-container">
            <?php if (CFS()->get('schools') != '') {
                echo CFS()->get('schools');
            } ?>
            <?php if (CFS()->get('schools_block') != null) { ?>
                <div class="wrap-round-box-list">
                    <div class="wrap-box">
                        <ul class="round-box-list clearfix">
                            <?php $schools = CFS()->get('schools_block'); 
                            foreach ( $schools as $school ) { ?>
                                <li class="animated" data-animateFunction="fadeInLeft">
                                    <?php if ( $school['link_school_block'] != ''){ ?>
                                        <a href="<?php echo $school['link_school_block']; ?>">
                                    <?php } else { ?>
                                        <a href="/">
                                    <?php } ?>
                                        <div class="wrap-img"><img src="<?php echo $school['image_school_block']; ?>"></div>
                                        <h6><?php echo $school['header_school_block']; ?></h6>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
			
		</div>		 
		<div class="section-2 main-container">
			<div class="table-box">
				<div class="left-box animated" data-animateFunction="fadeInLeft">
					<?php echo CFS()->get('blockquote'); ?>					
				</div>
				<div class="right-box animated" data-animateFunction="fadeInRight">&nbsp;</div>
			</div>
		</div>	
		<div class="section-3">
			<hr class="transform-line transform-line-left">
			<div class="main-container">
				<h3 class="animated" data-animateFunction="fadeIn">Hallmarks</h3>
			</div>
			<div class="wrap-group-box">
				<div class="main-container">
					<div class="group-box">
						<?php $blocks = CFS()->get('blocks'); ?>
						<?php foreach($blocks as $block) { ?>
							<div class="box">
								<div class="wrap-img"><img src="<?php echo $block['image']; ?>" alt="" /></div>
								<?php echo $block['text']; ?>							
							</div>	
						<?php } ?> 	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
