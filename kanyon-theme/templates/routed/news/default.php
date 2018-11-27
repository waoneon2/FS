<?php 
    $page       = $bigtree['page'];
    $articles   = $CampaignNews->getAllPositioned();
    $cats       = $CampaignNews->get_all_category();
?>
<!-- Page -->
<div class="page_inner">
    <!-- Page Feature -->
    <div class="page_feature">
        <div class="news_header">
            <div class="news_header_media js-background theme_purple" data-background-options='{"source":{"0px":"//images.fastspot.com/kenyon-campaign/494x740/12","740px":"//images.fastspot.com/kenyon-campaign/980x735/12","980px":"//images.fastspot.com/kenyon-campaign/1220x523/12","1220px":"//images.fastspot.com/kenyon-campaign/1440x617/12"},"alt":"Campaign Stories"}'>
                <div class="news_header_content">
                    <div class="fs-row">
                        <div class="fs-cell fs-lg-10 fs-lg-push-1">
                            <header class="news_header_header">
                                <h1 class="news_header_heading"><?= $page['title'] ?></h1>
                                <div class="news_header_filter">
                                    <div class="js-menu menu"> 
                                        <button class="js-menu-trigger menu_trigger" data-menu-opens="categories">
                                            <span class="menu_trigger_label">
                                                <span class="lavender">Filter By</span> Category
                                            </span>
                                            <span class="menu_trigger_icon" aria-hidden="true">
                                                <?= the_icon('caret_down') ?>
                                            </span>
                                        </button>
                                        <div class="js-menu-panel menu_panel" id="categories">
                                            <ul class="menu_panel_list">
                                                <li class="js-menu-item menu_panel_item"> 
                                                    <a class="js-menu-link menu_panel_link" href="<?= $page['link'] ?>">View All Stories</a> 
                                                </li>
                                                <?php foreach ($cats as $cat): ?>
                                                    <?php  
                                                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                                            $cat_link = $page['link'].'?filter='.$cat['id'].'&page_no='.$_GET['page_no'];
                                                            $page['link'] .= '?page_no='.$_GET['page_no'];
                                                        } else {
                                                            $cat_link = $page['link'].'?filter='.$cat['id'].'';
                                                        } 
                                                    ?>
                                                    <li class="js-menu-item menu_panel_item"> 
                                                        <a class="js-menu-link menu_panel_link" href="<?= $cat_link ?>"><?= $cat['category'] ?></a> 
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </header>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fs-row">
                <div class="fs-cell fs-lg-12">
                    <div class="featured_news">
                        <div class="featured_news_inner">
                            <div class="featured_news_image js-background" data-background-options='{"source":
                            {"0px":"<?= $articles[0]['image']; ?>", 
                            "500px":"<?= $articles[0]['image']; ?>", 
                            "740px":"<?= $articles[0]['image']; ?>", 
                            "980px":"<?= $articles[0]['image']; ?>"},
                            "alt":"Here Comes the Sun"}'></div>
                            <div class="featured_news_wrapper">
                                <header class="featured_news_header"> 
                                    <span class="featured_news_meta">
                                        <?php $CampaignNews->the_category($articles[0]['id']) ?>
                                    </span>
                                    <h3 class="featured_news_title"><?= $articles[0]["title"]; ?></h3>
                                </header>
                                <div class="featured_news_body">
                                    <div class="featured_news_description">
                                        <p><?= $articles[0]["blurb"] ?></p>
                                    </div>
                                </div>
                                <footer class="featured_news_footer"> 
                                    <a class="featured_news_link" href="<?= $articles[0]["detail_link"] ?>">
                                        <span class="featured_news_link_label">Read The Story</span>
                                    </a> 
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Page Feature -->
    <!-- Page Content -->
    <div class="page_content">
        <div class="fs-row">
            <!-- Main Content -->
            <div class="fs-cell content_wrapper">
                <main class="main_content" id="main_content" itemprop="mainContentOfPage">
                    <!-- WYSIWYG - wrap all WYSIWYG text areas in `.typography` -->
                    <div class="typography"><?= $resources['wysiwyg'] ?></div>
                    <!-- END: WYSIWYG -->
                    <!-- In Content Callouts -->
                    <div class="in_content_callouts"> 
                    </div>
                    <!-- END: In Content Callouts -->
                </main>
            </div>
            <!-- END: Main Content -->
        </div>
        <!-- Full Width Callouts -->
        <div class="full_width_callouts">
            <?php the_callouts($resources['full_width_callouts']) ?>
        </div>
        <!-- END: Full Width Callouts -->
    </div>
    <!-- END: Page Content -->
</div>
<!-- END: Page -->