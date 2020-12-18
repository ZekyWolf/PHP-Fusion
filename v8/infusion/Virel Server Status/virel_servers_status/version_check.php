<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2017 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: version_check.php
| Author: Virel (virel.eu)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES . "templates/admin_header.php";
require_once INFUSIONS . "virel_servers_status/infusion_db.php";

if (file_exists(INFUSIONS . "virel_servers_status/locale/" . $settings['locale'] . ".php")) {
    include INFUSIONS . "virel_servers_status/locale/" . $settings['locale'] . ".php";
} else {
    include INFUSIONS . "virel_servers_status/locale/Slovak.php";
}

if (!checkrights("VSS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

include INFUSIONS."virel_servers_status/includes/admin_nav.php";

opentable($locale['vss_ver_000']);
echo "<div width='100%' class='tbl' align='center'>";
if(ini_get('allow_url_fopen') != false){ 
	if ($df_ddi_version = file_get_contents("https://www.virel.eu/updates/virel_servers_status.txt")) {
		if (preg_match("/^[0-9a-z\.]+$/", $df_ddi_version)) {
		    $in_version = dbarray(dbquery("SELECT inf_version FROM ".DB_INFUSIONS." WHERE inf_folder = 'virel_servers_status'"));	
            $inf_version = $in_version['inf_version'];
		    if (version_compare($df_ddi_version, $inf_version, ">")) {
			echo "<div class='tbl1' style='color:#DD0000; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['vss_ver_001']."</div>
			".$locale['vss_ver_002'].$inf_version."<br />
			".$locale['vss_ver_003'].$df_ddi_version."<br />
			".$locale['vss_ver_004']."";
		} else {
			echo "<div class='tbl1' style='color:#00BB00; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['vss_ver_005']."</div>
			".$locale['vss_ver_006'].$inf_version."<br />
			".$locale['vss_ver_007']; }
		} else {
			echo "<div class='tbl1' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['vss_ver_008']."</div>\n
			<div class='tbl1' style='display:none;'>".$locale['vss_ver_009']."</div>"; }
	    } else {
		    echo "<div class='tbl1' align='center' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['vss_ver_008']."</div></b>\n
		    <div class='tbl1' style='display:none;'>".$locale['vss_ver_009']."</div>"; }
        } else {
	        echo "<div class='tbl1' align='center' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['vss_ver_008']."</div>\n
		    <div class='tbl1' style='display:none;'>".$locale['vss_ver_010']."</div>"; }
            echo "</div>\n";
closetable();

require_once THEMES."templates/footer.php";
?>