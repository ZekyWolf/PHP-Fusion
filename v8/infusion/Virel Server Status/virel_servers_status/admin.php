<?php

/*-------------------------------------------------------+

| PHP-Fusion Content Management System

| Copyright (C) 2002 - 2018 Nick Jones

| http://www.php-fusion.co.uk/

+--------------------------------------------------------+

| Filename: admin.php

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



add_to_head("<link rel='stylesheet' href='".VSSBASE."css/alertify.core.css'/>

<link rel='stylesheet' href='".VSSBASE."css/font-awesome-4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>

<link rel='stylesheet' href='".VSSBASE."css/alertify.default.css' id='toggleCSS'/>

<script type='text/javascript' src='".VSSBASE."js/core.js'></script>

<script src='".VSSBASE."js/alertify.min.js'></script>

<style type='text/css'>

.rederror {  

    font-family: Verdana;

    font-size: 11px;

    color: #000000;

    text-align: center;

    border: 0px; 

    background-color: #E00000; 

    padding: 6px;

    }

.greensuccess {  

    font-family: Verdana;

    font-size: 11px;

    color: #000000;

    text-align: center;

    border: 0px; 

    background-color: #66CC33; 

    padding: 6px; 

    }   

</style>");





echo "<script>function Toggle(el) { el.style.display = (el.style.display == 'none') ? '' : 'none' }</script>";



$message = "";



if ((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['server_id']) && isnum($_GET['server_id']))) {

                

        $result = dbquery("DELETE FROM ".DB_VIREL_S_STATUS." WHERE v_status_id='".$_GET['server_id']."'");

		redirect(FUSION_SELF.$aidlink."&message=deleted");

        

	} elseif ((isset($_GET['action']) && $_GET['action'] == "moveup") && (isset($_GET['svrup_id']) && isnum($_GET['svrup_id']))) {

		$data = dbarray(dbquery("SELECT v_status_id FROM ".DB_VIREL_S_STATUS." WHERE v_status_order='".intval($_GET['order'])."'"));

		$result = dbquery("UPDATE ".DB_VIREL_S_STATUS." SET v_status_order=v_status_order+1 WHERE v_status_id='".$data['v_status_id']."'");

		$result = dbquery("UPDATE ".DB_VIREL_S_STATUS." SET v_status_order=v_status_order-1 WHERE v_status_id='".$_GET['svrup_id']."'");

		redirect(FUSION_SELF.$aidlink);

	

	} elseif ((isset($_GET['action']) && $_GET['action'] == "movedown") && (isset($_GET['svrdw_id']) && isnum($_GET['svrdw_id']))) {

		$data = dbarray(dbquery("SELECT v_status_id FROM ".DB_VIREL_S_STATUS." WHERE v_status_order='".intval($_GET['order'])."'"));

		$result = dbquery("UPDATE ".DB_VIREL_S_STATUS." SET v_status_order=v_status_order-1 WHERE v_status_id='".$data['v_status_id']."'");

		$result = dbquery("UPDATE ".DB_VIREL_S_STATUS." SET v_status_order=v_status_order+1 WHERE v_status_id='".$_GET['svrdw_id']."'");

		redirect(FUSION_SELF.$aidlink);



    }





if(isset($_POST['submit_add'])) {

    $ip = stripinput(trim($_POST['ip']));

    $port = isset($_POST['port']) && isNum($_POST['port'])  ? $_POST['port'] : "27015";

	$q_port = (!empty($_POST['q_port'])) ? $_POST['q_port'] : 0;

	$type = stripinput($_POST['type']);

	$vip_url = stripinput($_POST['vip_url']);

	$bl_url = stripinput($_POST['bl_url']);

	$hl_url = stripinput($_POST['hl_url']);

	$gp_groups = stripinput($_POST['gp_groups']);

	$vorder = isset($_POST['vorder']) && isNum($_POST['vorder']) ? $_POST['vorder'] : "";

	if(!$vorder) $vorder=dbresult(dbquery("SELECT MAX(v_status_order) FROM ".DB_VIREL_S_STATUS),0)+1;

	

	

	if((empty($ip)) && (empty($port))) {

		redirect(FUSION_SELF.$aidlink."&message=error");

	} else {

			

	$servadd = dbquery("INSERT INTO ".DB_VIREL_S_STATUS." (v_status_ip,v_status_port,v_status_q_port,v_status_type,v_status_vote,v_status_order,v_status_vip_url,v_status_bl_url,v_status_hl_stats_url,v_status_group) VALUES('$ip','$port','$q_port','$type','0','$vorder','$vip_url','$bl_url','$hl_url','$gp_groups')");

			if ($servadd) {

			redirect(FUSION_SELF.$aidlink."&message=saved");            	

			} else {

		    redirect(FUSION_SELF.$aidlink."&message=error2");            	

			}

	}

		      

}



$formaction = FUSION_SELF.$aidlink;



if (isset($_GET['message']) && $message == "") {

		if ($_GET['message'] == "saved") {

			$message .= $locale['vss_007'];

		} elseif ($_GET['message'] == "deleted") {

			$message .= $locale['vss_008'];

		} elseif ($_GET['message'] == "error") {

			$message .= $locale['vss_009'];	

		} elseif ($_GET['message'] == "error2") {

			$message .= $locale['vss_010'];	

		}	

	}

	if ($message != "") {  echo "<div id='close-message'><div class='admin-message'>".$message."</div></div>\n"; }



opentable($locale['vss_011']);



// Table

	

	echo "<table class='tbl-border' cellpadding='0' cellspacing='0' align='left'>\n<tr>\n";

	echo "<tr>\n";

		echo "<td class='tbl2' align='center' style='font-weight:bold;'>Keď zobrazí server offline:</td>\n";

	echo "</tr>\n";

	

	

	echo "<tr>\n";

		echo "<td class='tbl1' align='left' style='white-space: nowrap'><b>Minecraft</b> -  nastavte na servery enable-query=<b>true</b></td>\n";

	echo "</tr>\n";

	echo "<tr>\n";

		echo "<td class='tbl1' align='left' style='white-space: nowrap'><b>TeamSpeak2/3</b> -  použite query_port = <b>10011</b></td>\n";

	echo "</tr>\n";

	echo "</tr>\n</table>\n";



		echo "<form name='inputform' method='post' action='$formaction' enctype='multipart/form-data'>\n";

		echo "<table cellspacing='0' cellpadding='0' class='center'>\n<tr>\n";

        echo "<td class='tbl'>IP <span style='color:#ff0000'>*</span></td>\n";

        echo "<td class='tbl'><input type='text' id='ip' name='ip' value='' placeholder='120.120.120.120' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

        echo "</tr>\n<tr>\n";

        echo "<td valign='top' class='tbl'>Port <span style='color:#ff0000'>*</span></td>\n";

		echo "<td class='tbl'><input type='text' id='port' name='port' value='' placeholder='27015' maxlength='100' class='textbox' style='width:150px;' /></td>\n";

        echo "</tr>\n<tr>\n";

        echo "<td valign='top' class='tbl'>Query Port <span style='color:#ff0000'>*</span></td>\n";

		echo "<td class='tbl'><input type='text' id='q_port' name='q_port' value='' placeholder='27015' maxlength='100' class='textbox' style='width:150px;' /></td>\n";

		echo "</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_013']." <span style='color:#ff0000'>*</span></td>\n";

        echo "<td class='tbl'><select id='type' name='type' class='textbox' style='width:150px;'>\n";

		echo "<option value=''>".$locale['vss_012']."</option>\n";

		foreach ($protocols AS $gameq => $info) {

            echo '<option value="'.$gameq.'">'.htmlentities($info['name']).'</option>';

		}

		echo "</select>\n";

		echo "</td>\n</tr>\n";

		echo "<tr><td colspan='2' align='center' class='tbl'><input id='serverchecked' type='hidden' name='serverchecked' value='0'>";

		echo "<center><a class='btn btn-xs btn-info' href='javascript:checkConnection();'>".$locale['vss_014']." <i class='fa fa-refresh'></i></a></center>";

		echo "</td>\n</tr>\n";

		echo "<center><div id='connection_status' class='control-group col-md-3' style=''>

			<label class='control-label' for='connection_notice'></label>

			<div id='connection_notice'></div>

			</div></center>";

		echo "<tr>\n";

		echo "<td class='tbl'>".$locale['vss_036']."</td>\n";

		echo "<td class='tbl'><select name='gp_groups' class='textbox' style='width: 200px;'><option value='-'>".$locale['vss_037']."</option>";

				$result = dbquery("SELECT v_gp_id, v_gp_name FROM ".DB_VIREL_S_STATUS_GROUP." ORDER BY v_gp_name");

				while ($group_list = dbarray($result)) {

					echo "<option value='".$group_list['v_gp_id']."'>".$group_list['v_gp_name']."</option>";

				}

		echo "</select></td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_015']."</td>\n";

        echo "<td class='tbl'><input type='text' name='vip_url' value='' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_034']."</td>\n";

        echo "<td class='tbl'><input type='text' name='bl_url' value='' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_035']."</td>\n";

        echo "<td class='tbl'><input type='text' name='hl_url' value='' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n";

        echo "<tr>\n";

    

        echo "<td colspan='2' align='center' class='tbl'><br />\n";

        echo "<input type='submit' name='submit_add' value='".$locale['vss_016']."' class='button' />\n";

       

        echo "</td>\n</tr>\n</table>\n</form>\n";

		

closetable();





if (isset($_POST['id']) && $_POST['submit_edit']) {

	

		$id = stripinput(trim($_POST['id']));

		$ip = stripinput(trim($_POST['ip']));

		$port = isset($_POST['port']) && isNum($_POST['port'])  ? $_POST['port'] : "27015";

		$query_port = (!empty($_POST['query_port'])) ? $_POST['query_port'] : 0;

		$type = stripinput($_POST['type']);

		$vip_url = stripinput($_POST['vip_url']);

		$bl_url = stripinput($_POST['bl_url']);

		$hl_url = stripinput($_POST['hl_url']);

		$v_vote = stripinput($_POST['v_vote']);

		$gp_groups = stripinput($_POST['gp_groups']);

		

	dbquery("UPDATE ".DB_VIREL_S_STATUS." SET v_status_ip='$ip', v_status_port='$port', v_status_q_port='$query_port', v_status_type='$type', v_status_vip_url='$vip_url', v_status_bl_url='$bl_url', v_status_hl_stats_url='$hl_url', v_status_vote='$v_vote', v_status_group='$gp_groups' WHERE v_status_id='$id'") or die (mysql_error());

}





opentable($locale['vss_017']);

	$serv_list = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS);

	echo "<table class='tbl-border center' cellspacing='1' cellpadding='0' width='100%'>\n";

	if(dbrows($serv_list)) {

		echo "<tr>\n";

		echo "<td class='tbl2' align='center' valign='middle' width='10' style='font-weight:bold;'>#</td>\n";

		echo "<td class='tbl2' align='left' valign='middle' style='font-weight:bold;'>".$locale['vss_029']."</td>\n";

		echo "<td class='tbl2' align='left' valign='middle' style='font-weight:bold;'>".$locale['vss_038']."</td>\n";

		echo "<td class='tbl2' align='left' valign='middle' style='font-weight:bold;'>IP/PORT</td>\n";

		echo "<td class='tbl2' width='50' style='text-align:center;font-weight:bold;'>".$locale['vss_018']."</td>\n";

		echo "<td class='tbl2' width='100' style='text-align:center;font-weight:bold;'>".$locale['vss_019']."</td>\n";

		echo "</tr>\n";

		$i = 0;

		$j = 1;

		while($row = dbarray($serv_list)) {



			$server_type = $row['v_status_type'];

			$server_ip = $row['v_status_ip'];

			$server_port = $row['v_status_port'];

			$server_q_port = $row['v_status_q_port'];

			

			$host = $server_ip . ':' . $server_port;

			

		$GameQ = new \GameQ\GameQ();

		$GameQ->addServer([

			'type' => $server_type,

			'host' => $host,

			'options' => [

				'query_port' => $server_q_port

			]

		]);

		$GameQ->setOption('timeout', 3);

		$results = $GameQ->process();

		

		$server = $results[$server_ip.':'.$server_port];

		



        $class = $i % 2 == 0 ? "tbl1" : "tbl2";

        echo "<tr>\n";

        echo "<td class='".$class."' width='10'>".icon_type($server_type)."</td>\n";

        echo "<td class='".$class."'>".$server['gq_hostname']."</td>\n";

		echo "<td class='".$class."'>".groups_name($row['v_status_group'])."</td>\n";

		echo "<td class='".$class."'>".$row['v_status_ip'].":".$row['v_status_port']."</td>\n";

		echo "<td class='".$class."' width='50' style='text-align:center;'>\n";

				if (dbrows($serv_list) != 1) {

				$up = $row['v_status_order'] - 1;

				$down = $row['v_status_order'] + 1;

			

				if ($j == 1) {

					echo "<a href='".FUSION_SELF.$aidlink."&amp;action=movedown&amp;order=$down&amp;svrdw_id=".$row['v_status_id']."'><img src='".get_image("down")."' alt='".$locale['vss_021']."' title='".$locale['vss_023']."' style='border:0px;' /></a>\n";

				} elseif ($j < dbrows($serv_list)) {

					echo "<a href='".FUSION_SELF.$aidlink."&amp;action=moveup&amp;order=$up&amp;svrup_id=".$row['v_status_id']."'><img src='".get_image("up")."' alt='".$locale['vss_020']."' title='".$locale['vss_022']."' style='border:0px;' /></a>\n";

					echo "<a href='".FUSION_SELF.$aidlink."&amp;action=movedown&amp;order=$down&amp;svrdw_id=".$row['v_status_id']."'><img src='".get_image("down")."' alt='".$locale['vss_021']."' title='".$locale['vss_023']."' style='border:0px;' /></a>\n";

				} else {

					echo "<a href='".FUSION_SELF.$aidlink."&amp;action=moveup&amp;order=$up&amp;svrup_id=".$row['v_status_id']."'><img src='".get_image("up")."' alt='".$locale['vss_020']."' title='".$locale['vss_022']."' style='border:0px;' /></a>\n";

				}

			}

		echo "</td>";

		echo "<td class='".$class."'  width='100' align='center' style='white-space: nowrap'>"; ?><a href="javascript:;" onclick="$('#addpages-<?php echo $row['v_status_id']; ?>').toggle();"><?php echo "".$locale['vss_024']."</a> - <a href='".FUSION_SELF.$aidlink."&amp;action=delete&amp;server_id=".$row['v_status_id']."' onclick=\"return confirm('".$locale['vss_026']."');\">".$locale['vss_025']."</a></td>\n";

		

		echo '<td colspan="7" style="display: none;"></td>';

		echo "</tr>\n";

		echo '<tr><td colspan="7" style="display: none;" id="addpages-'.$row['v_status_id'].'">';

		echo "<form name='inputform' method='post' action='$formaction' enctype='multipart/form-data'>\n";

		echo "<table cellspacing='0' cellpadding='0' class='center'>\n<tr>\n";

        echo "<td class='tbl'>IP</td>\n";

        echo "<td class='tbl'><input type='text' name='ip' value='".$row['v_status_ip']."' placeholder='120.120.120.120' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

        echo "</tr>\n<tr>\n";

        echo "<td valign='top' class='tbl'>Port</td>\n";

		echo "<td class='tbl'><input type='text' name='port' value='".$row['v_status_port']."' placeholder='27000' maxlength='100' class='textbox' style='width:150px;' /></td>\n";

        echo "</tr>\n<tr>\n";

        echo "<td valign='top' class='tbl'>Query Port</td>\n";

		echo "<td class='tbl'><input type='text' name='query_port' value='".$row['v_status_q_port']."' placeholder='27000' maxlength='100' class='textbox' style='width:150px;' /></td>\n";

		echo "</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_013']."</td>\n";

        echo "<td class='tbl'>";

		$resulttype = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS." WHERE v_status_id='".$row['v_status_id']."' "); 

		echo "<select name='type' class='textbox' style='width:150px;'>\n";

		foreach ($protocols AS $gameq => $info) {

		echo "<option ".($gameq == $server_type ? "selected='selected'" : "")." value='{$gameq}'>".htmlentities($info['name'])."</option>";

        }

		if (!isset($protocols[$server_type])) {

			echo "<option selected='selected' value='".$server_type."'>".$server_type."</option>";

        }

		echo "</select>\n";

		echo "</td>\n</tr>\n<tr>\n";

		echo "<td class='tbl'>".$locale['vss_036'].": <span style='color:#ff0000'>*</span></td>\n";

		echo "<td class='tbl'><select name='gp_groups' class='textbox' style='width: 200px;'><option value='-'>".$locale['vss_037']."</option>";
				

				$result = dbquery("SELECT v_gp_id, v_gp_name FROM ".DB_VIREL_S_STATUS_GROUP." ORDER BY v_gp_name");

				while ($group_list = dbarray($result)) {

					echo "<option".($row['v_status_group'] == $group_list['v_gp_id'] ? " selected='selected'" : "")." value='".$group_list['v_gp_id']."'>".$group_list['v_gp_name']."</option>";

				}

		echo "</select></td>\n";

		echo "</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_015']."</td>\n";

        echo "<td class='tbl'><input type='text' name='vip_url' value='".$row['v_status_vip_url']."' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_034']."</td>\n";

        echo "<td class='tbl'><input type='text' name='bl_url' value='".$row['v_status_bl_url']."' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_035']."</td>\n";

        echo "<td class='tbl'><input type='text' name='hl_url' value='".$row['v_status_hl_stats_url']."' placeholder='http://' maxlength='100' class='textbox' style='width:330px;' /></td>\n";

		echo "</td>\n</tr>\n<tr>\n";

        echo "<td class='tbl'>".$locale['vss_027']."</td>\n";

        echo "<td class='tbl'><input type='text' name='v_vote' value='".$row['v_status_vote']."' placeholder='1' maxlength='100' class='textbox' style='width:40px;' /></td>\n";

        echo "</td>\n</tr>\n<tr>\n";



		echo '<input name="id" type="hidden" value="'.$row['v_status_id'].'" />';

        echo "<td colspan='2' align='center' class='tbl'><br />\n";

        echo "<input type='submit' name='submit_edit' value='".$locale['vss_028']."' class='button' />\n";

       

        echo "</td>\n</tr>\n</table>\n</form>\n";

		echo "</td>\n</tr>";



		echo "</tr>\n";

		

		$j++;

		

}		

        $i++;

    } else {

    echo "<tr>\n<td align='center' class='tbl1'>".$locale['vss_p_003']."</td>\n</tr>\n";

}



echo "</table>\n";



closetable();



copy_virel_status2();



require_once THEMES . "templates/footer.php";

?>