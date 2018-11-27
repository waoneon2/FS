<?
	/*
		Resources Available:
		"meta" = Meta - Text
		"title" = Title - Text
		"subtitle" = Subtitle - Text
		"blurb" = Blurb - Text Area
		"button" = Button - Matrix
		"theme" = Theme - List
	*/
?>

<?php if ($callout['theme'] == 'theme_dark'): ?>
    
    <section class="flex_callout theme_dark">
        <div class="fs-row">
            <div class="fs-cell fs-lg-4">
                <div class="flex_callout_wrapper">
                    <header class="flex_callout_header"> 
                        <span class="flex_callout_meta"><?= $callout['meta'] ?></span>
                        <h3 class="flex_callout_title"><strong><?= $callout['title'] ?></strong> <?= $callout['subtitle'] ?></h3>
                    </header>
                    <div class="flex_callout_body">
                        <div class="flex_callout_description">
                            <p><?= $callout['blurb'] ?></p>
                        </div>
                    </div>
                    <?php if ($callout['button']): ?>
                        <footer class="flex_callout_links">
                           <?php foreach ($callout['button'] as $button): ?>
                               <a class="flex_callout_link" href="<?= $button['link'] ?>">
                                   <span class="flex_callout_link_label"><?= $button['text'] ?></span>
                               </a> 
                           <?php endforeach ?>
                        </footer>
                    <?php endif ?>
                </div>
            </div>
            <div class="js-background flex_callout_background" data-background-options='{"source": {
                "0px": "<?= $callout['background'] ?>", 
                "500px": "<?= $callout['background'] ?>", 
                "740px": "<?= $callout['background'] ?>", 
                "980px": "<?= $callout['background'] ?>"}}'> 
            </div>
        </div>
    </section>

<?php elseif ($callout['theme'] == 'emphasized'): ?>

    <section class="flex_callout emphasized">
        <div class="fs-row">
            <div class="fs-cell fs-lg-12">
                <div class="flex_callout_wrapper">
                    <header class="flex_callout_header"> 
                        <span class="flex_callout_meta"><?= $callout['meta'] ?></span> 
                        <span class="flex_callout_title"><?= $callout['title'] ?></span> 
                        <span class="flex_callout_subheading"><?= $callout['subtitle'] ?></span>                                      
                    </header>
                    <?php if ($callout['button']): ?>
                        <footer class="flex_callout_links">
                           <?php foreach ($callout['button'] as $button): ?>
                               <a class="flex_callout_link" href="<?= $button['link'] ?>">
                                   <span class="flex_callout_link_label"><?= $button['text'] ?></span>
                               </a> 
                           <?php endforeach ?>
                        </footer>
                    <?php endif ?>
                </div>
            </div>
            <div class="flex_callout_emphasized_overlay"></div>
            <div class="js-background flex_callout_background" data-background-options='{"source": {
                "0px": "<?= $callout['background'] ?>", 
                "500px": "<?= $callout['background'] ?>", 
                "740px": "<?= $callout['background'] ?>", 
                "980px": "<?= $callout['background'] ?>"}}'>
            </div>
        </div>
    </section>

<?php endif ?>