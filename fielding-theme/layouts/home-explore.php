<?php
$label   = get_field( 'explore_label' );
$heading = get_field( 'explore_heading' );
$media   = get_field( 'explore_media' );
$quotes  = get_field( 'explore_quotes' );
$facts   = get_field( 'explore_facts' );
$news    = get_field( 'explore_news' );

$theme_dir = get_template_directory();

$carousel_options = array(
	"theme" => "combo_pager",
	"contained" => false,
	"maxWidth"	=> "739px",
	"matchHeight" => true,
);

$equalize_options = array(
	"target" => ".js-equalize_child",
);
?>
<article class="discover_wrap margined_lg">
	<div class="fs-row">
		<div class="fs-cell fs-all-full">
			<h2 class="media_carousel_label"><?php echo $label; ?></h2>
			<h3 class="media_carousel_heading"><?php echo $heading; ?></h3>
		</div>
	</div>
	<div class="fs-row">
		<div class="js-carousel js-equalize discover_carousel clearfix" data-carousel-options="<?php fielding_json_attribute( $carousel_options ); ?>"  data-equalize-options="<?php fielding_json_attribute( $equalize_options ); ?>">
			<?php
				// Media 1
				$item = $media[0];
				include $theme_dir . "/layouts/partial/home-explore-" . $item["type"] . ".php";

				// News 1
				$item = $news;
				include $theme_dir . "/layouts/partial/home-explore-news.php";

				// Quote 1
				$item = $quotes[0];
				$item["size"]  = "fs-lg-6";
				$item["color"] = "red";
				$item["class"] = "js-equalize_child";
				include $theme_dir . "/layouts/partial/home-explore-quote.php";

				// Fact 1
				$item = $facts[0];
				include $theme_dir . "/layouts/partial/home-explore-fact.php";

				// Fact 2
				$item = $facts[1];
				include $theme_dir . "/layouts/partial/home-explore-fact.php";

				// Quote 2
				$item = $quotes[1];
				$item["size"]  = "fs-lg-4";
				$item["color"] = "gray";
				include $theme_dir . "/layouts/partial/home-explore-quote.php";

				// Media 2
				$item = $media[1];
				include $theme_dir . "/layouts/partial/home-explore-" . $item["type"] . ".php";
			?>
		</div>
	</div>
</article>