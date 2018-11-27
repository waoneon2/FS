<?
    $page       = $bigtree['page'];
    $resources  = $page['resources'];
    $pillars    = $resources['pillar'];
    $callouts   = $resources['full_width_callouts'];
?>
<?php // print_r($resources) ?>
<div class="page_inner">
    <!-- Page Feature -->
    <div class="page_feature">
        <div class="pillar_header">
            <div class="pillar_header_media js-background" 
            data-background-options='{"source":{
            "0px":"//images.fastspot.com/kenyon-campaign/735x980/2", 
            "500px":"//images.fastspot.com/kenyon-campaign/980x735/2", 
            "740px":"//images.fastspot.com/kenyon-campaign/1440x1080/2", 
            "1220px":"//images.fastspot.com/kenyon-campaign/1440x810/2"},
            "alt":"Enhance Our Path - Adapt our campus to an ever-expanding intellectual frontier."}'>
                <div class="pillar_header_content">
                    <div class="fs-row">
                        <div class="pillar_header_inner">
                            <div class="fs-cell fs-md-5 fs-lg-7 fs-xl-6">
                                <header class="pillar_heading">
                                    <h1 class="pillar_header_headline"><?= $resources['header_title'] ?></h1> 
                                    <span class="pillar_header_description"><?= $resources['header_desc'] ?></span> 
                                </header>
                                <div class="pillar_header_cta"> 
                                    <span class="pillar_header_icon">
                                       <?= the_icon('arrow_down') ?>
                                    </span> 
                                    <a class="pillar_header_link" href="#"><span class="pillar_header_cta_label">Explore This Initiative</span></a> 
                                </div>
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
                    <div class="typography">
                        <?= $resources['wysiwyg'] ?>
                    </div>
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
            <?php the_callouts($callouts) ?>
        </div>
    </div>

</div>