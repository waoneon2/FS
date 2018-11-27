<?php
/**
 * Template Breadcrumb
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

function tric_hidden_page() {
	$hide_pages = get_pages(array(
        'post_type' 	=> 'page',
        'hierarchical' 	=> 0,
        'meta_key'	 	=>'_np_nav_status',
        'meta_value' 	=>'hide'
    ));

    $hide_page_id_list = [];
    foreach ($hide_pages as $key => $hide_page) {
    	$hide_page_id_list[] = $hide_page->ID;
    }

    return $hide_page_id_list;
}

function tric_breadcrumbs_part($label, $loop, $id = '', $parent = '', $current_link = '') {
	global $post;

    $frontpage_id = get_option( 'page_on_front' );
    $siblings = [];

    if ($id !== '' && $parent !== '') {
        $siblings = get_pages(array(
            'exclude'   => implode(',', tric_hidden_page()),
            'parent'    => $parent,
            'post_type' => 'page',
            'sort_column' 	=> 'menu_order'
        ));
    }

    if ($id && $id != 'id') {
    	$current_page = get_page($id);
    	$current_link = get_permalink($current_page->ID);
    }

    $br = '<div class="breadcrumb_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">';
    		if (!empty($siblings)
    			&& !(is_front_page() && (get_current_blog_id() > 1))
    			) {
            	$br .= '<button class="js-swap breadcrumb_name_switch breadcrumb_name" itemprop="name" data-swap-target=".breadcrumb_dropdown_'.$loop.'" data-swap-group="breadcrumb_dropdown">
                <span class="breadcrumb_name_label">'.$label.'</span>';
            	$br .= '<span class="breadcrumb_name_icon">
            	    <svg class="icon icon_expand">
            	        <use xlink:href="'.tric_icon('expand', false).'"></use>
            	    </svg>
            	</span>';
            	$br .= '</button>';
            } else {
            	$br .= (isset($post) && $post->ID != $id && $id) ?
            	'<a href="'.$current_link.'" class="breadcrumb_name_label">'.$label.'</a>' :
            	'<a class="breadcrumb_name_label">'.$label.'</a>';
            }
            $br .= '<meta itemprop="position" content="'.($loop + 1).'">';

            if (!empty($siblings)) {
                $br .= '<nav class="breadcrumb_dropdown breadcrumb_dropdown_'.$loop.'">';

                    foreach ($siblings as $sibling) {
                        if(empty(get_post_meta($sibling->ID,'_np_nav_status')) || get_post_meta($sibling->ID,'_np_nav_status')[0] != 'hide') {
                        	if ($id == $sibling->ID) {
                        		$br .= (isset($post) && $post->ID != $id) ?
    		                   '<a href="'.$current_link.'" class="breadcrumb_dropdown_item">'.$label.'</a>' :
    		                   '<a class="breadcrumb_dropdown_item">'.$label.'</a>';
                        	} else {
                            	$br .= '<a class="breadcrumb_dropdown_item" href="'.get_permalink($sibling->ID).'">'.$sibling->post_title.'</a>';
                        	}
                        }
                    }
                $br .= '</nav>';
            }
    $br .= '</div>';
    return $br;
}
?>

<?php if ( (!is_home() && !is_front_page() || is_paged())
	|| ( is_front_page() && (get_current_blog_id() > 1) )
): ?>
    <div class="breadcrumb_nav_wrapper">
        <div class="fs-row">
            <div class="fs-cell fs-xl-10 fs-xl-push-1">
                <div class="breadcrumb_nav_inner">

                    <div class="breadcrumb_nav">
                        <div class="breadcrumb_list" itemscope itemtype="http://schema.org/BreadcrumbList">

                            <div class="breadcrumb_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                                <a class="breadcrumb_link" href="<?php echo network_site_url() ?>" itemprop="item">
                                    <span class="breadcrumb_name" itemprop="name">
                                        <span class="breadcrumb_name_icon">
                                            <svg class="icon icon_home">
                                                <use xlink:href="<?php tric_icon('home') ?>"></use>
                                            </svg>
                                        </span>
                                        <span class="breadcrumb_name_label_hide">Home</span>
                                    </span>
                                </a>
                                <meta itemprop="position" content="1">
                            </div>

                            <?php

                            /**
                            * Show different breadcrumb base on page type
                            */

                            $loop = 1;
                            // on root page
                            if (is_page() && !$post->post_parent) {
                            	$secondary_homepage = '';

                            	// on secondary site
                            	if ((get_current_blog_id() > 1) && !is_front_page()) {
                            		$loop = 2;
                            		$page_on_front = get_page(get_option( 'page_on_front' ));
                            		$secondary_homepage = tric_breadcrumbs_part($page_on_front->post_title, 1, 'id', '', home_url( '/' ));
                            	}

                            	echo $secondary_homepage;
                                echo tric_breadcrumbs_part($post->post_title, $loop, $post->ID, $post->post_parent);

                            // on child page
                            } elseif ((is_page() && $post->post_parent)) {
                                $loop = 1;
                                $secondary_homepage = '';

                                // on secondary site
                            	if ((get_current_blog_id() > 1) && !is_front_page()) {
                            		$loop = 2;
                            		$page_on_front = get_page(get_option( 'page_on_front' ));
                            		$secondary_homepage = tric_breadcrumbs_part($page_on_front->post_title, 1, 'id', '', home_url( '/' ));
                            	}

                                $parent_id = $post->post_parent;
                                $current_page = $post;
                                $breadcrumbs = array();

                            	echo $secondary_homepage;
                                while ($parent_id) {
                                    $page = get_page($parent_id);
                                    $breadcrumbs[] = tric_breadcrumbs_part(get_the_title($page->ID), $loop, $page->ID, $page->post_parent);
                                    $parent_id = $page->post_parent;
                                    $loop++;
                                }

                                $breadcrumbs = array_reverse($breadcrumbs);
                                foreach ($breadcrumbs as $crumb) {
                                    echo $crumb;
                                }
                                echo tric_breadcrumbs_part(get_the_title(), $loop, $current_page->ID, $current_page->post_parent);

                            // on single custom post type news_post
                            } elseif (is_singular( 'news_post' )) {
                                echo tric_breadcrumbs_part('News', 1, 'id', '', home_url( '/news' ));
                                echo tric_breadcrumbs_part(get_the_title(), 2);

                            // on archive
                            } elseif (is_archive()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part($cpt->label, 1);

                            // on 404
                            } elseif (is_404()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part('404', 1);

                            // on search
                            } elseif (is_search()) {
                                $cpt = get_queried_object();
                                echo tric_breadcrumbs_part('Search', 1);
                            }

                             ?>

                        </div>
                    </div> <!-- .breadcrumb_nav -->

                </div>
            </div>
        </div>
    </div>
 <?php endif ?>
