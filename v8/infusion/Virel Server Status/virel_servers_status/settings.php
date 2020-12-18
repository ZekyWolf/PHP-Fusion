<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2018 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: settings.php
| Version: 1.3
| Author: Virel (virel.eu)
| Web/Support: https://www.virel.eu/
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

if (isset($_POST['save_settings'])) {
	$v_sett_vip = (isset($_POST['v_sett_vip']) && isnum($_POST['v_sett_vip'])) ? $_POST['v_sett_vip'] : "1";
	$v_sett_vote = (isset($_POST['v_sett_vote']) && isnum($_POST['v_sett_vote'])) ? $_POST['v_sett_vote'] : "1";
	$v_sett_percplayer = (isset($_POST['v_sett_percplayer']) && isnum($_POST['v_sett_percplayer'])) ? $_POST['v_sett_percplayer'] : "1";
	$v_sett_map = (isset($_POST['v_sett_map']) && isnum($_POST['v_sett_map'])) ? $_POST['v_sett_map'] : "1";
	$v_sett_show_pl = (isset($_POST['v_sett_show_pl']) && isnum($_POST['v_sett_show_pl'])) ? $_POST['v_sett_show_pl'] : "1";
	$v_sett_show_bl = (isset($_POST['v_sett_show_bl']) && isnum($_POST['v_sett_show_bl'])) ? $_POST['v_sett_show_bl'] : "1";
	$v_sett_show_hl = (isset($_POST['v_sett_show_hl']) && isnum($_POST['v_sett_show_hl'])) ? $_POST['v_sett_show_hl'] : "1";
	$v_sett_group = (isset($_POST['v_sett_group']) && isnum($_POST['v_sett_group'])) ? $_POST['v_sett_group'] : "1";
	$v_sett_vote_time = (isset($_POST['v_sett_vote_time']) && $_POST['v_sett_vote_time']) ? $_POST['v_sett_vote_time'] : "86400";
    $result = dbquery("UPDATE ".DB_VIREL_S_STATUS_SETT." SET
					   v_sett_vip='".$v_sett_vip."',
	                   v_sett_vote='".$v_sett_vote."',
					    v_sett_percplayer='".$v_sett_percplayer."',
						v_sett_map='".$v_sett_map."',
						v_sett_show_pl='".$v_sett_show_pl."',
						v_sett_show_bl='".$v_sett_show_bl."',
						v_sett_show_hl='".$v_sett_show_hl."',
						v_sett_group='".$v_sett_group."',
						v_sett_vote_time='".$v_sett_vote_time."'
				 ");
	redirect(FUSION_SELF.$aidlink);
}
 
	$data = dbarray(dbquery("SELECT * FROM ".DB_VIREL_S_STATUS_SETT));
		
		$v_sett_vip = (isset($data['v_sett_vip']) && isnum($data['v_sett_vip'])) ? $data['v_sett_vip'] : "1";
		$v_sett_vote = (isset($data['v_sett_vote']) && isnum($data['v_sett_vote'])) ? $data['v_sett_vote'] : "1";
		$v_sett_percplayer = (isset($data['v_sett_percplayer']) && isnum($data['v_sett_percplayer'])) ? $data['v_sett_percplayer'] : "1";
		$v_sett_map = (isset($data['v_sett_map']) && isnum($data['v_sett_map'])) ? $data['v_sett_map'] : "1";
		$v_sett_show_pl = (isset($data['v_sett_show_pl']) && isnum($data['v_sett_show_pl'])) ? $data['v_sett_show_pl'] : "1";
		$v_sett_show_bl = (isset($data['v_sett_show_bl']) && isnum($data['v_sett_show_bl'])) ? $data['v_sett_show_bl'] : "1";
		$v_sett_show_hl = (isset($data['v_sett_show_hl']) && isnum($data['v_sett_show_hl'])) ? $data['v_sett_show_hl'] : "1";
		$v_sett_group = (isset($data['v_sett_group']) && isnum($data['v_sett_group'])) ? $data['v_sett_group'] : "1";
		$v_sett_vote_time= (isset($data['v_sett_vote_time']) && $data['v_sett_vote_time']) ? $data['v_sett_vote_time'] : "86400";
 
 		
  opentable($locale['vss_set_001']);
  echo "<table align='center' width='40%' cellspacing='1' cellpadding='0'>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_004']."</strong></td>\n";
  if($v_sett_vip == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_005']."</strong></td>\n";
  if($v_sett_vote == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_009']."</strong></td>\n";
  if($v_sett_percplayer == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_010']."</strong></td>\n";
  if($v_sett_map == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
   echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_011']."</strong></td>\n";
  if($v_sett_show_pl == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_012']."</strong></td>\n";
  if($v_sett_show_bl == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_013']."</strong></td>\n";
  if($v_sett_show_hl == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_014']."</strong></td>\n";
  if($v_sett_group == "1") {
  echo "<td class='tbl2'><span style='color:green;'>".$locale['vss_set_002']."</span></td>\n";
  } else { echo "<td class='tbl2'><span style='color:red;'>".$locale['vss_set_003']."</span></td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_sett_001']."</strong></td>\n";
  if($v_sett_vote_time == "86400") {
  echo "<td class='tbl2'>".$locale['vss_sett_002']."</td>\n";
  } elseif($v_sett_vote_time == "7200") { echo "<td class='tbl2'>".$locale['vss_sett_004']."</td>\n"; 
  } elseif($v_sett_vote_time == "3600") { echo "<td class='tbl2'>".$locale['vss_sett_005']."</td>\n"; 
  } elseif($v_sett_vote_time == "172800") { echo "<td class='tbl2'>".$locale['vss_sett_003']."</td>\n"; 
  } elseif($v_sett_vote_time == "2592000") { echo "<td class='tbl2'>".$locale['vss_sett_006']."</td>\n"; }
  echo "</tr>\n<tr>\n";
  echo "</table>\n";
 closetable();
 
 // Infusion version
	$version_data = dbarray(dbquery("SELECT inf_version FROM ".DB_INFUSIONS." WHERE inf_folder = 'virel_servers_status'"));	
	$version = $version_data['inf_version'];
 
 opentable($locale['vss_sett_007']." Virel servers status v".$version);
  echo "<form name='inputform' method='post' action='".FUSION_SELF.$aidlink."'>\n";
  echo "<table align='center' width='40%' cellspacing='1' cellpadding='0'>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_004']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_vip' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_vip == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_vip == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_005']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_vote' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_vote == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_vote == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_009']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_percplayer' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_percplayer == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_percplayer == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_010']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_map' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_map == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_map == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_011']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_show_pl' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_show_pl == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_show_pl == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_012']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_show_bl' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_show_bl == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_show_bl == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_013']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_show_hl' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_show_hl == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_show_hl == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_set_014']." - servers_status.php</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_group' class='textbox'>\n";
  echo "<option style='color:red;' value='0'".($v_sett_group == "0" ? " selected='selected'" : "").">".$locale['YN']['N']."</option>\n";
  echo "<option style='color:green;' value='1'".($v_sett_group == "1" ? " selected='selected'" : "").">".$locale['YN']['Y']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['vss_sett_001']."</strong></td>\n";
  echo "<td class='tbl2'><select name='v_sett_vote_time' class='textbox'>\n";
  echo "<option value='2592000'".($v_sett_vote_time == "2592000" ? " selected='selected'" : "").">".$locale['vss_sett_006']."</option>\n";
  echo "<option value='172800'".($v_sett_vote_time == "172800" ? " selected='selected'" : "").">".$locale['vss_sett_003']."</option>\n";
  echo "<option value='86400'".($v_sett_vote_time == "86400" ? " selected='selected'" : "").">".$locale['vss_sett_002']."</option>\n";
  echo "<option value='7200'".($v_sett_vote_time == "7200" ? " selected='selected'" : "").">".$locale['vss_sett_004']."</option>\n";
  echo "<option value='3600'".($v_sett_vote_time == "3600" ? " selected='selected'" : "").">".$locale['vss_sett_005']."</option>\n";
  echo "</select></td>\n";
  echo "</tr>\n<tr>\n";
  echo "<td align='center' colspan='2' class='tbl'>";
  echo "<input type='submit' name='save_settings' value='".$locale['vss_set_008']."' class='button' style='align:center;' />\n";
  echo "</tr>\n</table>\n</form>\n";
    add_to_footer("<script type='text/javascript'>
/* <![CDATA[ */
jQuery(document).ready(function() {
	$('.tbl2 select').change(function () {
		var color = $('option:selected', this).attr('style');
		$(this).attr('style', color);
	});

	$('.tbl2 select').each(function () {
		var color = $('option[selected=selected]', this).attr('style');
		$(this).attr('style', color);
	});
	
});
/* ]]>*/
</script>");
copy_virel_status2();
closetable();

require_once THEMES."templates/footer.php";
?>