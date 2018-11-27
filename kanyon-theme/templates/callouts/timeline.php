<?
	/*
		Resources Available:
		"title" = Title - Text
		"subtitle" = Subtitle - Text
		"timeline" = Timeline - Matrix
	*/
?>
<!-- timeline Block -->
<section class="timeline_block">
    <div class="fs-row">
        <div class="fs-cell">
            <header class="timeline_block_header">
                <h2 class="timeline_block_title">The Timeline</h2>
                <span class="timeline_block_heading"><?= $callout['title'] ?></span>                  
                <span class="timeline_block_subheading"><?= $callout['subtitle'] ?></span>               
            </header>
            <div class="timeline_items">
                <?php foreach ($callout['timeline'] as $i => $timeline): ?>
                    <div class="timeline_row <?= color_theme($i) ?>">
                        <div class="timeline_row_inner">
                            <figure class="timeline_figure">
                                <picture class="timeline_picture">
                                    <source media="(min-width: 740px)" srcset="<?= $timeline['image'] ?>" />
                                    <source media="(min-width: 0px)" srcset="<?= $timeline['image'] ?>" />
                                    <img class="timeline_image" src="<?= $timeline['image'] ?>" alt="">
                                </picture>
                            </figure>
                            <div class="timeline_wrapper js-timeline-content">
                                <header class="timeline_header">
                                    <h3 class="timeline_title"><?= $timeline['title'] ?></h3>
                                </header>
                                <div class="timeline_body">
                                    <div class="timeline_description">
                                        <p><?= $timeline['blurb'] ?></p>
                                    </div>
                                </div>
                                <?php if ($timeline['link'] && $timeline['button']): ?>
                                    <footer class="timeline_footer">
                                        <a class="timeline_link" href="<?= $timeline['link'] ?>">
                                            <span class="timeline_link_label"><?= $timeline['button'] ?></span>
                                        </a>
                                    </footer>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="timeline_divider"></div>
            </div>
        </div>
    </div>
</section>
<!-- END: timeline Block -->