<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Trinity_College
 */

?>
<!doctype html>
<html class="js supports svgclippaths no-touchevents csstransforms csstransforms3d" lang="en" itemscope="" itemtype="http://schema.org/WebPage" data-whatinput="mouse" data-whatintent="mouse">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    
    <meta name="keywords" content="<?=$bigtree["page"]["meta_keywords"]?>" />
    <meta name="description" content="<?=$bigtree["page"]["meta_description"]?>" />
    <meta name="author" content="<?=$home_page["nav_title"]?>" />
    
    <!-- G+ AND FACEBOOK META TAGS -->
    <meta property="og:title" content="<?=$bigtree["page"]["title"]?>" />
    <meta property="og:url" content="<?=htmlspecialchars($current_url)?>" />
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?=STATIC_ROOT?>images/facebook.jpg" />
    <meta property="og:description" content="<?=$page["meta_description"]?>" />
    <meta property="og:site_name" content="<?=$home_page["nav_title"]?>" />
    
    <!-- TWITTER CARD -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@" />
    <meta name="twitter:creator" content="@" />
    <meta name="twitter:url" content="<?=htmlspecialchars($current_url)?>" />
    <meta name="twitter:title" content="<?=$bigtree["page"]["title"]?>" />
    <meta name="twitter:description" content="<?=$page["meta_description"]?>" />
    <meta name="twitter:image" content="<?=STATIC_ROOT?>images/facebook.jpg" />
    
    <title><?=$bigtree["page"]["title"]?></title>
    <!-- <title>Home | Kenyon Campaign</title> -->
    
    <link rel="icon" href="<?=STATIC_ROOT?>favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?=STATIC_ROOT?>favicon.ico" type="image/x-icon" />
    
    <link rel="stylesheet" href="<?=WWW_ROOT?>css/site.css" type="text/css" media="all" />
    
    <script src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5b841d0b8e496b00101b7350&amp;product=custom-share-buttons"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,700,900" rel="stylesheet">


</head>

<body class = "<?php body_class($bigtree['page']) ?>" >
    <?php 
        $navs = $cms->getNavByParent(0, 2);
        $navs_hiddens = $cms->getNavByParent(0, 2, true, true);
    ?>
    <!-- Page Wrapper -->
    <div class="page_wrapper">
        <!-- ==================  HEADER ============================================= -->
        <!-- Header -->
        <header class="header" id="header" itemscope itemtype="http://schema.org/WPHeader">
            <div class="header_ribbon">
                <div class="fs-row">
                    <div class="fs-cell">
                        <div class="header_ribbon_inner">
                            <div class="logo logo_header logo_icon" itemscope itemtype="http://schema.org/CollegeOrUniversity"> 
                                <a class="logo_link" itemprop="url" href="<?=WWW_ROOT?>">
                                    <span class="logo_link_label">Kenyon Campaign</span>
                                    <span class="logo_link_icon">
                                        <?= the_icon('logo') ?>
                                    </span>
                                </a>
                                <meta content="http://kenyon-campaign.dev.fastspot.com/images/logo-schema.png" itemprop="logo"> 
                            </div>
                            <div class="header_navigation">
                                <nav class="secondary_nav secondary_nav_lg" aria-label="Secondary" itemscope itemtype="http://schema.org/SiteNavigationElement">
                                    <ul class="secondary_nav_list">
                                        <?php foreach ($navs_hiddens as $nav): ?>
                                            <?php $has_child = sizeof($nav['children']) ?>
                                            <?php if ($has_child): ?>
                                                <?php foreach ($nav['children'] as $children): ?>
                                                     <li class="secondary_nav_item"> 
                                                        <a class="secondary_nav_link" href="<?= $children['link'] ?>" itemprop="url">
                                                            <span class="secondary_nav_link_label" itemprop="name"><?= $children['title'] ?></span>
                                                        </a> 
                                                    </li>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </nav>
                                <nav class="js-main-nav js-main-nav-lg main_nav main_nav_lg" aria-label="Site" itemscope itemtype="http://schema.org/SiteNavigationElement">
                                    <ul class="main_nav_list">
                                        <?php foreach ($navs as $i => $nav): ?>
                                            <?php $has_child    = sizeof($nav['children']) ?>
                                            <?php $child_class  = $has_child ? 'main_nav_has_children' : '' ?>
                                            <li class="js-main-nav-item-<?= $i + 1 ?> main_nav_item <?= $child_class ?>">
                                            <div class="main_nav_item_wrapper"> 
                                                <a class="main_nav_link" href="<?= $nav['link'] ?>" itemprop="url" aria-haspopup="true">
                                                    <span class="main_nav_link_label" itemprop="name"><?= $nav['title'] ?></span>
                                                </a> 
                                            </div>
                                            <?php if ($has_child): ?>
                                                <ul class="js-main-nav-children main_nav_children" aria-label="submenu">
                                                <?php foreach ($nav['children'] as $children): ?>
                                                        <li class="main_nav_child_item"> 
                                                            <a class="main_nav_child_link" href="<?= $children['link'] ?>" itemprop="url">
                                                                <span class="main_nav_child_link_label" itemprop="name"><?= $children['title'] ?></span>
                                                            </a> 
                                                        </li>
                                                <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                        </li>
                                        <?php endforeach ?>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header_group"> 
                                <a class="js-swap js-mobile-sidebar-handle mobile_sidebar_handle mobile_sidebar_handle_primary" href="#mobile_sidebar" data-swap-target=".mobile_sidebar" data-swap-linked="mobile_sidebar" aria-label="Menu/Search">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="home_pillar_nav js-home-pillar-nav">
            <div class="fs-row">
                <div class="fs-cell">
                    <div class="home_pillar_nav_inner">
                        <nav class="secondary_nav secondary_nav_lg" aria-label="Secondary" itemscope itemtype="http://schema.org/SiteNavigationElement">
                            <ul class="secondary_nav_list">
                                <?php foreach ($navs_hiddens as $nav): ?>
                                    <?php $has_child = sizeof($nav['children']) ?>
                                    <?php if ($has_child): ?>
                                        <?php foreach ($nav['children'] as $children): ?>
                                             <li class="secondary_nav_item"> 
                                                <a class="secondary_nav_link" href="<?= $children['link'] ?>" itemprop="url">
                                                    <span class="secondary_nav_link_label" itemprop="name"><?= $children['title'] ?></span>
                                                </a> 
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endforeach ?>   
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Header -->