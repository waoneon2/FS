<?
	/*
		Resources Available:
		"title" = Title - Text
		"list" = List - Matrix
	*/
?>
<!-- Linked List -->
<div class="fs-row">
    <div class="fs-cell fs-lg-10 fs-lg-push-1">
        <div class="linked_list" itemscope itemtype="http://schema.org/ItemList">
            <header class="linked_list_header">
                <h2 class="linked_list_title" itemprop="name"> 
                    <span class="linked_list_title_label"><?= $callout['title'] ?></span> 
                </h2>
            </header>
            <div class="linked_list_body">
                <ul class="linked_list_group">
                    <?php if ($callout['list']): ?>
                        <?php foreach ($callout['list'] as $list): ?>
                            <li class="linked_list_item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"> 
                                <a class="linked_list_link" href="<?= $list['link'] ?>" itemprop="url">
                                    <span class="linked_list_link_inner">
                                        <span class="linked_list_label" itemprop="name"><?= $list['text'] ?></span>
                                        <span class="linked_list_icon">
                                           <?= the_icon('caret_right') ?>
                                        </span>
                                    </span>
                                </a> 
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END: Linked List -->