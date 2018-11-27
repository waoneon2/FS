<?php
	// Time Zone
	date_default_timezone_set("America/New_York");

	// Website Environment
	$bigtree["config"]["debug"] = true; // Set to false to stop all PHP errors/warnings from showing, or "full" to show all errors include notices and strict standards
	$bigtree["config"]["domain"] = "http://fastspot.loc/kanyon";	// "domain" should be http://www.website.com
	$bigtree["config"]["www_root"] = "http://fastspot.loc/kanyon/"; // "www_root" should be http://www.website.com/location/of/the/site/
	$bigtree["config"]["static_root"] = "http://fastspot.loc/kanyon/"; // "static_root" can either be the same as "www_root" or another domain that points to the same place -i t is used to server static files to increase page load time due to max connections per domain in most browsers.
	$bigtree["config"]["admin_root"] = "http://fastspot.loc/kanyon/admin/"; // "admin_root" should be the location you want to access BigTree's admin from, i.e. http://www.website.com/admin/
	$bigtree["config"]["force_secure_login"] = false; // If you have HTTPS enabled, set to true to force admin logins through HTTPS
	$bigtree["config"]["environment"] = ""; // "dev" or "live"; empty to hide
	$bigtree["config"]["environment_live_url"] = ""; // Live admin URL
	$bigtree["config"]["developer_mode"] = false; // Set to true to lock out all users except developers.
	$bigtree["config"]["maintenance_url"] = false; // Set to a URL to 307 redirect visitors to a maintenance page (driven by /templates/basic/_maintenance.php).
	$bigtree["config"]["routing"] = "htaccess";
	$bigtree["config"]["cache"] = false; // Enable Simple Caching
	$bigtree["config"]["cache_ttl"] = 300; // Number of seconds to keep a cached page
	$bigtree["config"]["sql_interface"] = "mysqli"; // Change to "mysql" to use legacy MySQL interface in PHP.
	$bigtree["config"]["image_memory_limit"] = "256M"; // Change to a higher value to allow BigTree to use more RAM when processing images.

	// Database Environment
	$bigtree["config"]["db"]["host"] = "localhost";
	$bigtree["config"]["db"]["name"] = "bigtree_kenyon";
	$bigtree["config"]["db"]["user"] = "root";
	$bigtree["config"]["db"]["password"] = "";
	$bigtree["config"]["db"]["port"] = "";
	$bigtree["config"]["db"]["socket"] = "";
	
	// Separate write database info (for load balanced setups)
	$bigtree["config"]["db_write"]["host"] = "";
	$bigtree["config"]["db_write"]["name"] = "";
	$bigtree["config"]["db_write"]["user"] = "";
	$bigtree["config"]["db_write"]["password"] = "";
	$bigtree["config"]["db_write"]["port"] = "";
	$bigtree["config"]["db_write"]["socket"] = "";
	
	/*
		Multi-Domain Support
		--------------------
		"trunk" should be set to the Page ID of the page that serves as the root-level page for the domain.
		The array key for each site will be defined as BIGTREE_SITE_KEY when you've been routed to that site.
		It should be alphanumeric as it is also used in tokenization of URLs.
	*/

	$bigtree["config"]["sites"] = array();

	/*
		Example
		=======
	
		$bigtree["config"]["sites"] = array(
			"primary" => array(
				"trunk" => 0,
				"domain" => "http://primary.bigtree.dev",
				"www_root" => "http://primary.bigtree.dev/",
				"static_root" => "http://primary.bigtree.dev/"
			),
			"alt" => array(
				"trunk" => 7,
				"domain" => "http://alt.bigtree.dev",
				"www_root" => "http://alt.bigtree.dev/",
				"static_root" => "http://alt.bigtree.dev/"
			)
		);
	*/
