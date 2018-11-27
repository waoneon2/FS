<script>
	(function() {
		var Current = false;
		var SearchTimer = false;

		$("#search").keyup(function() {
			clearTimeout(SearchTimer);
			SearchTimer = setTimeout("BigTree.localSearch();",400);
		});
		
		$(".table").on("click",".js-delete-hook",function() {
			Current = $(this);
			BigTreeDialog({
				title: "Delete Item",
				content: '<p class="confirm">Are you sure you want to delete this item?</p>',
				icon: "delete",
				alternateSaveText: "OK",
				callback: function() {
					// Allow custom delete implementations
					var href = BigTree.cleanHref(Current.attr("href"));
					// If it's just an ID, we're using the default delete implementation
					if (parseInt(href) || parseInt(href.substr(1))) {
						$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/delete/?view=<?=$bigtree["view"]["id"]?>&id=" + href);
						var row = Current.parents("li");
						var list = row.parents("ul");
						row.remove();
						if (!list.find("li").length) {
							var header = list.prev();
							if (header.hasClass("group")) {
								header.remove();
								list.remove();
							}
						}
					} else {
						document.location.href = href;
					}
				}
			});
	
			return false;
		}).on("click",".js-approve-hook",function() {
			<? if (($bigtree["view"]["type"] == "grouped" || $bigtree["view"]["type"] == "images-grouped") && $bigtree["view"]["options"]["group_field"] == "approved") { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/approve/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href"))).done(BigTree.localSearch);
			<? } else { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/approve/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href")));
			
			if ($(this).hasClass("icon_approve_on")) {
				$(this).attr("title", "Approve");
			} else {
				$(this).attr("title", "Unapprove");
			}

			$(this).toggleClass("icon_approve_on");
			<? } ?>
			return false;
		}).on("click",".js-feature-hook",function() {
			<? if (($bigtree["view"]["type"] == "grouped" || $bigtree["view"]["type"] == "images-grouped") && $bigtree["view"]["options"]["group_field"] == "featured") { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/feature/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href"))).done(BigTree.localSearch);
			<? } else { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/feature/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href")));

			if ($(this).hasClass("icon_feature_on")) {
				$(this).attr("title", "Feature");
			} else {
				$(this).attr("title", "Unfeature");
			}
			
			$(this).toggleClass("icon_feature_on");
			<? } ?>
			return false;
		}).on("click",".js-archive-hook",function() {
			<? if (($bigtree["view"]["type"] == "grouped" || $bigtree["view"]["type"] == "images-grouped") && $bigtree["view"]["options"]["group_field"] == "archived") { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/archive/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href"))).done(BigTree.localSearch);
			<? } else { ?>
			$.secureAjax("<?=ADMIN_ROOT?>ajax/auto-modules/views/archive/?view=<?=$bigtree["view"]["id"]?>&id=" + BigTree.cleanHref($(this).attr("href")));

			if ($(this).hasClass("icon_archive_on")) {
				$(this).attr("title", "Archive");
			} else {
				$(this).attr("title", "Restore");
			}

			$(this).toggleClass("icon_archive_on");
			<? } ?>
			return false;
		}).on("click",".js-disabled-hook",function() { return false; });
	})();
</script>