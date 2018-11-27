<?
	/*
		Resources Available:
	*/
?>
<div class="js-bar-graph bar_graph <?= $callout['theme'] ?> <?= $callout['color'] ?>">
    <div class="fs-row">
        <div class="fs-cell fs-lg-10 fs-lg-push-1">
            <div class="bar_graph_container">
                <div class="bar_graph_info">
                    <p class="bar_graph_heading"><?= $callout['header'] ?></p>
                    <h3 class="bar_graph_title"><?= $callout['title'] ?></h3>
                    <div class="bar_graph_inner has_summary">
                        <div class="bar_graph_summary">
                            <span class="bar_graph_summary_label"><?= $callout['subtitle'] ?></span>
                        </div>
                        <div class="bar_graph_button"> 
                            <a class="bar_graph_button_link" href="<?= $callout['link'] ?>">
                                <span class="bar_graph_button_link_label">Give Now</span>
                            </a> 
                        </div>
                    </div>
                </div>
                <div class="bar_graph_fullwidth js-bargraph-fullwidth">
                    <div class="bar_graph_value"> 
                        <span class="bar_graph_value_label">$<?= number_format($callout['unit']) ?></span> 
                    </div>
                </div>
                <div class="bar_graph_labels"> 
                    <span class="bar_graph_nominator">$0</span> 
                    <span class="bar_graph_denominator">$<?= number_format($callout['max']) ?></span> 
                </div>
                <div class="bar_graph_description">
                    <p class="bar_graph_description_text"><?= $callout['blurb'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>