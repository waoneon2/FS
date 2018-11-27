<?
    $page       = $bigtree['page'];
    $resources  = $page['resources'];
    $pillars    = $resources['pillar'];
    $callouts   = $resources['full_width_callouts'];

    $page_class = ($resources['header_image']) ? "page_header theme_purple has_media" : "page_header theme_gray";
    $s_link     = strpos($page['link'], $page['route'].'/');
    $back_link  = ($s_link) ? str_replace($page['route'].'/', '', $page['link']) : str_replace($page['route'], '', $page['link']);
    $back_name  = str_replace('/'.$page['route'], '', $page['path']);
?>

<!-- Page -->
<div class="page_inner">
    <!-- Page Header -->
    <div class="<?= $page_class ?>">
        <div class="header_subnav"> 
            <?php if ($resources['header_image']): ?>
                <a class="header_subnav_link" href="<?= $back_link ?>">Back to <?= $back_name ?></a> 
            <?php endif ?>
        </div>
        <div class="fs-row">
            <div class="fs-cell fs-lg-push-1 fs-lg-9">
                <h1 class="page_title"><?= $resources['title'] ?></h1>
            </div>
        </div>
    </div>

    <?php if ($resources['header_image']): ?>
        <div class="page_header_media">
            <div class="fs-row">
                <div class="fs-cell fs-lg-12">
                    <div class="page_header_inner">
                        <picture class="page_picture">
                            <source media="(min-width: 1220px)" srcset="<?= $resources['header_image'] ?>" />
                            <source media="(min-width: 980px)" srcset="<?= $resources['header_image'] ?>" />
                            <source media="(min-width: 740px)" srcset="<?= $resources['header_image'] ?>" />
                            <source media="(min-width: 500px)" srcset="<?= $resources['header_image'] ?>" />
                            <source media="(min-width: 0px)" srcset="<?= $resources['header_image'] ?>" /> 
                            <img class="page_header_image" src="<?= $resources['header_image'] ?>" alt=""> 
                        </picture> 
                        <a class="js-video-appender video_item_trigger" href="//www.youtube.com/watch?v=s_HRTFms-hI" data-video-id="s_HRTFms-hI" data-video-service="youtube" aria-label="Watch The Video">
                            <span class="video_item_trigger_hint">
                                <span class="video_item_hint_icon">
                                    <?php the_icon('play') ?>
                                </span>
                            </span>
                        </a>
                        <div class="page_header_overlay"></div>
                    </div>
                </div>
            </div>
            <div class="fs-row">
                <div class="fs-cell fs-lg-push-1 fs-lg-10">
                    <div class="page_header_inner">
                        <div class="page_header_caption"> 
                            <span class="page_header_caption_label">
                                <span class="page_header_caption_text"><?= $resources['header_caption'] ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="fs-row">
            <div class="fs-cell fs-lg-push-1 fs-lg-10">
                <div class="page_header_inner"></div>
            </div>
        </div>
    <?php endif ?>


</div>
<!-- END: Page Header -->

<!-- Page Content -->
<div class="page_content">
    <div class="fs-row">
        <!-- Main Content -->
        <div class="fs-cell fs-lg-10 fs-lg-push-1 content_wrapper">
            <main class="main_content" id="main_content" itemprop="mainContentOfPage">
                <!-- WYSIWYG - wrap all WYSIWYG text areas in `.typography` -->
                <div class="typography">
                    <?= $resources['content'] ?>
                </div>
                <!-- END: WYSIWYG -->
                <!-- In Content Callouts -->
                <div class="in_content_callouts"></div>
                <!-- END: In Content Callouts -->
            </main>
        </div>
        <!-- END: Main Content -->
    </div>

    <!-- Full Width Callouts -->
    <div class="full_width_callouts">
        <?php the_callouts($callouts) ?>
    </div>
</div>