<?php
/**
 * Template Name: 404
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Trinity_College
 */

get_header();
if(is_multisite()){
    $c_blog_id = get_current_blog_id();
    if($c_blog_id > 1){
        switch_to_blog(1);
        $args = [
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => '404.php'
        ];
        $pages  = get_posts( $args );
        $post   = $pages[0];
        restore_current_blog();
    } else {
        $args = [
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => '404.php'
        ];
        $pages  = get_posts( $args );
        $post   = $pages[0];
    }
}
else {
    $args = [
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => '404.php'
    ];
    $pages  = get_posts( $args );
    $post   = $pages[0];
}

if ($post):
    setup_postdata( $post );  ?>
    <div class="page_feature"></div>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="page_header">
            <?php if(get_current_blog_id() > 1): ?>
                <?php switch_to_blog(1); if (get_field('header_image')): ?>
                    <div class="js-background page_background" data-background-options='{"source": {
	                    "0px": "<?php tric_image(get_field('header_image'),'740x555') ?>",
	                    "500px": "<?php tric_image(get_field('header_image'),'980x552') ?>",
	                    "980px": "<?php tric_image(get_field('header_image'),'1220x686') ?>",
	                    "1220px": "<?php tric_image(get_field('header_image'),'1440x617') ?>"
                    }}'></div>
                <?php endif; restore_current_blog();?>
            <?php else: ?>
                <?php if (get_field('header_image')): ?>
                    <div class="js-background page_background" data-background-options='{"source": {
	                    "0px": "<?php tric_image(get_field('header_image'),'740x555') ?>",
	                    "500px": "<?php tric_image(get_field('header_image'),'980x552') ?>",
	                    "980px": "<?php tric_image(get_field('header_image'),'1220x686') ?>",
	                    "1220px": "<?php tric_image(get_field('header_image'),'1440x617') ?>"
                    }}'></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="page_header_inner">
                <div class="fs-row">
                    <!-- Main Content -->
                     <div class="fs-cell fs-lg-11 fs-xl-10 fs-xl-push-1 content_wrapper">
                        <div class="page_header_body">
                            <?php if(get_current_blog_id() > 1): ?>
                                <?php switch_to_blog(1); ?>
                                <h1 class="page_title"><?php the_field('page_title') ?></h1>
                                <p class="page_intro"><?php the_field('introduction_paragraph') ?></p>
                                <?php restore_current_blog(); ?>
                            <?php else: ?>
                                <h1 class="page_title"><?php the_field('page_title') ?></h1>
                                <p class="page_intro"><?php the_field('introduction_paragraph') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

                <div class="search_field_block">
                    <div class="fs-row">
                        <div class="fs-cell fs-xl-10 fs-all-justify-center">
                            <div class="search_field_inner">
                                <div class="site_search site_search_results" id="site_search_results" itemscope="" itemtype="http://schema.org/WebSite" role="search">
                                    <meta itemprop="url" content="http://www.trincoll.edu">
                                    <meta itemprop="target" content="http://www.trincoll.edu/Pages/default.aspx/static/templates/page-search.html?q={search_term_string_results}">
                                    <?php if(get_current_blog_id() > 1): ?>
                                        <?php switch_to_blog(1); ?>
                                        <?php if (!empty(get_field('google_cse_id'))): ?>
                                            <gcse:searchbox gname="storesearch3"></gcse:searchbox>
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
                                        <?php restore_current_blog(); ?>
                                    <?php else: ?>
                                        <?php if (!empty(get_field('google_cse_id'))): ?>
                                            <gcse:searchbox gname="storesearch3"></gcse:searchbox>
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
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="basic_list">
                <div class="fs-row">
                    <div class="fs-cell fs-xl-10 fs-all-justify-center">
                        <nav class="basic_list_nav">
                        	<?php if (get_field('links')): ?>
	                            <?php if(get_current_blog_id() > 1): ?>
	                                <?php switch_to_blog(1); ?>
	                                <?php foreach (get_field('links') as $link): ?>
	                                    <a class="basic_list_link" target="_blank" href="<?php echo $link['url'] ?>">
	                                        <span class="basic_list_link_label"><?php echo $link['title'] ?></span>
	                                        <span class="basic_list_link_icon" aria-hidden="true">
	                                            <svg class="icon icon_arrow_right">
	                                                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
	                                            </svg>
	                                        </span>
	                                    </a>
	                                <?php endforeach; ?>
	                                <?php restore_current_blog(); ?>
	                            <?php else: ?>
	                                <?php foreach (get_field('links') as $link): ?>
	                                    <a class="basic_list_link" target="_blank" href="<?php echo $link['url'] ?>">
	                                        <span class="basic_list_link_label"><?php echo $link['title'] ?></span>
	                                        <span class="basic_list_link_icon" aria-hidden="true">
	                                            <svg class="icon icon_arrow_right">
	                                                <use xlink:href="<?php tric_icon('arrow_right') ?>"></use>
	                                            </svg>
	                                        </span>
	                                    </a>
	                                <?php endforeach; ?>
	                            <?php endif ?>
                        	<?php endif ?>
                        </nav>
                    </div>
                </div>
            </div><!-- .basic_list -->

        </div><!-- .page_header -->

        <!-- .content -->
        <div class="page_content">
                <div class="full_width_callouts">
                    <?php //get_template_part( 'inc/full-width-components/template', 'search' ); ?>
                    <section class="site_search_results">
                        <div class="fs-row">
                            <div class="fs-cell fs-xl-10 fs-all-justify-center">
                                <div class="search_results_inner">
                                    <div class="search_results_body">
                                        <!-- <p class="search_results_count">About 73,400,000 results (0.60 seconds)</p> -->
                                        <div class="search_results">
                                            <?php if(get_current_blog_id() > 1): ?>
                                                <?php switch_to_blog(1); ?>
                                                <?php if (!empty(get_field('google_cse_id'))): ?>
                                                    <gcse:searchresults gname="storesearch3"></gcse:searchresults>
                                                <?php endif; ?>
                                                <?php restore_current_blog(); ?>
                                            <?php else: ?>
                                                <?php if (!empty(get_field('google_cse_id'))): ?>
                                                    <gcse:searchresults gname="storesearch3"></gcse:searchresults>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div><!--.page_content-->

    </div><!-- #post-<?php //the_ID(); ?> -->
<?php endif ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
