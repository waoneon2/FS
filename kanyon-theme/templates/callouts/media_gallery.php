<?
	/*
		Resources Available:
		"title" = Title - Text
		"subtitle" = Subtitle - Text
		"gallery" = Gallery - Photo Gallery
	*/
?>
<section class="media_gallery js-media-gallery">
    <div class="fs-row">
        <div class="fs-cell fs-lg-12">
            <div class="media_gallery_inner">
                <header class="media_gallery_header">
                    <h2 class="media_gallery_title"><?= $callout['title'] ?></h2> 
                    <span class="media_gallery_subheading"><?= $callout['subtitle'] ?></span> 
                </header>
                <div class="media_gallery_items">
                    <div class="media_gallery_items_inner js-media-gallery-items">
                        <?php foreach ($callout['gallery'] as $i => $gallery): ?>
                            <div class="media_gallery_item">
                                <div class="media_gallery_item_inner">
                                    <div class="media_gallery_item_wrapper">
                                        <picture class="media_gallery_item_media_picture">
                                            <source media="(min-width: 1220px)" srcset="<?= $gallery['image'] ?>" />
                                            <source media="(min-width: 980px)" srcset="<?= $gallery['image'] ?>" />
                                            <source media="(min-width: 500px)" srcset="<?= $gallery['image'] ?>" />
                                            <source media="(min-width: 0px)" srcset="<?= $gallery['image'] ?>" />  
                                            <img class="media_gallery_item_media_image" src="<?= $gallery['image'] ?>" alt="" /> 
                                        </picture>
                                    </div>
                                    <div class="media_gallery_item_caption">
                                        <div class="media_gallery_item_count"> 
                                        </div>
                                        <p class="media_gallery_caption_text"><?= $gallery['caption'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="media_gallery_nav"> 
                    <span class="media_gallery_nav_prev"></span> 
                    <span class="media_gallery_nav_next"></span> 
                </div>
            </div>
        </div>
    </div>
</section>