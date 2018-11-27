<?php
add_action('admin_head', 'custom_hide_cpt_on_chid_site');

function custom_hide_cpt_on_chid_site() {
?>
<style type="text/css">
	ul#adminmenu li#menu-posts-alerts_post,
	ul#adminmenu li#menu-posts-events_post,
	ul#adminmenu li#menu-posts-news_post,
	ul#adminmenu li#menu-posts-stories_post,
	ul#adminmenu li#menu-posts-programs_post {
		display: none !important;
	}
</style>
<?php
}