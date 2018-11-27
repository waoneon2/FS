<?php

class Fielding_Utility_Nav_Walker extends Walker_Nav_Menu {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    private $inc = 1;

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t<ul>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth+1);
        $output .= "$indent\t</ul>\n";
    }
    function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat( "\t", $depth+1 ) : '';
        $class_names = $value = '';
        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        if (in_array( 'menu-item-has-children', $classes )) {
            $classes[] = 'has-dropdown';
        }

        $classes[] = in_array( 'current-menu-item', $classes ) ? 'current-menu-item' : '';
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object, $args ) );

        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', '', $object, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        if ($depth == 0) {
            $output .= "\n$indent\t" .'<li' . $id . $value . $class_names .'>'."\n\t$indent\t";
        } else {
            $output .= "\n$indent\t" .'<li>'."\n\t$indent\t";  
        }
        $output .= "<!--$depth-->";

        if(isset($args->before)):
            $object_output = $args->before;

            if (in_array( 'menu-item-has-children', $classes ))  {
                $object_output .= '<span>'.
                    $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after .
                '</span>';
            } else {
                $object_output .= '<a' . $attributes .'>'.
                    $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after .
                '</a>';
            }

            $object_output .= $args->after;
        endif;

        $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {
        if ($depth == 0 || $depth == 1) {
            $output .= "</li>\n";
        } else if ($depth == 2 && $this->inc == 1) {
             $output .= "</div>\n";
        } else if ($depth == 3 && $this->inc == 1) {
             $output .= "</li>\n";
        }  
    }

}
