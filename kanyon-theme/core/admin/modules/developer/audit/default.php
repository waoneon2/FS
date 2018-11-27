<?
	$users = $admin->getUsers();
	$deleted_users = $cms->getSetting("bigtree-internal-deleted-users");
?>
<div class="container">
	<form method="get" action="<?=DEVELOPER_ROOT?>audit/search/">
		<? $admin->drawCSRFToken() ?>
		<section>
			<fieldset>
				<label>User</label>
				<select name="user">
					<option></option>
					<?
						foreach ($users as $user) {
					?>
					<option value="<?=$user["id"]?>"><?=$user["name"]?></option>
					<?
						}

						foreach ($deleted_users as $id => $user) {
					?>
					<option value="<?=$id?>"><?=$user["name"]?> (DELETED)</option>
					<?
						}
					?>
				</select>
			</fieldset>
			<fieldset>
				<label>Table</label>
				<select name="table">
					<option></option>
					<optgroup label="Core">
						<option value="bigtree_pages">Pages</option>
						<option value="bigtree_users">Users</option>
						<option value="bigtree_settings">Settings</option>
					</optgroup>
					<optgroup label="Modules">
						<? BigTree::getTableSelectOptions() ?>
					</optgroup>
				</select>
			</fieldset>
			<fieldset>
				<label>Start Date</label>
				<input type="text" name="start" autocomplete="off" class="date_time_picker" />
				<span class="icon_small icon_small_calendar date_picker_icon"></span>
			</fieldset>
			<fieldset>
				<label>End Date</label>
				<input type="text" name="end" autocomplete="off" class="date_time_picker" />
				<span class="icon_small icon_small_calendar date_picker_icon"></span>
			</fieldset>
		</section>
		<footer>
			<input type="submit" class="button blue" value="Search" />
		</footer>
	</form>
</div>