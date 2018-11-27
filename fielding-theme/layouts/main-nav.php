<!-- Custom Nav -->
<?php
	$top_menu  = fielding_get_menu_items( 'top_nav', 1 );
	$main_menu = fielding_get_menu_items( 'main_nav', 3 );
?>
<ul id="menu-main-navigation" class="menu">
	<?php
		foreach ( $top_menu as $top_menu_item ) :
			$main_menu_item = fielding_in_menu( $top_menu_item->object_id, $main_menu );

			if ($main_menu_item) :
				$class    = fielding_in_tree( $top_menu_item->object_id ) ? "current-menu-item" : "";
				$children = fielding_get_menu_children( $main_menu_item->ID, $main_menu );
	?>
	<li id="menu-item-" class="menu-item <?php echo $class; ?>">
		<a rel="page" href="<?php echo get_permalink( $top_menu_item->object_id ); ?>"><?php echo $top_menu_item->title; ?></a>
		<?php
				if ( array_filter( $children ) ) :
		?>
		<ul class="sub-menu">
			<?php
					foreach ( $children as $child_item ) :
						$class = fielding_in_tree( $child_item->object_id ) ? "current-menu-item" : "";
						$link  = ($child_item->object == "custom") ? $child_item->url : get_permalink( $child_item->object_id );
			?>
			<li id="menu-item-" class="menu-item <?php echo $class; ?>">
				<a rel="page" href="<?php echo $link; ?>"><?php echo $child_item->title; ?></a>
			</li>
			<?php
					endforeach;
			?>
		</ul>
		<?php
				endif;
		?>
	</li>
	<?php
			endif;
		endforeach;
	?>
</ul>
<!-- END: Custom Nav -->