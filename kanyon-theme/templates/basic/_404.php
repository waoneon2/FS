<!-- Page Feature -->
<div class="page_feature">
    <!-- Flex Callout -->
    <section class="cover_callout">
        <div class="fs-row">
            <div class="fs-cell fs-lg-12">
                <div class="cover_callout_inner">
                    <header class="cover_callout_header">
                        <h1 class="cover_callout_heading"><?= $cms->getSetting("404_header") ?></h1>
                    </header>
                    <div class="cover_callout_body">
                        <p><?= $cms->getSetting("404_body") ?></p>
                    </div>
                    <footer class="cover_callout_links"> 
                        <?php foreach ($cms->getSetting("404_button") as $btn): ?>
                            <a class="cover_callout_link" href="<?= $btn['link'] ?>">
                                <span class="cover_callout_link_label"><?= $btn['text'] ?></span>
                            </a> 
                        <?php endforeach ?>
                    </footer>
                </div>
            </div>
            <div class="js-background cover_callout_background" data-background-options='{"source": {
                "1220px": "<?= $cms->getSetting("404_background") ?>", 
                "980px": "<?= $cms->getSetting("404_background") ?>", 
                "740px": "<?= $cms->getSetting("404_background") ?>", 
                "500px": "<?= $cms->getSetting("404_background") ?>", 
                "0px": "<?= $cms->getSetting("404_background") ?>"
            }}'></div>
        </div>
    </section>
    <!-- END: Flex Callout -->
</div>
<!-- END: Page Feature -->
<!-- Page Content -->
<div class="page_content">
    <!-- Full Width Callouts -->
    <div class="full_width_callouts"> 
    </div>
    <!-- END: Full Width Callouts -->
</div>
<!-- END: Page Content -->