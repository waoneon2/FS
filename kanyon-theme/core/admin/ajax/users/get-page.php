<?
	$admin->requireLevel(1);
	
	$query = isset($_GET["query"]) ? $_GET["query"] : "";
	$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;

	// Prevent SQL shenanigans
	$sort_by = "name";
	if (isset($_GET["sort"])) {
		$valid_columns = array("name","company","email");
		if (in_array($_GET["sort"],$valid_columns)) {
			$sort_by = $_GET["sort"];
		}
	}
	$sort_dir = (isset($_GET["sort_direction"]) && $_GET["sort_direction"] == "DESC") ? "DESC" : "ASC";

	$pages = $admin->getUsersPageCount($query);
	$results = $admin->getPageOfUsers($page,$query,"`$sort_by` $sort_dir");
	
	foreach ($results as $item) {
?>
<li id="row_<?=$item["id"]?>">
	<section class="view_column users_name"><span class="gravatar"><img src="<?=BigTree::gravatar($item["email"], 36)?>" alt="" /></span><?=$item["name"]?></section>
	<section class="view_column users_email"><?=htmlspecialchars($item["email"])?></section>
	<section class="view_column users_company"><?=$item["company"]?></section>
	<section class="view_action">
		<? if ($admin->Level >= $item["level"]) { ?>
		<a href="<?=ADMIN_ROOT?>users/edit/<?=$item["id"]?>/" class="icon_edit"></a>
		<? } else { ?>
		<span class="icon_edit disabled_icon has_tooltip" data-tooltip="<p><strong>Edit User</strong></p><p>You may not edit users with higher permission levels than you.</p>"></span>
		<? } ?>
	</section>
	<section class="view_action">
		<? if ($admin->ID == $item["id"]) { ?>
		<span class="icon_delete disabled_icon has_tooltip" data-tooltip="<p><strong>Delete User</strong></p><p>You may not delete yourself.</p>"></span>
		<? } elseif ($admin->Level >= $item["level"]) { ?>
		<a href="#<?=$item["id"]?>" class="icon_delete"></a>
		<? } else { ?>
		<span class="icon_delete disabled_icon has_tooltip" data-tooltip="<p><strong>Delete User</strong></p><p>You may not delete users with higher permission levels than you.</p>"></span>
		<? } ?>
	</section>
</li>
<?
	}
?>
<script>
	BigTree.setPageCount("#view_paging",<?=$pages?>,<?=$page?>);
</script>