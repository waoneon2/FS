<?php
$navigation_options = array(
	"labels" => array(
		"open"   => "Close",
		"closed" => "Additional Navigation"
	)
);

$navigation = fielding_subnavigation( false );

if ( $navigation != "" ) :
?>
<div class="fs-cell fs-cell-right fs-lg-3">
	<nav class="subnavigation_wrap">
		<h2 class="subnavigation_handle fs-lg-hide">Additional Navigation</h2>
		<div class="subnavigation js-navigation" data-navigation-handle=".subnavigation_handle" data-navigation-options="<?php fielding_json_attribute( $navigation_options ); ?>">
			<?php echo $navigation; ?>
		</div>
	</nav>
</div>
<?php
endif;