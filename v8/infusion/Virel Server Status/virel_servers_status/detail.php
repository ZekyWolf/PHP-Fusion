<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2018 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: detail.php
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
require_once THEMES."templates/header.php";

require_once INFUSIONS."virel_servers_status/includes/functions.php";

include_once VSSBASE."includes/header.php";

$id = isset($_GET['id']) && isNum($_GET['id']) ? $_GET['id'] : "0";
$rows = dbarray(dbquery("SELECT * FROM ".DB_VIREL_S_STATUS." WHERE v_status_id = '".$id."'"));
	if ($rows !=0) {
		$server_ip = $rows['v_status_ip'];
		$server_port = $rows['v_status_port'];
		$server_type = $rows['v_status_type'];
		$server_q_port = $rows['v_status_q_port'];
			
			$host = $server_ip . ':' . $server_port;
			
			$GameQ = new \GameQ\GameQ();
			$GameQ->addServer([
				'type' => $server_type,
				'host' => $host,
				'options' => [
					'query_port' => $server_q_port,
				],
			]);
			$GameQ->setOption('timeout', 3);
			$results = $GameQ->process();
			
	$server_info = $results[$server_ip.':'.$server_port];
	
	$vote = '<span id="serv'.$rows['v_status_id'].'-layer">'.$rows['v_status_vote'].'</span><span style="cursor:pointer;
					" onclick="vote('.$rows['v_status_id'].',\'up\',\'\');"> <span id="serv'.$rows['v_status_id'].'-button"><i class="icon-arrow-up"></i></span>';
	

	
	if ($server_info['gq_mapname']) {
    $image_map = "images/maps/".$server_type."/".$server_info['gq_mapname'].".jpg";
	} else {
    $image_map = "images/nomap.jpg";
	}
	
opentable($server_info['gq_hostname']);
			
	
echo "<table width='100%' cellpadding='0' cellspacing='1' class='tbl-border'>
		<tr align='center'>
		<td width='200' class='tbl2'>".(isset($server_info['gq_mapname']) ? $server_info['gq_mapname'] : "--")."</td>
		<td colspan='2' class='tbl2' class='tbl2'>".(isset($server_info['gq_hostname']) ? htmlentities($server_info['gq_hostname']) : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='200' align='center' rowspan='8' class='tbl1' valign='top'><img src='".$image_map."'></td>
		<td class='tbl1'>".$locale['vss_de_003']."</td>
		<td class='tbl1'>".(isset($server_info['gq_address']) ? $server_info['gq_address'] : "--").":".(isset($server_port) ? $server_port : "--")." ".connect_type($server_type,$server_ip,$server_port)."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_001']."</td>
		<td class='tbl1' width='70%'>".(isset($server_info['gq_name']) ? $server_info['gq_name'] : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_002']."</td>
		<td class='tbl1' width='70%'>".(isset($server_info['gq_numplayers']) ? $server_info['gq_numplayers'] : "--")." / ".(isset($server_info['gq_maxplayers']) ? $server_info['gq_maxplayers'] : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_004']."</td>
		<td class='tbl1' width='70%'>".(isset($server_info['map']) ? $server_info['map'] : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_005']."</td>
		<td class='tbl1' width='70%'>".(isset($server_info['amx_nextmap']) ? $server_info['amx_nextmap'] : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_006']."</td>
		<td class='tbl1' width='70%'>".(isset($server_info['mp_autoteambalance']) ? $server_info['mp_autoteambalance'] : "--")."</td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_010']."</td>
		<td class='tbl1' width='70%'><a href='".(isset($rows['v_status_vip_url']) ? $rows['v_status_vip_url'] : "--")." class='vip''>VIP</a></td>
		</tr><tr>
		<td class='tbl1' width='30%'>".$locale['vss_de_009']."</td>
		<td class='tbl1' width='70%'>".$vote."</td>
		</tr><tr>
		<td class='tbl1'>".$locale['vss_de_008'].": ".($server_info['version'] ? $server_info['version'] : "--")."</td>
		<td class='tbl1'>".$locale['vss_de_007']."</td>
		<td class='tbl1'>".(isset($server_info['mp_friendlyfire']) ? $server_info['mp_friendlyfire'] : "--")."</td>
		</tr></table><br>";

if ($vsettings['v_sett_show_pl'] == "1") {		
		
echo "<table width='100%' cellpadding='0' cellspacing='1' class='tbl-border'>
		<tr align='center'>
		<td colspan='5' class='tbl2'>".$locale['vss_de_011']."</td>
		</tr>
		<tr>
		<td class='tbl1' width='1%' align='center'><span class=small2>#</span></td>
		<td class='tbl1'><span class=small2>".$locale['vss_de_013']."</span></td>
		<td class='tbl1' width='1%' align='center'><span class=small2>".$locale['vss_de_014']."</span></td>
		<td class='tbl1' width='10%' align='center'><span class=small2>".$locale['vss_de_015']."</span></td>
		<td class='tbl1' width='1%' align='center'><span class=small2>".$locale['vss_de_016']."</span></td>
		</tr>";
		
	$ii=1;
	foreach( $server_info['players'] as $player ) {
echo "<tr>
		<td class='tbl1' align='center'>".($ii++)."</td>
		<td class='tbl1'>".htmlspecialchars($player['gq_name'])."</td>
		<td class='tbl1' align='right'>".$player['gq_score']."</td>
		<td class='tbl1' align='right'>".playersTime($player['time'], $locale['vss_de_012'])."</td>
		<td class='tbl1' align='right'>".rand(10,50)."</td>
	</tr>";
	}
	
echo "</table><br>";

}
  
closetable();

}

require_once THEMES."templates/footer.php";
?>