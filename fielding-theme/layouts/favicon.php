<?php
$theme_dir = get_template_directory_uri();
$twitter   = get_field( 'theme_twitter', 'option' );
?>

<!-- Favions / Touch Icons -->
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $theme_dir; ?>/images/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="<?php echo $theme_dir; ?>/images/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo $theme_dir; ?>/images/favicons/favicon-194x194.png" sizes="194x194">
<link rel="icon" type="image/png" href="<?php echo $theme_dir; ?>/images/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?php echo $theme_dir; ?>/images/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="<?php echo $theme_dir; ?>/images/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php echo $theme_dir; ?>/images/favicons/manifest.json">
<link rel="mask-icon" href="<?php echo $theme_dir; ?>/images/favicons/safari-pinned-tab.svg" color="#6A021E">
<meta name="msapplication-TileColor" content="#6A021E">
<meta name="msapplication-TileImage" content="<?php echo $theme_dir; ?>/images/favicons/mstile-144x144.png">
<meta name="theme-color" content="#6A021E">

<!-- G+ & Facebook -->
<meta property="og:title" content="<?php echo FIELDING_TITLE; ?>">
<meta property="og:url" content="<?php fielding_page_link( 'home' ); ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?php echo $theme_dir; ?>/images/social.png">
<meta property="og:description" content="">
<meta property="og:site_name" content="<?php echo FIELDING_TITLE; ?>">

<!-- Twitter -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@<?php echo $twitter; ?>">
<meta name="twitter:creator" content="@<?php echo $twitter; ?>">
<meta name="twitter:url" content="<?php fielding_page_link( 'home' ); ?>">
<meta name="twitter:title" content="<?php echo FIELDING_TITLE; ?>">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="<?php echo $theme_dir; ?>/images/social.png">