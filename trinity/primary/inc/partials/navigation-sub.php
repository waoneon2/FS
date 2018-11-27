<?php
/**
 * Template page sub navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$childs = get_pages( array(
    'child_of'      => get_the_ID(),
    'sort_column'   => 'menu_order',
    'sort_order'    => 'asc',
    'hierarchical'  => 0,
    'parent'        => get_the_ID()
));


// front page secondary blog
if (get_current_blog_id() > 1 && is_front_page()) {
    $childs = get_pages( array(
        'exclude'   => $id,
        'sort_column'   => 'menu_order',
        'sort_order'    => 'asc',
        'hierarchical'  => 0,
        'parent'        => 0
    ));
} ?>

<?php
	$child_filer = $childs;
    foreach ($child_filer as $key => $child) {
        $hide_from_nav = get_post_meta($child->ID, '_np_nav_status', true);
        if ($hide_from_nav == 'hide') {
            unset($childs[$key]);
        }
    }
?>

<?php if ($childs): ?>
    <nav class="sub_nav " aria-label="<?php the_title() ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div class="sub_nav_header">
            <h2 class="sub_nav_title"><?php the_title() ?></h2>
        </div>
        <button class="js-swap js-sub-nav-handle sub_nav_handle" data-swap-target=".sub_nav_list" data-swap-title="In this Section" aria-haspopup="true" aria-expanded="false">
            <span class="sub_nav_handle_label">In this Section</span>
            <span class="sub_nav_handle_icon sub_nav_handle_icon_open">
                <svg class="icon icon_caret_down">
                    <use xlink:href="<?php tric_icon('caret_down') ?>"></use>
                </svg>
            </span>
        </button>
        <div class="js-sub-nav-list sub_nav_list">
            <?php foreach ($childs as $child): ?>
                <div class="sub_nav_item">
                    <a class="sub_nav_link" href="<?php echo get_the_permalink($child->ID) ?>" itemprop="url">
                        <span class="sub_nav_link_label" itemprop="name"><?php echo $child->post_title ?></span>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </nav><!-- .sub_nav -->
<?php endif ?>