<?php
/**
 * The Footer for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Trinity_College
 */

$secondary_nav  = $cms->getSetting("footer_nav");
$social_nav     = $cms->getSetting("social");
?>
        
    <!-- Footer -->
    <footer class="footer" id="footer" itemscope itemtype="http://schema.org/WPFooter">
        <div class="footer_ribbon">
            <div class="fs-row">
                <div class="fs-cell">
                    <div class="footer_ribbon_inner">
                        <div class="logo logo_footer logo_icon" itemscope itemtype="http://schema.org/CollegeOrUniversity"> 
                            <a class="logo_link" itemprop="url" href="<?=WWW_ROOT?>">
                                <span class="logo_link_label">Kenyon Campaign</span>
                                <span class="logo_link_icon">
                                    <?= the_icon('logo_footer') ?>
                                </span>
                            </a>
                            <meta content="http://kenyon-campaign.dev.fastspot.com/images/logo-schema.png" itemprop="logo"> 
                        </div>
                        <div class="footer_nav_social">
                            <nav class="footer_nav" aria-label="Footer" itemscope itemtype="http://schema.org/SiteNavigationElement">
                                <ul class="footer_nav_list">
                                    <?php if ($secondary_nav): ?>
                                        <?php foreach ($secondary_nav as $sc): ?>
                                            <li class="footer_nav_item"> 
                                                <a class="footer_nav_link" href="<?= $sc['link'] ?>" itemprop="url">
                                                    <span class="footer_nav_link_label" itemprop="name"><?= $sc['text'] ?></span>
                                                </a> 
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </nav>
                            <div class="footer_copyright_social">
                                <div class="footer_copyright">
                                    <p>&copy; 2018</p>
                                </div>
                                <div class="social_nav" itemscope itemtype="http://schema.org/CollegeOrUniversity">
                                    <link itemprop="url" href="//kenyon-campaign.dev.fastspot.com">
                                    <div class="social_nav_header">
                                        <h2 class="social_nav_title">Social</h2>
                                    </div>
                                    <div class="social_nav_list">
                                        <?php if ($social_nav): ?>
                                            <?php foreach ($social_nav as $social): ?>
                                                <div class="social_nav_item"> 
                                                    <a class="social_nav_link" href="<?= $social['link'] ?>" target="_blank" itemprop="sameAs">
                                                        <span class="social_nav_icon">
                                                            <?= the_icon($social['class']) ?>
                                                        </span>
                                                        <span class="social_nav_label"><?= $social['Title'] ?></span>
                                                    </a> 
                                                </div>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END: Footer -->
    </div>
    <!-- END: page_wrapper -->
    
    <div class="js-mobile-sidebar mobile_sidebar" id="mobile_sidebar" tabindex="-1">
        <nav class="js-main-nav js-main-nav-sm main_nav main_nav_sm" aria-label="Site" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <ul class="main_nav_list">
                <?php foreach ($navs as $i => $nav): ?>
                    <?php $has_child    = sizeof($nav['children']) ?>
                    <?php $child_class  = $has_child ? 'main_nav_has_children' : '' ?>
                    <li class="js-main-nav-item-<?= $i ?> main_nav_item <?= $child_class ?>">
                        <div class="main_nav_item_wrapper"> 
                            <a class="main_nav_link" href="<?= $nav['link'] ?>" itemprop="url" aria-haspopup="true">
                                <span class="main_nav_link_label" itemprop="name"><?= $nav['title'] ?></span>
                            </a> 
                            <?php if ($has_child): ?>
                                <button class="js-swap js-main-nav-toggle main_nav_toggle" data-swap-target=".js-main-nav-item-<?= $i ?>" data-swap-group="main_nav" aria-label="Enhance Submenu">
                                    <span class="main_nav_toggle_icon">
                                        <?php the_icon('caret_down') ?>
                                    </span>
                                </button> 
                            <?php endif ?>
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
        <nav class="secondary_nav secondary_nav_sm" aria-label="Secondary" itemscope itemtype="http://schema.org/SiteNavigationElement">
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

    <script>
        var WWW_ROOT = "<?=WWW_ROOT?>";
        var STATIC_ROOT = "<?=STATIC_ROOT?>";
    </script>
    <script src="<?=WWW_ROOT?>js/site.js?1536353686"></script>
    <!-- Grid Bookmarklet -->
    <script>
        //(function() {
            //if (typeof FSGridBookmarklet === 'undefined') {
               // document.body.appendChild(document.createElement('script')).src = '//formstone.it/js/bookmarklet/grid.js';
            //} else {
                //FSGridBookmarklet();
           // }
        //})();
    </script>

</body>