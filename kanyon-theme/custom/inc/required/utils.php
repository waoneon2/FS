<?php 

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_class($page) {
    if ($page) {
        if ($page['id'] == 0) {
            $classes[] = 'preload';
            $classes[] = 'fs-grid';
            $classes[] = 'page_layout_home';
        }

        if ($page['id'] > 0) {
            $classes[] = 'preload';
            $classes[] = 'fs-grid';
            $classes[] = 'page_layout_default';
            $classes[] = 'page_theme_gray';
        }
    } else {
        $classes[] = 'fs-grid';
        $classes[] = 'page_layout_404';
    }

    //var_dump($page); exit();
    $class = implode(" ",$classes);
    echo $class;
}

/**
 * Print Icon
 *
 * @param icon id
 */
function the_icon($icon_id, $echoed = false) {

    $return = '<svg class="icon icon_'.$icon_id.'">';
        $return .= '<use xlink:href="'.STATIC_ROOT."/images/icons.svg#".$icon_id.'"></use>';
    $return .= '</svg>';

    if ($echoed) {
       echo $return;
    } else {
        return $return;
    }
}

/**
 *  Theme
 */
function color_theme($i) {
    $i = $i + 1;
    $theme = array('-', 'theme_green', 'theme_blue', 'theme_purple', 'theme_orange');
    if ($i > 4) {
        $imod = $i % 4;
        return ($imod == 0) ? $theme[4] : $theme[$imod];
    }
    return $theme[$i];
}

// filer <p>
function p_filter($string) {
    $pattern = "=^<p>(.*)</p>$=i";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}

/**
 *  Callouts
 */
function the_callouts($callouts) {
    include "../templates/layouts/_callouts.php";
}