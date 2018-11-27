<?
	// Include pages.js
	$bigtree["js"][] = "pages.js";
	
	// See if the user isn't allowed to use the currently in use template. If they can't, we hide the section altogether.
	$hide_template_section = false;
	if (is_array($template_data) && $template_data["level"] > $admin->Level) {
		$hide_template_section = true;
	}
?>
<div class="container">
	<header>
		<div class="sticky_controls">
			<div class="shadow">
				<nav class="left">
					<a href="#properties_tab"<? if ($bigtree["form_action"] == "create") { ?> class="active"<? } ?>>Properties</a>
					<a href="#content_tab"<? if ($bigtree["form_action"] == "update") { ?> class="active"<? } ?>>Content</a>
					<a href="#seo_tab">SEO</a>
				</nav>
				<div id="link_finder_results" style="display: none;"></div>
				<input type="search" id="link_finder" class="form_search" autocomplete="off" placeholder="Link Finder" />
				<span class="form_search_icon link_finder_search_icon"></span>
			</div>
		</div>
	</header>
	<form method="post" class="module" action="<?=ADMIN_ROOT?>pages/<?=$bigtree["form_action"]?>/" enctype="multipart/form-data" id="page_form">
		<?
			$admin->drawCSRFToken();
			
			if (isset($_GET["return"]) && $_GET["return"] == "front") {
		?>
		<input type="hidden" name="return_to_front" value="true" />
		<?
			}
			if (isset($_GET["return_to_self"])) {
		?>
		<input type="hidden" name="return_to_self" value="true" />
		<?
			}
		?>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?=BigTree::uploadMaxFileSize()?>" id="bigtree_max_file_size" />
		<input type="hidden" name="<? if ($bigtree["form_action"] == "create") { ?>parent<? } else { ?>page<? } ?>" value="<?=$bigtree["current_page"]["id"]?>" />
		
		<section id="properties_tab"<? if ($bigtree["form_action"] == "update") { ?> style="display: none;"<? } ?>>
			<? include BigTree::path("admin/modules/pages/tabs/properties.php"); ?>
		</section>
		<section id="content_tab"<? if ($bigtree["form_action"] == "create") { ?> style="display: none;"<? } ?>>
			<? include BigTree::path("admin/modules/pages/tabs/content.php"); ?>
		</section>
		<section id="seo_tab" style="display: none;">
			<? include BigTree::path("admin/modules/pages/tabs/seo.php"); ?>
		</section>
		<footer>
			<a href="#" class="next button">Next Step &raquo;</a>

			<?
				if ($bigtree["form_action"] == "create") {
			?>
			<input type="submit" name="ptype" value="Create" <? if ($bigtree["access_level"] != "p") { ?>class="blue" <? } ?>/>
			<?
					if ($bigtree["access_level"] == "p") {
			?>
			<input type="submit" name="ptype" value="Create &amp; Publish" class="blue" />
			<?
					}
				} else {
			?>
			<a href="#" class="button save_and_preview"><span class="icon_small icon_small_computer"></span>Save &amp; Preview</a>
			<input type="submit" name="ptype" value="Save"<? if ($bigtree["access_level"] != "p") { ?> class="blue"<? } ?> />
			<?
					if ($bigtree["access_level"] == "p") {
			?>
			<input type="submit" name="ptype" value="Save &amp; Publish" class="blue" />
			<?
					}
				}
			?>
		</footer>
	</form>
</div>

<script>
	BigTreeFormNavBar.init();

	BigTree.currentPageTemplate = "<?=$bigtree["current_page"]["template"]?>";
	<? if ($bigtree["form_action"] == "create") { ?>
	BigTree.currentPage = false;
	<? } else { ?>
	BigTree.currentPage = "<?=$bigtree["current_page"]["id"]?>";
	BigTree.localLockTimer = setInterval("$.secureAjax('<?=ADMIN_ROOT?>ajax/refresh-lock/', { type: 'POST', data: { table: 'bigtree_pages', id: '<?=$bigtree["current_page"]["id"]?>' } });",60000);
	<? } ?>
</script>