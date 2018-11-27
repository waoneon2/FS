<?php
/**
 * Template Name: Search
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

get_header();

$args = [
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'search.php'
];
$pages 	= get_posts( $args );
$post 	= $pages[0];

if ($post):	setup_postdata( $post ); ?>
	<div class="page_feature"></div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="page_header">
			<div class="page_header_inner">
				<div class="fs-row">
				    <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
						<div class="page_header_body">
							<h1 class="page_title">Search Results</h1>
						</div>
					 </div>
				</div>
			</div>
			<?php //get_template_part( 'inc/partials/feature', 'search' ); ?>
			<div class="search_field_block">
				<div class="fs-row">
					<div class="fs-cell fs-xl-10 fs-all-justify-center">
						<div class="search_field_inner">
							<div class="site_search site_search_results" id="site_search_results" itemscope="" itemtype="http://schema.org/WebSite" role="search">
								<meta itemprop="url" content="http://http://www.trincoll.edu/Pages/default.aspx">
								<meta itemprop="target" content="http://http://www.trincoll.edu/Pages/default.aspx/static/templates/page-search.html?q={search_term_string_results}">
									<?php if (get_field('google_cse_id')): ?>
										<div class="trinity-google-custom-search">
											<gcse:searchbox gname="storesearch"></gcse:searchbox>
										</div>
									<?php else: ?>
										<form class="site_search_form" action="" id="cse-search-box" method="get">
											<label class="site_search_label" for="search_term_string_results">Search</label>
											<input aria-live="polite" class="site_search_input" itemprop="query-input" type="search" id="search_term_string_results"  placeholder="Search" name="search_input">
											<button class="site_search_button" type="submit" title="submit" aria-label="submit">
												<span class="site_search_button_label">submit</span>
												<span class="site_search_button_icon">
													<svg class="icon icon_search">
														<use xlink:href="<?php tric_icon('search') ?>"></use>
													</svg>
												</span>
											</button>
										</form>
									<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .page_header -->

		<div class="page_content">
			<div class="full_width_callouts">
				<?php //get_template_part( 'inc/full-width-components/template', 'search' ); ?>
				<section class="search_results_block site_search_results">
					<div class="fs-row">
						<div class="fs-cell fs-xl-10 fs-all-justify-center">
							<div class="search_results_inner">
								<div class="search_results_body">
									<!-- <p class="search_results_count">About 73,400,000 results (0.60 seconds)</p> -->
									<div class="search_results">
										<?php if (get_field('google_cse_id')): ?>
											<gcse:searchresults gname="storesearch"></gcse:searchresults>
											<!-- <gcse:searchresults gname="storesearch2"></gcse:searchresults> -->
										<?php else: ?>
											<?php if (isset($_GET['search_input'])) :
												$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
												$arg2=array(
													'post_type' => 'news_post',
													'posts_per_page'=>5,
													'paged' => $paged,
													's' => $_GET['search_input']
												);
												$the_query = new WP_Query( $arg2 );
												while (  $the_query->have_posts() ) :  $the_query->the_post(); ?>
                  									<div class="search_result" id="sr">
														<h2 class="search_result_title">
														<a class="search_result_title_link" href="<?php the_permalink();?>">
															<strong><?php the_title();?></strong>
														</a>
														</h2>
														<a class="search_result_link" href="<?php the_permalink();?>">
														<?php esc_url( get_permalink() ); ?>
														</a>
														<div class="search_result_caption">
															<p>
																<?php the_content(); ?>
															</p>
														</div>
													</div>
          										<?php endwhile ?>
          									<?php endif ?>
											<?php the_posts_navigation();?>
										<?php endif ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div><!--.page_content-->

	</div><!-- #post-<?php the_ID(); ?> -->
<?php endif ?>

<?php get_footer(); ?>


