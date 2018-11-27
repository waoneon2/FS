<?php
$heading  = get_sub_field( 'heading' );
$category = get_sub_field( 'category' );

$news = get_posts(array(
	"posts_per_page" => 3,
    "category"       => $category->term_id,
));

$category_link = get_term_link( $category );

if ( array_filter( $news ) ):
?>
<article class="short_events_wrap margined_lg clearfix">
	<div class="short_events">
		<header class="events_heading clearfix">
			<h2 class="heading_2"><?php echo $heading; ?></h2>
			<a href="<?php echo $category_link; ?>" class="btn btn_gray">View All News</a>
		</header>
		<?php
			$theme_dir = get_template_directory();
			include $theme_dir . "/layouts/partial/news-list.php";
		?>
	</div>
</article>
<?php
endif;