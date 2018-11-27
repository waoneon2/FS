<?php

/* ==========================================================================
	Don't Cache
============================================================================= */

function fielding_dont_cache() {
	define('DONOTCACHEPAGE', 1);
}

/* ==========================================================================
	Include Diectory
============================================================================= */

function fielding_include_all( $dir = false ) {
	if ( is_dir( $dir ) ) {
		foreach ( glob( $dir . '/*.php' ) as $filename ) {
			include_once $filename;
		}
	}
}

/* ==========================================================================
	JSON Attribute
============================================================================= */

function fielding_json_attribute( $data, $echo = true ) {
	if ( is_array( $data ) ) {
		$data = json_encode( $data );
	}

	$data = htmlspecialchars( $data );

	if ( $echo ) {
		echo $data;
	} else {
		return $data;
	}
}

/* ==========================================================================
	Margin
============================================================================= */

function fielding_margin( $margin = '', $default = '', $echo = true ) {
	if ( is_array( $margin ) ) {
		$margin = '';
	}

	if ( 'none' == $margin ) {
		$margin = '';
	} else {
		$margin = "margined_" . ( ( ! $margin ) ? $default : $margin );
	}

	if ( $echo ) {
		echo $margin;
	} else {
		return $margin;
	}
}

/* ==========================================================================
	Admin Sync Page
============================================================================= */

function fielding_admin_sync_page( $title = '', $action = '' ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	?>
	<div class="wrap">
		<h2><?php echo $title; ?></h2>
		<p id="sync-output" data-action="<?php echo $action; ?>" style="line-height: 16px;">
			<img src="<?php echo get_site_url(); ?>/wp-admin/images/wpspin_light.gif" alt="" style="vertical-align: middle; margin: 0 5px 0 0;"> Synchronizing...
		</p>
	</div>
	<?php
}

/* ==========================================================================
	Menus
============================================================================= */

function fielding_menu( $location, $depth = 1, $display = false, $walker = false, $echo = true ) {
	if ( ! $location || ! has_nav_menu( $location ) ) {
		return;
	}

	$args = array(
		'theme_location' => $location,
		'container'      => false,
		'echo'           => 0,
	);

	if ( $depth ) {
		$args['depth'] = $depth;
	}

	if ( $display ) {
		$args['display'] = $display;
	}

	if ( $walker ) {
		$args['walker'] = $walker;
	}

	if ($echo) {
		echo wp_nav_menu( $args );
	} else {
		return wp_nav_menu( $args );
	}
}

/* ==========================================================================
	Menu Items
============================================================================= */

function fielding_get_menu_items( $location, $depth = 1, $display = false ) {
	$locations = get_nav_menu_locations();

	if ( has_nav_menu( $location ) ) {
		return wp_get_nav_menu_items( $locations[ $location ], array(
			'order'   => 'ASC',
			'orderby' => 'menu_order',
		) );
	} else {
		return false;
	}
}

/* ==========================================================================
	Menu Children
============================================================================= */

function fielding_get_menu_children( $parent_id, $menu_items ) {
	$new_menu = array();

	foreach ( (array) $menu_items as $menu_item ) {
		if ( $menu_item->menu_item_parent == $parent_id ) {
			$new_menu[] = $menu_item;
		}
	}

	return $new_menu;
}

/* ==========================================================================
	In Menu
============================================================================= */

function fielding_in_menu( $item_id, $menu ) {
	foreach ($menu as $menu_item) {
		if ($menu_item->object_id == $item_id && $menu_item->menu_item_parent == 0) {
			return $menu_item;
		}
	}

	return false;
}

/* ==========================================================================
	In Tree
============================================================================= */

function fielding_in_tree( $pid ) {
	global $post;

	if ( $post ) {

		$ancestors = get_post_ancestors( $post->ID );

		foreach ( $ancestors as $ancestor ) {
			if ( is_page() && $ancestor == $pid ) {
				return true;
			}
		}

		if ( is_page() && is_page($pid) ) {
			return true;
		}
	}

	return false;
}

/* ==========================================================================
	Subnavigation
============================================================================= */

function fielding_subnavigation( $echo = true ) {
	if ($echo) {
		fielding_menu( 'main_nav', false, 'subnavigation' );
	} else {
		return fielding_menu( 'main_nav', false, 'subnavigation', false, false );
	}
}

/* ==========================================================================
	Breadcrumb
============================================================================= */

function fielding_breadcrumb() {
	fielding_menu( 'main_nav', false, 'breadcrumb', new Fielding_Breadcrumb_Walker() );
}

/* ==========================================================================
	Page In Menu
============================================================================= */

function fielding_page_in_menu( $menu = false, $object_id = false ) {
	$menu_object = wp_get_nav_menu_items( $menu );

	if( ! $menu_object ) {
		return false;
	}

	$menu_items = wp_list_pluck( $menu_object, 'object_id' );

	if( ! $object_id ) {
		global $post;
		$object_id = get_queried_object_id();
	}

	return in_array( (int) $object_id, $menu_items );
}

/* ==========================================================================
	Pagination
============================================================================= */

function fielding_pagination( $query = null ) {
	if ( null === $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	if ( 1 >= $query->max_num_pages ) {
		// return;
	}

	$big = 9999999999;

	$links = paginate_links( array(
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages,
		'type'      => 'list',
		'end_size'  => 0,
		'mid_size'  => 2,
		'next_text' => 'Next',
		'prev_text' => 'Previous',
	) );

	$ouput  = '<div class="fs-row margined_md_bottom">';
	$ouput .= '<div class="fs-cell fs-all-full">';
	$ouput .= '<div class="pagination">';
	$ouput .= $links;
	$ouput .= '</div>';
	$ouput .= '</div>';
	$ouput .= '</div>';

	echo $ouput;
}

/* ==========================================================================
	New window
============================================================================= */

function fielding_new_window( $new_window = false ) {
	echo ($new_window ? ' target="_blank"' : '');
}

/* ==========================================================================
	Page Link
============================================================================= */

function fielding_page_link( $page_id, $echo = true ) {
	global $fielding_page_links;

	$link = isset( $fielding_page_links[ $page_id ] ) ? $fielding_page_links[ $page_id ] : '#';

	if ( $echo ) {
		echo $link;
	} else {
		return $link;
	}
}

/* ==========================================================================
	Placeholder Image
============================================================================= */

function fielding_placeholder_image( $width = 300, $height = 300 ) {
	return apply_filters( 'gga-dynamic-images-image-url', '', $width, $height, 'random' );
}

/* ==========================================================================
	Lightbox Meta
============================================================================= */

function fielding_lightbox_meta( $image = false, $heading = false, $content = false ) {
	if ( ! $image ) {
		return false;
	}

	return array(
		"header"  => array(
			"title"   => $heading,
			"content" => $content
		),
		"title"   => $image['title'],
		"caption" => $image['caption'],
		"image"   => fielding_responsive_image( fielding_image_lightbox_image( $image['id'] ), 'lightbox_image', '', '', false ) // don't echo
	);
}

/* ==========================================================================
	Responsive Image
============================================================================= */

function fielding_responsive_image( $images, $class = '', $img_class = '', $alt = '', $echo = true ) {
	$images = array_reverse( $images );
	$html_all = array();

	foreach ( $images as $media => $image ) {
		if ( 'fallback' !== $media ) {
			$html_all[] = '<source media="' . $media . '" srcset="' . $image . '">';
		} else {
			$fallback = $image;
			$html_all[] = '<source media="(min-width: 0px)" srcset="' . $image . '">';
		}
	}

	$html = '';
	$html .= '<picture class="js-responsive responsive_image ' . $class . '">';
	$html .= '<!--[if IE 9]><video style="display: none;"><![endif]-->';
	$html .= implode( '', $html_all );
	$html .= '<!--[if IE 9]></video><![endif]-->';
	$html .= '<img src="' . $fallback . '" alt="' . $alt . '" class="' . $img_class . '" draggable="false">';
	$html .= '</picture>';

	if ( $echo ) {
		echo $html;
	} else {
		return $html;
	}
}

/* ==========================================================================
	Trim Length (alternative to wp_trim_words; from BigTree CMS)
============================================================================= */

function fielding_trim_length( $string, $length ) {
	$ns = '';
	$opentags = array();
	$string = trim( $string );
	if ( strlen( html_entity_decode( strip_tags( $string ) ) ) < $length ) {
		return $string;
	}
	if ( strpos( $string,' ' ) === false && strlen( html_entity_decode( strip_tags( $string ) ) ) > $length ) {
		return substr( $string,0,$length ).'&hellip;';
	}
	$x = 0;
	$z = 0;
	while ( $z < $length && $x <= strlen( $string ) ) {
		$char = substr( $string, $x, 1 );
		$ns .= $char; // Add the character to the new string.
		if ( '<' == $char ) {
			// Get the full tag -- but compensate for bad html to prevent endless loops.
			$tag = '';
			while ( '>' !== $char && false !== $char ) {
				$x++;
				$char = substr( $string, $x, 1 );
				$tag .= $char;
			}
			$ns .= $tag;

			$tagexp = explode( ' ',trim( $tag ) );
			$tagname = str_replace( '>','',$tagexp[0] );

			// If it's a self contained <br /> tag or similar, don't add it to open tags.
			if ( '/' != $tagexp[1] && '/>' != $tagexp[1] ) {
				// See if we're opening or closing a tag.
				if ( substr( $tagname,0,1 ) == '/' ) {
					$tagname = str_replace( '/','',$tagname );
					// We're closing the tag. Kill the most recently opened aspect of the tag.
					$done = false;
					reset( $opentags );
					while ( current( $opentags ) && ! $done ) {
						if ( current( $opentags ) == $tagname ) {
							unset( $opentags[ key( $opentags ) ] );
							$done = true;
						}
						next( $opentags );
					}
				} else {
					// Open a new tag.
					$opentags[] = $tagname;
				}
			}
		} elseif ( '&' == $char ) {
			$entity = '';
			while ( ';' != $char && ' ' != $char && '<' != $char ) {
				$x++;
				$char = substr( $string,$x,1 );
				$entity .= $char;
			}
			if ( ';' == $char ) {
				$z++;
				$ns .= $entity;
			} elseif ( ' ' == $char ) {
				$z += strlen( $entity );
				$ns .= $entity;
			} else {
				$z += strlen( $entity );
				$ns .= substr( $entity,0,-1 );
				$x -= 2;
			}
		} else {
			$z++;
		}
		$x++;
	}
	while ( $x < strlen( $string ) && ! in_array( substr( $string,$x,1 ),array( ' ', '!', '.', ',', '<', '&' ) ) ) {
		$ns .= substr( $string,$x,1 );
		$x++;
	}
	if ( strlen( strip_tags( $ns ) ) < strlen( strip_tags( $string ) ) ) {
		$ns .= '&hellip;';
	}
	$opentags = array_reverse( $opentags );
	foreach ( $opentags as $key => $val ) {
		$ns .= '</'.$val.'>';
	}
	return $ns;
}

/* ==========================================================================
	Array Search
============================================================================= */

function fielding_array_search( $array, $key, $value ) {
	$results = array();

	if ( is_array( $array ) ) {
		if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {
			$results[] = $array;
		}

		foreach ( $array as $subarray ) {
			$results = array_merge( $results, fielding_array_search( $subarray, $key, $value ) );
		}
	}

	return $results;
}

/* ==========================================================================
	Strip Emoji
============================================================================= */

function fielding_strip_emoji( $text ) {
	$cleanText = "";

	// Match Emoticons
	$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	$cleanText = preg_replace($regexEmoticons, '', $text);

	// Match Miscellaneous Symbols and Pictographs
	$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	$cleanText = preg_replace($regexSymbols, '', $cleanText);

	// Match Transport And Map Symbols
	$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	$cleanText = preg_replace($regexTransport, '', $cleanText);

	return $cleanText;
}