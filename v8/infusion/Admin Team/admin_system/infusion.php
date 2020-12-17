<?php
include INFUSIONS . "admin_system/infusion_db.php";

$inf_newtable[1] = DB_ADMINS_USERS." (
	id int NOT NULL AUTO_INCREMENT,
	skupina VARCHAR(100) NOT NULL,
	user_id VARCHAR(100) NOT NULL,
	funkce VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM;";

$inf_newtable[2] = DB_ADMINS_GROUPS." (
	id int NOT NULL AUTO_INCREMENT,
	nazev VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=MyISAM;";


if (!defined("IN_FUSION")) { 
	die("Access Denied"); 
}

$inf_title = "Admin systém v3.5";
$inf_description = "Admin systém v3.5";
$inf_version = "3.5";
$inf_developer = "<strong>ZeXiiK</strong>";
$inf_email = "zexiceksk@gmail.com";
$inf_weburl = "https://zjecpelko.sk/";
$inf_folder = "admin_system";

$inf_adminpanel[1] = array(
	"title" => "Admin systém",
	"image" => "infusion_panel.gif",
	"panel" => "admin.php",
	"rights" => "AS");

$inf_droptable[1] = DB_ADMINS_USERS;
$inf_droptable[2] = DB_ADMINS_GROUPS;

?>