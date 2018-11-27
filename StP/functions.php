<?php add_theme_support( 'post-thumbnails' );

function theme_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	add_image_size('image-blog', 635, 356);
	add_image_size('image-big', 1110, 650);

	register_nav_menus( array(
		'main' => __( 'Main Menu', 'theme' ),
		'footer' => __( 'Footer Menu', 'theme' ),
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
add_action( 'after_setup_theme', 'theme_setup' );

function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Contact Form', 'theme' ),
		'id'            => 'contact-form',
		'description'   => __( '', 'theme' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div style="display: none;">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

function theme_scripts() {
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/public/lib/jquery-ui/jquery-ui.min.js', array( 'bootstrap' ) );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/public/lib/bootstrap/dist/js/bootstrap.min.js', array( 'slick' ) );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/public/lib/slick/slick.min.js', array( 'matchHeight' ) );
	wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/public/lib/match-height/jquery.matchHeight-min.js', array( 'magnific-popup' ) );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/public/lib/magnific-popup/jquery.magnific-popup.min.js', array( 'skrollr' ) );
	//wp_enqueue_script( 'bootstrap-timepicker', get_template_directory_uri() . '/public/lib/timepicker/bootstrap-timepicker.js', array( 'skrollr' ) );
	wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/public/lib/skrollr/skrollr.min.js', array( 'rangeSlider' ) );
	wp_enqueue_script( 'rangeSlider', get_template_directory_uri() . '/public/lib/ionRangeSlider/ion.rangeSlider.min.js', array( 'fastclick' ) );
	wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/public/lib/fastclick-master/fastclick.js', array( 'main-js' ) );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/public/js/main.js', array( 'jquery' ) );

    wp_enqueue_script( 'highcharts-js', 'https://code.highcharts.com/highcharts.js' );
    wp_enqueue_script( 'highcharts-exporting-js', 'https://code.highcharts.com/modules/exporting.js', array('highcharts-js') );
    wp_enqueue_script( 'charts-js', get_template_directory_uri() . '/public/js/charts.js', array('highcharts-exporting-js') );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function stpaulsacademy_include_admin() {
    if (is_admin()) {
        wp_enqueue_script( 'stp_admin-js', get_template_directory_uri() . '/public/js/stp_admin.js', array( 'jquery' ) );
        wp_enqueue_script( 'stp_admin_replace_media', get_template_directory_uri() . '/public/js/replace-media.js', array( 'jquery' ) );
        $env_streplace =  array(
            'nonce' => wp_create_nonce('stp_admin_replace_media_nonce')
        );
        wp_localize_script( 'stp_admin_replace_media', 'stp_admin_replace_media', $env_streplace );
    }
}
add_action('init', 'stpaulsacademy_include_admin');

function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//sorting post type staff alpabetic asc
function stpaulsacademy_sort_alpha($query) {
  if (is_admin() && $query->query['post_type'] == 'staff') {
  	 $query->set('orderby', 'title');
  	 $query->set('order', 'ASC');
  }
}
add_action('pre_get_posts','stpaulsacademy_sort_alpha');

function stpaulsacademy_add_editor_styles() {
    add_editor_style( 'public/css/custom-editor-style.css' );
}
add_action( 'init', 'stpaulsacademy_add_editor_styles' );

// https://jetpack.com/2013/06/10/moving-sharing-icons/
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );

// Display social share buttons for each post on Conversations landing page
function jptweak_display_share_in_conversation_snippets( $show, $post ) {
	return in_category('blog', $post) ? true : $show;
}
add_filter('sharing_show', 'jptweak_display_share_in_conversation_snippets', 10, 2);

function stpaulsacademy_get_youtube_id($videoUrl) {
    $query_string = array();
    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);

    if (empty($query_string["v"])) {
        //explode at ? mark
        $yt_short_link_parts_explode1 = explode('?', $videoUrl);

        //short link: http://youtu.be/AgFeZr5ptV8
        $yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[0]);
        if (!empty($yt_short_link_parts[3])) {
            return $yt_short_link_parts[3];
        }

        return $yt_short_link_parts[0];
    } else {
        return $query_string["v"];
    }
}
add_action('init','stpaulsacademy_get_youtube_id');

// add media rows
function stpaulsacademy_add_media_action($actions, $post) {
    $link = 'href="#" data-replace-attachment="' . $post->ID . '"';
    $newaction['stp-replace-attachement'] = '<a ' . $link .' class="stpauls_replace_media" title="' . __("Replace media", "stpaulsacademy") . '" rel="permalink">' . __("Replace media", "stpaulsacademy") . '</a>';
    return array_merge($actions, $newaction);
}
add_filter('media_row_actions', 'stpaulsacademy_add_media_action', 10, 2);

function stpaulsacademy_enable_media_replace($form_fields, $post) {
    $link = 'href="#" data-replace-attachment="' . $post->ID . '"';
    $form_fields["stp-replace-attachement"] = array(
        "label" => __("Replace media", "stpaulsacademy"), "input" => "html", "html" => "<p><a ". $link . " class='stpauls_replace_media button-secondary'>" . __("Upload a new file", "stpaulsacademy") . "</a></p>", "helps" => __("To replace the current file, click the link and upload a replacement.", "enable-media-replace"
        ));

    return $form_fields;
}
add_filter('attachment_fields_to_edit', 'stpaulsacademy_enable_media_replace', 10, 2);

function stpauls_take_current_attachment_file($id) {
    global $wpdb;
    $table_name = $wpdb->prefix . "posts";
    $sql = "SELECT guid, post_mime_type FROM $table_name WHERE ID = '" . (int) $id . "'";
    list($current_filename, $current_filetype) = $wpdb->get_row($sql, ARRAY_N);
    // Massage a bunch of vars
    $current_guid = $current_filename;
    $current_filename = substr($current_filename, (strrpos($current_filename, "/") + 1));
    $current_file = get_attached_file((int) $id, apply_filters( 'stpaulsacademy_replace_attachment', true ));
    $current_file = str_replace("//", "/", $current_file);
    return basename($current_file);
}

function stpaulsacademy_delete_current_files($file, $id) {
    // Check if old file exists first
    if (file_exists($file)) {
        // Now check for correct file permissions for old file
        clearstatcache();
        if (is_writable($file)) {
            // Everything OK; delete the file
            unlink($file);
        }
        else {
            // so i know there are an error
            throw new Exception('that file doesnt exists or writeable');
        }
    }
    // Delete old resized versions if this was an image
    $suffix = substr($file, (strlen($file)-4));
    $prefix = substr($file, 0, (strlen($file)-4));
    $imgAr = array(".png", ".gif", ".jpg");
    if (in_array($suffix, $imgAr)) {
        // It's a png/gif/jpg based on file name
        // Get thumbnail filenames from metadata
        $meta = wp_get_attachment_metadata($id);
        if (is_array($meta)) {
            $uploadpath = wp_upload_dir();
            foreach ( $meta['sizes'] as $size => $sizeinfo ) {
                $intermediate_file = str_replace( basename( $file ), $sizeinfo['file'], $file );
                /** This filter is documented in wp-includes/functions.php */
                $intermediate_file = apply_filters( 'wp_delete_file', $intermediate_file );
                @ unlink( path_join( $uploadpath['basedir'], $intermediate_file ) );
            }
        }
    }
}

function stpaulsacademy_zip() {
    $params = func_get_args();
    if (count($params) === 1){ // this case could be probably cleaner
        // single iterable passed
        $result = array();
        foreach ($params[0] as $item){
            $result[] = array($item);
        };
        return $result;
    };
    $result = call_user_func_array('array_map',array_merge(array(null),$params));
    $length = min(array_map('count', $params));
    return array_slice($result, 0, $length);
}

function stpaulsacademy_ajax_replace_attachment() {
    global $wpdb;
    $table_name = $wpdb->prefix . "posts";
    check_ajax_referer( 'stp_admin_replace_media_nonce', 'security' );
    // relative path
    $replace = get_attached_file($_POST['replace_with']);
    $file = get_attached_file($_POST['current_id']);

    $meta = wp_get_attachment_metadata((int) $_POST["replace_with"]);
    $uploadpath = wp_upload_dir();
    $debugs = array();
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $file_ = str_replace('.' . $ext, '', $file);
    try {
        stpaulsacademy_delete_current_files($file, (int) $_POST['current_id']);
        rename($replace, $file);
        $imgs = array("png", "gif", "jpg");
        if (in_array($ext, $imgs)) {
            if (isset($meta['sizes'] ) && is_array( $meta['sizes'] ) ) {
                $newSized = $meta['sizes'];
                foreach ($meta['sizes'] as $size => $sizeinfo) {
                    preg_match('/-[0-9]+x[0-9]+/', $sizeinfo['file'], $matches);
                    $fileN = basename($file_) . $matches[0] . '.' . $ext;
                    $newSized[$size] = array_merge($sizeinfo, array(
                        'file' => $fileN
                    ));
                    $to = path_join($uploadpath['basedir'], str_replace(basename($file), $fileN, $file));
                    $from = path_join($uploadpath['basedir'], str_replace(basename($replace), $sizeinfo['file'], $replace));
                    rename($from, $to);
                }
                wp_update_attachment_metadata((int) $_POST["current_id"], array_merge($meta, array(
                    'sizes' => $newSized
                )));
            }
        }
        wp_delete_attachment((int) $_POST['replace_with'], true);
    } catch (Exception $e) {
        wp_send_json_error(array(
            "file" => $file
        ));
    }
    wp_send_json_success(array(
        "file" => get_post_meta((int) $_POST['replace_with'], '_wp_attached_file', true)
    ));
}

add_action('wp_ajax_stpaulsacademy_replace_attachment', 'stpaulsacademy_ajax_replace_attachment' );
