<?php
/**
 * Template Name: Index C
 */
?>
<?php get_header(); ?>
    <!-- Content -->
	<div id="content">
        <div class="video-container">
            <div class="video-section">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="inside-container"><a href="#video" class="img-video popup-modal"><span>&nbsp;</span></a></div>
                    <div id="video" class="mfp-hide white-popup-block">
			<div class="intro-video-wrapper">
                            <button title="Close (Esc)" type="button" class="mfp-close video-close">×</button>
                            <?php the_content(); ?>
                        </div>
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
        <div class="blog-and-events">
            <?php 
            $args_blog = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'cat' => get_cat_ID('Blog')
            );
            $blog = new WP_Query( $args_blog ); ?>

            <?php if ($blog->have_posts()) { ?>
                <?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
                     <div class="blog">
                        <div class="blog__image">
                            <?php the_post_thumbnail('image-blog') ?>
                        </div>
                        <?php $categories = get_the_category(); ?>
                        <span class="blog__category">
                            <?php foreach ($categories as $key => $cat) { ?>
                                <?php echo $key > 0 ? ', ' : '' ?>
                                <a href="<?php echo get_term_link($cat, $cat->taxonomy) ;?>" rel="category tag"><?php echo $cat->name ?></a>
                            <?php } ?>
                        </span>
                        <span class="blog__title">
                            <a href="<?php the_permalink() ?>"><?php the_title( ) ?></a>
                        </span>
                     </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?> 
            <?php } ?>
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
                                        <?php echo ($school['desc_header_school_block']) ?
                                        '<h6 class="header-school-desc">'.$school['desc_header_school_block'].'</h6>' : '' ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>

		</div>
        <?php
        global $post; $backup = $post; //store postdata of main page to backup variable
        $args_news = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'cat' => get_cat_ID('News'),
            'orderby' => 'meta_value',
            'meta_key'  => 'new_expiration_date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'     => 'new_expiration_date',
                    'value'   => date("Y-m-j"),
                    'compare' => '>=',
                    'type' => 'DATE',
                ),
            ),
        );
        $args_event = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'cat' => get_cat_ID('Event'),
            'orderby' => 'meta_value',
            'meta_key'  => 'expiration_date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'     => 'expiration_date',
                    'value'   => date("Y-m-j"),
                    'compare' => '>=',
                    'type' => 'DATE',
                ),
            ),
        );
        $news = new WP_Query( $args_news );
        ?>

		<div class="section-2c main-container">
    		<?php while ( $news->have_posts() ) : $news->the_post(); ?>
                <?php //if (time() < strtotime(CFS()->get('new_expiration_date')) || (! CFS()->get('new_expiration_date'))): ?>
                    <div class="left-box animated" data-animateFunction="fadeInLeft">
                        <div class="text-box">
                            <div class="cat-title">News</div>
                            <h3><?php echo $post->post_title ?></h3>
                            <p><?php echo CFS()->get('excerpt') ?></p>
                            <div>
                            </div>
                            <?php if (null != CFS()->get('call_to_action') && null != CFS()->get('call_to_action_link')): ?>
                                 <a href="<?php echo CFS()->get('call_to_action_link') ?>" class="learn-more-btn animated step-4 fadeIn" style="margin-right:10px;">
                                    <span><?php echo CFS()->get('call_to_action') ?></span>
                                </a>
                            <?php endif ?>
                            <?php if (null != CFS()->get('call_to_action_2nd') && null != CFS()->get('call_to_action_2nd_link')): ?>
                                <a href="<?php echo CFS()->get('call_to_action_2nd_link') ?>" class="learn-more-btn animated step-4 fadeIn">
                                    <span><?php echo CFS()->get('call_to_action_2nd') ?></span>
                                </a>
                            <?php endif ?>
                        </div>
                        <div class="img-box">
                            <?php the_post_thumbnail('image-blog'); ?>
                        </div>
                    </div>
                <?php //endif; ?>
            <?php endwhile; ?>

            <?php $event = new WP_Query( $args_event ); ?>
            <?php while ( $event->have_posts() ) : $event->the_post(); ?>
                <?php //if (time() < $expiration_date || (! CFS()->get('event_expiration_date'))): ?>
                    <div class="right-box animated" data-animateFunction="fadeInRight">
                        <div class="img-box">
                            <?php the_post_thumbnail('image-blog'); ?>
                        </div>
                        <div class="text-box">
                            <div class="cat-title">Event</div>
                            <h3><?php echo $post->post_title ?></h3>
                            <ul class="cat-meta">
                                <li>Date | <span><?php echo date_i18n( get_option( 'date_format' ), strtotime( CFS()->get('date')) ); ?></span></li>
                                <li>Location | <span><?php echo CFS()->get('location');?></span></li>
                                <li>Time | <span><?php echo CFS()->get('time');?></span></li>
                                <?php if ( CFS()->get('price') ): ?><li>Price | <span><?php echo CFS()->get('price');?></span></li><?php endif; ?>
                            </ul>
                            <?php if (null != CFS()->get('event_call_to_action') && null != CFS()->get('event_call_to_action_link')): ?>
                                <a href="<?php echo CFS()->get('event_call_to_action_link') ?>" class="learn-more-btn animated step-4 fadeIn">
                                    <span><?php echo CFS()->get('event_call_to_action') ?></span>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php //endif; ?>
            <?php endwhile; $post = $backup; // retrive main page backup postdata ?>


		</div>
		<div class="section-3">
			<hr class="transform-line transform-line-left">
			<div class="main-container">
				<h3 class="animated" data-animateFunction="fadeIn">Distinctive Attributes</h3>
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
