<?php
class tric_walker_nav_menu extends Walker {
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	private $inc = 1;

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth+1);
		if ($depth == 0) {
			$output .= "\t\n$indent\t<div class=\"js-main-nav-children main_nav_children\">\n";
			$output .= "<!--$depth-->";
		}
	}
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth+1);
		if ($depth == 0) {
			$output .= "$indent\t</div>\n";
		}
	}
	function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
		$class_names = $value = '';
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		if (in_array( 'menu-item-has-children', $classes )) {
			$classes[] = 'main_nav_has_children';
		}
		if ($depth == 0) {
			$classes[] = 'js-main-nav-item-'.$this->inc.' main_nav_item';
			$jsmain = '.js-main-nav-item-'.$this->inc;
			$this->inc++;
		}
		$classes[] = in_array( 'current-menu-item', $classes ) ? 'current-menu-item' : '';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

		$class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', '', $object, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= "\n$indent\t" .'<div' . $id . $value . $class_names .'>'."\n\t$indent\t";
		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

		if(isset($args->before)):
		$object_output = $args->before;

		if ($depth == 0) {
			$object_output .= '<div class="main_nav_item_wrapper">
			    <a class="main_nav_link" '. $attributes .' itemprop="url" aria-haspopup="true" aria-expanded="false">
			        <span class="main_nav_link_label" itemprop="name">
			        	'. $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after .'
			        </span>
			    </a>';
			    if (in_array( 'menu-item-has-children', $classes )) {
			    	$object_output .= '<button class="js-swap js-main-nav-toggle main_nav_toggle" data-swap-target="'. $jsmain .'" data-swap-group="main_nav">
			    	    <span class="main_nav_toggle_label">Expand Navigation</span>
			    	    <span class="main_nav_toggle_icon">
			    	        <svg class="icon icon_caret_down">
			    	            <use xlink:href="'. tric_icon('caret_down', false) .'"></use>
			    	        </svg>
			    	    </span>
			    	</button>';
			    }
			$object_output .= '</div>';
		} else if ($depth == 1) {
		    $object_output .= '<div class="main_nav_child_item">
			    <a class="main_nav_child_link" '. $attributes .' itemprop="url">
			        <span class="main_nav_child_link_label" itemprop="name">
			        	'. $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after .'
			        </span>
			    </a>
			</div>';
		}

		$object_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		endif;

		if ($depth == 0) $this->inc++;
	}
	function end_el(&$output, $object, $depth = 0, $args = array()) {
		$output .= "</div>\n";
	}
}