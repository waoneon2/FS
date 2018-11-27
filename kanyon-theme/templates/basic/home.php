<?php 
    $page       = $bigtree['page'];
    $resources  = $page['resources'];
    $pillars    = $resources['pillar'];
    $callouts   = $resources['full_width_callouts'];
?>

<!-- Page -->
<div class="page_inner">
    
    <!-- Page Feature -->
    <div class="page_feature">
        <section class="home_pillars js-home-pillars" data-position="one">
            <div class="home_pillars_media js-background" data-background-options='{"source": {"mp4":"/files/kenyon.mp4", "poster":"<?= $resources['image_background'] ?>"}, "alt":"Our Path Forward"}'></div>
            <div class="home_pillars_content">
                <div class="fs-row">
                    <div class="fs-cell fs-lg-12">
                        <div class="home_pillars_inner js-pillar-content">
                            <div class="home_pillars_logo">
                                <div class="logo logo_home_pillars logo_icon" itemscope itemtype="http://schema.org/CollegeOrUniversity"> 
                                    <a class="logo_link" itemprop="url" href="<?=WWW_ROOT?>">
                                        <span class="logo_link_label">Kenyon Campaign</span>
                                        <span class="logo_link_icon">
                                            <?=the_icon('logo_white')?>
                                        </span>
                                    </a>
                                    <meta content="http://kenyon-campaign.dev.fastspot.com/images/logo-schema.png" itemprop="logo"> 
                                </div>
                            </div>
                            <div class="home_pillars_sections">
                                <div class="home_pillars_sections_inner">

                                    <?php foreach ($pillars as $key => $pillar): ?>
                                        <div class="home_pillar_section pillar_section_1 js-pillar">
                                            <h2 class="home_pillar_title"> 
                                                <a class="pillar_title_link js-pillar-title-link" href="<?= $pillar['link'] ?>"><?= $pillar['title'] ?></a> 
                                                <span class="pillar_icon">
                                                    <?=the_icon('caret_right')?>
                                                </span> 
                                            </h2>
                                            <div class="home_pillar_inner_content">
                                                <p class="home_pillar_goal"><?= $pillar['subtitle'] ?></p>
                                                <p class="home_pillar_description"><?= $pillar['blurb'] ?></p> 
                                                
                                                <?php if ($pillar['link']): ?>
                                                    <a class="home_pillar_mobile_link" href="<?= $pillar['link'] ?>">
                                                        <span class="home_pillar_mobile_link_label">Learn More</span>
                                                        <span class="home_pillar_mobile_link_icon" aria-hidden="true">
                                                            <?=the_icon('caret_right')?>
                                                        </span>
                                                    </a> 
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="video_cta_pause">
                                <div class="mobile_video_cta"> 
                                    <span class="mobile_video_cta_icon">
                                        <?=the_icon('play')?>
                                    </span> 
                                    <a class="js-lightboxing" href="  <?= $resources['campaign_video'] ?>">
                                        <span class="mobile_video_cta_label">Watch The Campaign Video</span>
                                    </a> 
                                </div>
                                <div class="video_pause"> 
                                    <button class="js-video-play-pause" aria-hidden="true">
                                        <span class="video_pause_label">Pause</span>
                                        <?=the_icon('pause')?>
                                    </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_pillars_background js-pillars-background"></div>
        </section>
    </div>
    <!-- END: Page Feature -->

    <!-- Page Content -->
    <div class="page_content">
        <?php the_callouts($callouts) ?>
    </div>

</div>