<header class="events_heading clearfix">
	<div class="fs-row">
		<div class="fs-cell fs-xs-full fs-sm-full fs-md-half fs-lg-half">
			<?php
				$categories = get_categories();

				$dropdown_options = array(
					"theme" => "base_dropdown gray_dropdown filter_dropdown",
					"label" => "Filter By Category",
					"links" => true
				);
			?>
			<select class="js-dropdown" data-dropdown-options="<?php fielding_json_attribute( $dropdown_options ); ?>">
				<option value="<?php fielding_page_link( 'news_archives' ); ?>">All Categories</option>
				<?php
					foreach ( $categories as $category ) :
				?>
				<option value="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></option>
				<?php
					endforeach;
				?>
			</select>
		</div>
		<div class="fs-cell fs-xs-full fs-sm-full fs-md-half fs-lg-half">
			<div class="search_wrap">
				<form action="<?php fielding_page_link( 'news_archives' ); ?>" class="search_form">
					<input name="s" type="text" class="search_input" placeholder="Search News &amp; Media">
					<button class="search_submit icon_text" type="submit">Search</button>
				</form>
			</div>
		</div>
	</div>
</header>