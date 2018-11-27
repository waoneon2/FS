<?php
/**
 * Template Name: Directory
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$page_link = fielding_page_link( 'directory', false );

		$page_title = get_field( 'page_title' );

		if ( ! $page_title ) {
			$page_title = get_the_title();
		}

		$active_letter = isset( $_GET['letter'] ) ? $_GET['letter'] : false;
		$active_department  = isset( $_GET['department'] ) ? $_GET['department'] : false;
		$active_query  = isset( $_GET['query'] ) ? $_GET['query'] : false;

		$post_args = array(
			'posts_per_page' => -1,
			'post_type'      => 'directory',
			'orderby'        => 'meta_value',
			'order'          => 'ASC',
			'meta_key'       => 'last_name',
		);

		if ( $active_letter ) {
			$post_args['meta_query'] = array(
				'key'   => 'sort',
				'value' => $active_letter,
			);
		} else if ( $active_department ) {
			$post_args['tax_query'] = array(
				array(
					'taxonomy' => 'directory-departments',
					'field' => 'term_id',
					'terms' => $active_department,
				)
			);
		} else if ( $active_query ) {
			$post_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'     => 'first_name',
					'value'   => $active_query,
					'compare' => 'LIKE',
				),
				array(
					'key'     => 'last_name',
					'value'   => $active_query,
					'compare' => 'LIKE',
				),
				array(
					'key'     => 'suffix_name',
					'value'   => $active_query,
					'compare' => 'LIKE',
				),
				array(
					'key'     => 'title',
					'value'   => $active_query,
					'compare' => 'LIKE',
				),
			);
		}

		$alpha_nav = array();
		foreach ( range( 'a', 'z' ) as $letter ) {
			$check_args = array(
				'posts_per_page' => 1,
				'post_type'      => 'directory',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'meta_key'       => 'last_name',
				'meta_query'     => array(
					'key'   => 'sort',
					'value' => $letter,
				),
			);
			$check = get_posts( $check_args );

			$alpha_nav[$letter] = ( count( $check ) > 0 ) ? "on" : "";
		}

		$people = get_posts( $post_args );

		$departments = get_terms( 'directory-departments', array(
			'hide_empty' => false
		) );
?>
<div class="fs-row breadcrumb_wrap breadcrumb_special">
	<div class="fs-cell breadcrumb_overlay">
		<?php get_template_part( 'layouts/breadcrumb' ); ?>
	</div>
</div>
<article class="directory_header_wrap">
	<div class="people_feature_theme theme_teal">
	<div class="fs-row directory_header">
		<div class="fs-cell">
			<h1 class="heading_1"><?php echo $page_title; ?></h1>
		</div>
	</div>
	</div>
</article>
<div class="page_content_area" id="results">
	<div class="full_width_components">
		<div class="directory_controls_wrap">
			<div class="fs-row">

				<div class="directory_controls">
					<ul class="fs-cell fs-xs-hide fs-sm-hide">
						<li class="directory_controls_all"><a href="<?php echo $page_link; ?>"><span>All</span></a></li>
						<?php
							foreach ( $alpha_nav as $letter => $exists ) :
								$class = ( $active_letter == $letter ) ? "active" : "";
								$link  = $page_link . '?letter=' . $letter;
						?>
						<li>
							<?php if ( $exists != "on" ) : ?>
							<span class="disabled"><?php echo strtoupper( $letter ); ?></span>
							<?php else : ?>
							<a href="<?php echo $link; ?>#results" class="<?php echo $class; ?>"><span><?php echo strtoupper( $letter ); ?></span></a>
							<?php endif; ?>
						</li>
						<?php
							endforeach;
						?>
					</ul>
				</div>
				<?php
					$dropdown_options = array(
						"theme" => "base_dropdown gray_dropdown directory_dropdown",
						"label" => "All",
						"links" => true
					);
				?>
				<div class="fs-cell fs-md-hide fs-lg-hide fs-xl-hide">
					<select class="js-dropdown" data-dropdown-options="<?php fielding_json_attribute( $dropdown_options ); ?>">
						<option value="<?php echo $page_link; ?>">All</option>
						<?php
							foreach ( $alpha_nav as $letter => $exists ) :
								$attr = ( $active_letter == $letter ) ? 'selected="selected"' : "";
								$link = $page_link . '?letter=' . $letter;

								if ( $exists != "on" ) {
									$attr = 'disabled="disabled"';
								}
						?>
						<option value="<?php echo $link; ?>#results" <?php echo $attr; ?>><?php echo strtoupper( $letter ); ?></option>
						<?php
							endforeach;
						?>
					</select>
				</div>
				<?php
					$dropdown_options = array(
						"theme" => "base_dropdown gray_dropdown directory_dropdown",
						"label" => "Filter by Department",
						"links" => true
					);
				?>
				<div class="fs-cell fs-xs-full fs-md-full fs-lg-5">
					<select class="js-dropdown" data-dropdown-options="<?php fielding_json_attribute( $dropdown_options ); ?>">
						<option value="<?php echo $page_link; ?>">All</option>
						<?php
							foreach ( $departments as $department ) :
								$attr = ( $active_department == $department->term_id ) ? 'selected="selected"' : "";
								$link = $page_link . '?department=' . $department->term_id;
						?>
						<option value="<?php echo $link; ?>#results" <?php echo $attr; ?>><?php echo $department->name; ?></option>
						<?php
							endforeach;
						?>
					</select>
				</div>
				<div class="fs-cell-right fs-xs-full fs-md-full fs-lg-6 directory_search">
					<div class="search_wrap">
						<form action="<?php $page_link; ?>" class="search_form">
							<input type="text" name="query" class="search_input" placeholder="Search by last name, first name or department/school" value="<?php echo $active_query; ?>">
							<button class="search_submit icon_text" type="submit">Search</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="directory_listing_wrap">
			<?php
				if ( array_filter( $people ) ) :
					foreach ( $people as $person ) :
						$first_name = get_field( 'first_name', $person->ID );
						$last_name  = get_field( 'last_name', $person->ID );
						$suffix     = get_field( 'suffix', $person->ID );
						$title      = get_field( 'title', $person->ID );
						$phone      = get_field( 'phone', $person->ID );
						$email      = get_field( 'email', $person->ID );

						$departments = get_the_terms( $person->ID, 'directory-departments' );
						$depts = array();
						foreach ( $departments as $department ) {
							$depts[] = $department->name;
						}
			?>
			<div class="fs-row directory_listing">
				<div class="fs-cell fs-lg-full">
					<h2><?php echo $last_name; ?>, <?php echo $first_name; ?><?php if ( $suffix ) echo "," . $suffix; ?></h2>
					<h5><?php echo $title; ?></h5>
				</div>
				<div class="fs-cell fs-xs-full fs-sm-full fs-md-full fs-lg-5">
					<p><?php echo implode( ",", $depts ); ?></p>
				</div>
				<div class="fs-cell fs-xs-full fs-sm-full fs-md-full fs-lg-4">
					<?php
						if ( $phone && array_filter( $phone ) ) :
							$i = 0;
							foreach ( $phone as $p ) :
								$class = ( 0 == $i ) ? "ico_phone" : "dark_link";
					?>
					<a href="tel:<?php echo $p["phone"]; ?>" class="<?php echo $class; ?>"><?php echo $p["phone"]; ?></a>
					<?php
								$i++;
							endforeach;
						endif;
					?>
				</div>
				<div class="fs-cell fs-xs-full fs-sm-full fs-md-full fs-lg-3">
					<?php
						if ( $email && array_filter( $email ) ) :
							$i = 0;
							foreach ( $email as $e ) :
								$class = ( 0 == $i ) ? "ico_mail" : "dark_link";
					?>
					<a href="mailto:<?php echo $e["email"]; ?>" class="<?php echo $class; ?>"><?php echo $e["email"]; ?></a>
					<?php
								$i++;
							endforeach;
						endif;
					?>
				</div>
			</div>
			<?php
					endforeach;
				else :
			?>
			<div class="fs-row">
				<div class="fs-cell typography margined_lg_bottom">
					<p class="no_results">Sorry, no people found.</p>
				</div>
			</div>
			<?php
				endif;
			?>
		</div>
	</div>
</div>
<?php
	endwhile;
endif;

get_footer();