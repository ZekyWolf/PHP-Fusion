<?php
	//require_once "../../maincore.php";  
	if (!defined("IN_FUSION")) {
		die("Access Denied");
	}
	if (!defined("DB_ADMINS_USERS")) {
		define("DB_ADMINS_USERS", DB_PREFIX."admins_system_users");
	}
	if (!defined("DB_ADMINS_GROUPS")) {
		define("DB_ADMINS_GROUPS", DB_PREFIX."admins_system_groups");
	}
	if(!defined("AS_DIR")){
		define("AS_DIR", INFUSIONS."admin_system/");
	}
?>