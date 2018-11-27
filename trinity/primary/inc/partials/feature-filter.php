<?php
/**
 * Template for Filter Feature
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trinity_College
 */

$term_tax   = get_terms( array(
    'taxonomy' => 'news-category' ,
    'hide_empty' => false,
) );
$featureFilterSearch = isset($_GET['fsearch']) && $_GET['fsearch'] ? $_GET['fsearch'] : '';
$featureFilterCategory = isset($_GET['fcat']) && $_GET['fcat'] ? $_GET['fcat'] : '';
if(!empty($featureFilterCategory)) {
	$tmp = array_map(function($e) {
		return $e->name;
	}, array_filter($term_tax, function($e,$i) use($featureFilterCategory) {
		return $e->slug == $featureFilterCategory;
	}, ARRAY_FILTER_USE_BOTH));
}
$featureFilterDefaultCategory = isset($tmp) && !empty($tmp) ? array_shift($tmp) : 'View By Category';
?>

    <div class="filter">
        <div class="fs-row">
            <div class="fs-cell fs-xl-10 fs-all-justify-center">
                <div class="filter_inner">
					<div class="input_wrapper filter_search_input_wrapper">
						<input class="input_field filter_search_input_field" type="search" id="search_by_keyword" placeholder="Search by keyword" value="<?php echo $featureFilterSearch?>">
						<label class="input_label filter_search_input_label">Search by keyword</label>
						<button class="input_submit filter_search_input_submit" type="submit" value="Submit Search" />
					</div>
                    <div class="filter_options_wrapper">
						<button class="js-swap filter_options_swap" data-swap-target=".filter_options">
						    <span class="filter_options_swap_label"><?php echo $featureFilterDefaultCategory; ?></span>
						    <span class="filter_options_swap_icon">
						        <svg class="icon icon_caret_down">
						            <use xlink:href="<?php tric_icon('caret_down') ?>"></use>
						        </svg>
						    </span>
						</button>
		                <div class="filter_options">
		                	<a class="filter_option news-filter-option" href="#" tabindex="0">View All</a>
	                        <?php foreach ($term_tax as $term): ?>
	                            <a class="filter_option news-filter-option" href="#" tabindex="0" data-filter-option-value="<?php echo $term->slug;?>">
	                            	<?php echo $term->name;?>
	                            </a>
	                        <?php endforeach ?>
		                </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .filter -->
