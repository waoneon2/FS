<?php 
if (isset($bigtree["commands"][0])) {
    $news  = $CampaignNews->getByRoute($bigtree["commands"][0]);
}
if (!$news) {
    $cms->catch404();
}
?>

<!-- Page -->
<div class="page_inner">
    <!-- Page Feature -->
    <div class="page_feature">
        <div class="news_detail_header theme_green has_image">
            <div class="news_detail_header_content">
                <div class="fs-row">
                    <div class="fs-cell fs-lg-10 fs-lg-push-1">
                        <header class="news_detail_header_header"> 
                            <span class="news_detail_header_tags"><?php $CampaignNews->the_category($news['id']) ?></span>
                            <h1 class="news_detail_header_heading"><?= $news['title'] ?></h1>
                            <p class="news_detail_header_description"><?= $news['blurb'] ?></p>
                        </header>
                    </div>
                </div>
            </div>
            <div class="fs-row">
                <div class="fs-cell fs-lg-12">
                    <div class="news_detail_media_inner">
                        <div class="news_detail_share_buttons theme_green">
                            <div class="share_buttons_label"> 
                                <span class="share_buttons_label_text">Share This Story</span> 
                            </div>
                            <?php $socials = ["twitter", "facebook", "email"] ?>
                            <?php foreach ($socials as $social): ?>
                                <div data-network="<?= $social ?>" class="st-custom-button"> 
                                    <span class="custom_social_share <?= $social ?>">
                                        <?= the_icon($social) ?>
                                    </span> 
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="news_detail_image">
                            <div class="news_detail_image_inner">
                                <picture class="news_detail_image_picture">
                                    <source media="(min-width: 1220px)" srcset="<?= $news['image'] ?>" />
                                    <source media="(min-width: 980px)" srcset="<?= $news['image'] ?>" />
                                    <source media="(min-width: 740px)" srcset="<?= $news['image'] ?>" />
                                    <source media="(min-width: 500px)" srcset="<?= $news['image'] ?>" />
                                    <source media="(min-width: 0px)" srcset="<?= $news['image'] ?>" />
                                    <img class="news_detail_image_image" src="<?= $news['image'] ?>" alt="" style="width: 100%;"> 
                                </picture>
                                <div class="news_detail_image_caption">
                                    <div class="fs-cell fs-lg-10 fs-lg-push-1">
                                        <div class="news_detail_image_caption_inner"> 
                                            <span class="news_detail_image_caption_text">Info</span> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news_detail_back"> 
                <a class="news_detail_back_link" href="<?= $news['listing_link'] ?>">Back To Stories</a> 
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
                        <?= $news['content'] ?>
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
    <!-- END: Page Content -->
</div>
<!-- END: Page -->