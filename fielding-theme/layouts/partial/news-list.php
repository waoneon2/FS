<?php
if ( array_filter( $news ) ):
	$i = 0;
	foreach ( $news as $article ) :
		$image = get_field( 'image', $article->ID );
		$cats  = get_the_category( $article->ID );
?>
<div class="event_listing_wrap">
	<div class="fs-row news_listing">
		<div class="fs-cell fs-sm-2 fs-md-4 fs-lg-9 news_detail">
			<p class="news_date"><?php echo get_the_time( FIELDING_DATE_FORMAT, $article->ID ); ?></p>
			<h3 class="event_title">
				<a href="<?php echo get_the_permalink( $article->ID ); ?>"><?php echo get_the_title( $article->ID ); ?></a>
			</h3>
			<?php if ( array_filter( $cats ) ) : ?>
			<div class="news_categories">
				<span class="tag"></span>
				<?php
					$categories = array();
					foreach ( $cats as $cat ) {
						$categories[] = '<a class="bold_link" href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a>';
					}

					echo implode(', ', $categories);
				?>
			</div>
			<?php endif; ?>
		</div>
		<?php if ( $image ) : ?>
		<div class="fs-cell fs-sm-1 fs-md-2 fs-lg-3 news_image">
			<?php fielding_responsive_image( fielding_image_news_list( $image ) ); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
		$i++;
	endforeach;
else :
?>
<div class="margined_lg_bottom">
	<p class="no_results">Sorry, no articles found.</p>
</div>
<?php
	endif;