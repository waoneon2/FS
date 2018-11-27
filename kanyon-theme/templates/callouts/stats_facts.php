<?
	/*
		Resources Available:
		"header" = Header - Text
		"title" = Title - Text
		"fact_list" = Fact List - Matrix
	*/
?>
<section class="facts_stats js-facts-stats">
    <div class="fs-row">
        <div class="fs-cell fs-lg-12">
            <header class="facts_stats_header">
                <h3 class="facts_stats_heading"><?= $callout['header'] ?></h3> 
                <span class="facts_stats_subheading"><?= $callout['title'] ?></span>
                <div class="facts_stats_nav"> 
                    <span class="nav_prev"></span> 
                    <span class="nav_next"></span> 
                </div>
            </header>
            <div class="facts_stats_inner">
                
                <div class="facts_stats_display js-facts-stats-display">
                    <?php foreach ($callout['fact_list'] as $i => $fact_list): ?>
                        <div class="fact_stat_display_item <?= color_theme($i) ?>
                            <?php if ($fact_list['background']): ?>
                                has_image js-background" data-background-options='{"source": "https://images.fastspot.com/kenyon-campaign/12/full-med/"}'
                            <?php else: ?>
                                "
                            <?php endif ?>>

                            <div class="display_item_image"> 
                                <?php if ($fact_list['image']): ?>
                                    <img src="<?= $fact_list['image'] ?>" alt="<?= p_filter($fact_list['content']) ?>" /> 
                                <?php endif ?>
                            </div>
                            <div class="display_item_content">
                                <p class="display_item_text"><?= p_filter($fact_list['content']) ?></p> 
                                <?php if ($fact_list['link']): ?>
                                    <a class="display_item_link" href="<?= $fact_list['link'] ?>">
                                        <span class="display_item_link_label">Give Now</span>
                                    </a> 
                                <?php endif ?>
                            </div>

                        </div>
                    <?php endforeach ?>
                </div>

                <div class="facts_stats_items js-facts-stats-items">
                    <?php foreach ($callout['fact_list'] as $i => $fact_list): ?>
                        <div class="fact_stat_item <?= color_theme($i) ?> <?php echo $fact_list['background'] ? 'has_image' : '' ?>">
                            <div class="fact_stat_item_content">
                                <p class="fact_stat_item_text"><?= p_filter($fact_list['content']) ?></p> 
                                <?php if ($fact_list['link']): ?>
                                    <a class="fact_stat_item_link" href="<?= $fact_list['link'] ?>">
                                        <span class="fact_stat_item_link_label">Give Now</span>
                                    </a> 
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </div>
</section>