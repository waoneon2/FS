<?
    $CampaignNews = new TheCampaignNews;
    $cnews = $CampaignNews->getRecent(2);
?>

<!-- Topic Block -->    
<div class="topic_block">
    <div class="fs-row">
        <div class="fs-cell fs-lg-12">
            <header class="topic_block_header">
                <h2 class="topic_block_title"><?= $callout['header'] ?></h2>
                <p class="topic_block_heading"><?= $callout['title'] ?></p>
                <p class="topic_block_subheading"><?= $callout['subtitle'] ?></p>
                <div class="topic_header_button large"> 
                    <a class="topic_block_header_link" href="#">
                        <span class="topic_block_header_link_label">View All Stories</span>
                    </a> 
                </div>
            </header>
            <div class="topic_items">
                <?php foreach ($cnews as $news): ?>
                    <article class="topic_row">
                        <div class="topic_row_inner">
                            <div class="topic_media">
                                <figure class="topic_figure">
                                    <picture class="topic_picture">
                                        <source media="(min-width: 740px)" srcset="<?= $news['image'] ?>" />
                                        <source media="(min-width: 0px)" srcset="<?= $news['image'] ?>" />
                                        <img class="topic_image" src="<?= $news['image'] ?>" alt=""> 
                                    </picture>
                                </figure>
                            </div>
                            <div class="topic_wrapper">
                                <header class="topic_header"> 
                                    <span class="topic_tags">
                                        <?php $CampaignNews->the_category($news['id']) ?>
                                    </span>
                                    <h3 class="topic_title"><?= $news['title'] ?></h3>
                                </header>
                                <div class="topic_body">
                                    <div class="topic_description">
                                         <?= $news['blurb'] ? $news['blurb'] : $news['content'] ?>
                                    </div>
                                </div>
                                <footer class="topic_links"> 
                                    <a class="topic_link" href="#">
                                        <span class="topic_link_label">Read The Story</span>
                                        <span class="topic_link_icon" aria-hidden="true">
                                            <?= the_icon('chevron_right') ?>
                                        </span>
                                    </a> 
                                </footer>
                            </div>
                        </div>
                    </article>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- END: Topic Block -->