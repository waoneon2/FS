<?
	if (!is_writable(SERVER_ROOT."cache/")) {
?>
<div class="container">
	<section>
		<h3>Error</h3>
		<p>Your <code>/cache/</code> directory must be writable.</p>
	</section>
</div>
<?
		$admin->stop();
	}
?>
<div class="container">
	<form method="post" action="<?=DEVELOPER_ROOT?>packages/install/unpack/" enctype="multipart/form-data">
		<? $admin->drawCSRFToken() ?>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?=BigTree::uploadMaxFileSize()?>" />
		<section>
			<?
				if ($_SESSION["upload_error"]) {
			?>
			<p class="error_message"><?=$_SESSION["upload_error"]?></p>
			<?
					unset($_SESSION["upload_error"]);
				}
				
				$admin->drawPOSTErrorMessage();
			?>
			<fieldset>
				<label>Package</label>
				<input type="file" name="file" />
			</fieldset>
		</section>
		<footer>
			<input type="submit" class="button blue" value="Unpack" />
		</footer>
	</form>
</div>