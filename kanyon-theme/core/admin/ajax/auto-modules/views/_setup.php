<?
	header("Content-type: text/javascript");

	$admin->verifyCSRFToken();
	
	$id = sqlescape($_GET["id"]);

	// Grab View Data
	$view = BigTreeAutoModule::getView(sqlescape($_GET["view"]));
	$related_form = BigTreeAutoModule::getRelatedFormForView($view);
	$table = $view["table"];

	// Get module
	$module = $admin->getModule(BigTreeAutoModule::getModuleForView($view["id"]));

	// Get the item
	$current_item = BigTreeAutoModule::getPendingItem($table,$id);
	$item = $current_item["item"];

	// Check permission
	$access_level = $admin->getAccessLevel($module,$item,$table);

	if ($access_level != "n") {
		$original_item = BigTreeAutoModule::getItem($table,$id);
		$original_access_level = $admin->getAccessLevel($module,$original_item["item"],$table);

		if ($original_access_level != "p") {
			$access_level = $original_access_level;
		}
	}

	$run_publish_hook = function($changes) use ($id, $related_form, $table) {
		if (empty($related_form["hooks"]["publish"])) {
			return;
		}
		
		call_user_func($related_form["hooks"]["publish"], $table, $id, $changes, null, null);
	};
