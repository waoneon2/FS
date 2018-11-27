<?php
$pages = get_posts(array(
	'post_type'  => 'page',
	'meta_key'   => '_wp_page_template',
	'meta_value' => 'page-events.php'
));

$opost = $post;
$post = $pages[0];

get_template_part( 'layouts/callouts', 'sidebar' );

$post = $opost;