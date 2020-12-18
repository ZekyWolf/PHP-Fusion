<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2018 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: group.php
| Version: 1.3
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
include_once INFUSIONS . "virel_servers_status/includes/functions.php";

if (!checkrights("VSS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

include VSSBASE."includes/admin_nav.php";

if (isset($_GET['status']) && !isset($message)) {
	if ($_GET['status'] == "sn") {
		$message = $locale['vss_gp_001'];
	} elseif ($_GET['status'] == "su") {
		$message = $locale['vss_gp_002'];
	} elseif ($_GET['status'] == "del") {
		$message = $locale['vss_gp_003'];
	} elseif ($_GET['status'] == "deln") {
		$message = $locale['vss_gp_004']."<br />\n<span class='small'>".$locale['v_tm_031']."</span>";
	}
	if ($message) {	echo "<div id='close-message'><div class='admin-message'>".$message."</div></div>\n"; }
}

if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['v_gp_id']) && isnum($_GET['v_gp_id']))) {
	$data = dbarray(dbquery("SELECT * FROM ".DB_VIREL_S_STATUS_GROUP." WHERE v_gp_id='".$_GET['v_gp_id']."'"));
	$result = dbquery("DELETE FROM ".DB_VIREL_S_STATUS_GROUP." WHERE v_gp_id='".$_GET['v_gp_id']."'");
	redirect(FUSION_SELF.$aidlink."&status=del");
	
}

	if (isset($_POST['savegp'])) {
		$v_gp_name = stripinput($_POST['v_gp_name']);
		if ($v_gp_name != "") {
			if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['v_gp_id']) && isnum($_GET['v_gp_id']))) {
				$result = dbquery("UPDATE ".DB_VIREL_S_STATUS_GROUP." SET v_gp_name='".$v_gp_name."' WHERE v_gp_id='".$_GET['v_gp_id']."'");
				redirect(FUSION_SELF.$aidlink."&status=su");
			} else {
				$result = dbquery("INSERT INTO ".DB_VIREL_S_STATUS_GROUP." (v_gp_name) VALUES ('".$v_gp_name."')");
				redirect(FUSION_SELF.$aidlink."&status=sn");
			}
		} else {
			redirect(FUSION_SELF.$aidlink);
		}
	}
	if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['v_gp_id']) && isnum($_GET['v_gp_id']))) {
		$result = dbquery("SELECT v_gp_id, v_gp_name FROM ".DB_VIREL_S_STATUS_GROUP." WHERE v_gp_id='".$_GET['v_gp_id']."'");
		if (dbrows($result)) {
			$data = dbarray($result);
			$v_gp_name = $data['v_gp_name'];
			$formaction = FUSION_SELF.$aidlink."&amp;action=edit&amp;v_gp_id=".$data['v_gp_id'];
			opentable($locale['vss_gp_005']);
		} else {
			redirect(FUSION_SELF.$aidlink);
		}
	} else {
		$v_gp_name = "";
		$formaction = FUSION_SELF.$aidlink;
		opentable($locale['vss_gp_006']);
	}
	echo "<form name='layoutform' method='post' action='".$formaction."'>\n";
	echo "<table cellpadding='0' cellspacing='0' class='center'>\n<tr>\n";
	echo "<td class='tbl'>".$locale['vss_gp_007'].": <span style='color:#ff0000'>*</span></td>\n";
	echo "<td class='tbl'><input type='text' name='v_gp_name' value='".$v_gp_name."' maxlength='100' class='textbox' style='width:290px;' /></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' colspan='2' class='tbl'>\n";
	echo "<input type='submit' name='savegp' value='".$locale['vss_gp_006']."' class='button' /></td>\n";
	echo "</tr>\n</table>\n</form>\n";
	
	closetable();
	
	opentable($locale['vss_gp_009']);
	$group_list = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS_GROUP." ORDER BY v_gp_name ASC");
	echo "<table class='tbl-border center' cellspacing='1' cellpadding='0' width='100%'>\n";
	if(dbrows($group_list)) {
		echo "<tr>\n";
		echo "<td class='tbl2' style='font-weight:bold;'>#</td>\n";
		echo "<td class='tbl2' style='font-weight:bold;'>".$locale['vss_gp_007']."</td>\n";
		echo "<td class='tbl2' align='center' style='font-weight:bold;'></td>\n";
		echo "</tr>\n";
		$i = 0;
		$jk = 1;
		while($row = dbarray($group_list)) {
			
	
		$class = $i % 2 == 0 ? "tbl1" : "tbl2";
		echo "<tr>\n";
        echo "<td class='".$class."' width='50'>".$jk."</td>\n";
        echo "<td class='".$class."'>".$row['v_gp_name']."</td>\n";
		echo "<td class='".$class."' width='150' style='text-align:center;'>
				<a href='group.php".$aidlink."&amp;action=edit&amp;v_gp_id=".$row['v_gp_id']."'>".$locale['vss_gp_010']."</a> ||
				<a href='group.php".$aidlink."&amp;action=delete&amp;v_gp_id=".$row['v_gp_id']."' onclick=\"return confirm('".$locale['vss_gp_012']."');\">".$locale['vss_gp_011']."</a>
		</td>\n";
		echo "</tr>\n";
		$i++;
		$jk++;
		}
		
	} else {
    echo "<tr>\n<td align='center' class='tbl1'>".$locale['vss_gp_008']."</td>\n</tr>\n";
	}
	
	echo "</table>\n";
	
copy_virel_status();
closetable();
	

require_once THEMES . "templates/footer.php";
?>