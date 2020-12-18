<?php

/*-------------------------------------------------------+

| PHP-Fusion Content Management System

| Copyright © 2002 - 2018 Nick Jones

| http://www.php-fusion.co.uk/

+--------------------------------------------------------+

| Filename: servers_status.php

| Version: 1.3

| Author: Virel

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



opentable($locale['vss_031']);



if($vsettings['v_sett_group'] == "1") {



// rozdelenie do modov



echo "<div class='team-body'>";

$result = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS_GROUP."");

if (dbrows($result) != 0) {

while ($sv_group = dbarray($result)) {

	

	$page_list_st = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS." WHERE v_status_group ='".$sv_group['v_gp_id']."' ORDER BY v_status_order ASC");

	echo "<table class='tbl-border center' cellspacing='1' cellpadding='0' width='100%'>\n";

	

	echo "<tr>

		<td colspan='9' align='left' class='tbl2' ><b>".$sv_group['v_gp_name']."</b></td>

		</tr>";

	

	if(dbrows($page_list_st)) {

		

		

		$i = 0;

		while($row = dbarray($page_list_st)) {

			

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

					'query_port' => $server_q_port,

				],

			]);

			$GameQ->setOption('timeout', 3);

			$results = $GameQ->process();

			

			$server = $results[$server_ip.':'.$server_port];

			

	$statusimg = "";



	if ($server['gq_mapname']) {

    $image_maps = "images/maps/".$server_type."/".$server['gq_mapname'].".jpg";

	} else {

    $image_maps = "images/nomap.jpg";

	}

	

	switch($server['gq_online']) {

		case '1': {

			$statusimg ='<img src="'.VSIMAGES.'" title="" alt=""/>';

			break;

		}

		case '0': {

			$statusimg ='<img src="'.VSIMAGES.'" title="" alt=""/>';

			break;

		}

	}

	



				

		$vote = '<span id="serv'.$row['v_status_id'].'-layer">'.$row['v_status_vote'].'</span><span style="cursor:pointer;

					" onclick="vote('.$row['v_status_id'].',\'up\',\'\');"> <span id="serv'.$row['v_status_id'].'-button"><i class="icon-arrow-up"></i></span>';

				

				

        $class = $i % 2 == 0 ? "tbl1" : "tbl2";

        echo "<tr>\n";

        echo "<td align='center' valign='middle' class='".$class."' width='50'>".icon_type($server_type)." $statusimg</td>\n";

        echo "<td class='".$class."' width='350'><a href='".VSSBASE."detail.php?id=".$row['v_status_id']."'>".$server['gq_hostname']."</a></td>\n";

		echo "<td class='".$class."' width='50' align='center' style='white-space: nowrap'>$server_ip:$server_port ".connect_type($server_type,$server_ip,$server_port)."</td>\n";

		echo "<td class='".$class."' width='50' align='center' style='white-space: nowrap'>"; if($vsettings['v_sett_map'] == "1"){ echo "<img alt='' src='".$image_maps."' style='vertical-align:middle;width:30px;height:20px;border: 1px solid #F0F0F0;border-radius: 1px;box-shadow: 2px 2px 16px #f1f1f1;' />"; } echo " ".$server['gq_mapname']."</td>\n";

		echo "<td class='".$class."' width='30' align='center' style='white-space: nowrap'>"; echo color_players($server['gq_numplayers'],$server['gq_maxplayers']); if($vsettings['v_sett_percplayer'] == "1"){ echo " - "; echo percents($server['gq_numplayers'],$server['gq_maxplayers']); } echo "</td>\n";

		if($vsettings['v_sett_vip'] == "1"){

		if($row['v_status_vip_url'] != ""){

		echo "<td class='".$class."' width='20' align='center' style='white-space: nowrap'><a href='".$row['v_status_vip_url']."'><img src='".VSIMAGES."icons/vip.png' title='VIP' alt='vip'/></a></td>\n";

        } else {

		echo "<td class='".$class."' width='20' align='center' style='white-space: nowrap'></td>\n";	

		}

		}

		if($vsettings['v_sett_show_bl'] == "1"){

		echo "<td class='".$class."' width='20' align='center' style='white-space: nowrap'><a href='".$row['v_status_bl_url']."'><img src='".VSIMAGES."icons/banlist.png' title='".$locale['vss_p_004']."' alt='".$locale['vss_p_004']."'/></a></td>\n";

		}

		if($vsettings['v_sett_show_hl'] == "1"){

		echo "<td class='".$class."' width='20' align='center' style='white-space: nowrap'><a href='".$row['v_status_hl_stats_url']."'><img src='".VSIMAGES."icons/stats.png' title='".$locale['vss_p_006']."' alt='".$locale['vss_p_006']."'/></a></td>\n";

		}

		if($vsettings['v_sett_vote'] == "1"){

		echo "<td class='".$class."' width='30' align='center' style='white-space: nowrap'>".$vote."</td>\n";

		}

		echo "</tr>\n";

        $i++;

		

    }

} else {

    echo "<tr>\n<td align='center' class='tbl1'>".$locale['vss_p_003']."</td>\n</tr>\n";

}

echo "</table>\n";





}

} else {

	echo "<div align='center'><br />".$locale['v_tm_054']."<br /><br /></div>";

}



} else {

	

// Bez modov

	

$page_list_st = dbquery("SELECT * FROM ".DB_VIREL_S_STATUS." ORDER BY v_status_order ASC");

	echo "<table class='tbl-border center' cellspacing='1' cellpadding='0' width='100%'>\n";

	if(dbrows($page_list_st)) {

		echo "<tr>\n";

			echo "<td class='tbl2' align='center' style='font-weight:bold;'></td>\n";

			echo "<td class='tbl2' align='left' style='font-weight:bold;'>".$locale['vss_029']."</td>\n";

			echo "<td class='tbl2' align='center' style='font-weight:bold;'>IP/PORT</td>\n";

			echo "<td class='tbl2' align='center' style='font-weight:bold;'>".$locale['vss_030']."</td>\n";

			echo "<td class='tbl2' align='center' style='font-weight:bold;'>".$locale['vss_p_001']."</td>\n";

			if($vsettings['v_sett_vip'] == "1"){ echo "<td class='tbl2' align='center' style='font-weight:bold;'>VIP</td>\n"; }

			if($vsettings['v_sett_show_bl'] == "1"){ echo "<td class='tbl2' align='center' style='font-weight:bold;'>".$locale['vss_p_004']."</td>\n"; }

			if($vsettings['v_sett_show_hl'] == "1"){ echo "<td class='tbl2' align='center' style='font-weight:bold;'>".$locale['vss_p_005']."</td>\n"; }

			if($vsettings['v_sett_vote'] == "1"){ echo "<td class='tbl2' align='center' style='font-weight:bold;'>".$locale['vss_p_002']."</td>\n"; }

		echo "</tr>\n";

		

		$i = 0;

		while($row = dbarray($page_list_st)) {

			

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

					'query_port' => $server_q_port,

				],

			]);

			$GameQ->setOption('timeout', 3);

			$results = $GameQ->process();

			

			$server = $results[$server_ip.':'.$server_port];

			

	$statusimg = ""; 

		

	if ($server['gq_mapname']) {

    $image_maps = "images/maps/".$server_type."/".$server['gq_mapname'].".jpg";

	} else {

    $image_maps = "images/nomap.jpg";

	}

	


		}


		}

	}

	

		$vote = '<span id="serv'.$row['v_status_id'].'-layer">'.$row['v_status_vote'].'</span><span style="cursor:pointer;

					" onclick="vote('.$row['v_status_id'].',\'up\',\'\');"> <span id="serv'.$row['v_status_id'].'-button"><i class="icon-arrow-up"></i></span>';

				

				

        $class = $i % 2 == 0 ? "tbl1" : "tbl2";

        echo "<tr>\n";

        echo "<td align='center' valign='middle' class='".$class."' width='50'>".icon_type($server_type)." $statusimg</td>\n";

        echo "<td class='".$class."'><a href='".VSSBASE."detail.php?id=".$row['v_status_id']."'>".$server['gq_hostname']."</a></td>\n";

		echo "<td class='".$class."' align='center' style='white-space: nowrap'>$server_ip:$server_port ".connect_type($server_type,$server_ip,$server_port)."</td>\n";

		echo "<td class='".$class."' align='center' style='white-space: nowrap'>"; if($vsettings['v_sett_map'] == "1"){ echo "<img alt='' src='".$image_maps."' style='vertical-align:middle;width:30px;height:20px;border: 1px solid #F0F0F0;border-radius: 1px;box-shadow: 2px 2px 16px #f1f1f1;' />"; } echo " ".$server['gq_mapname']."</td>\n";

		echo "<td class='".$class."' align='center' style='white-space: nowrap'>"; echo color_players($server['gq_numplayers'],$server['gq_maxplayers']); if($vsettings['v_sett_percplayer'] == "1"){ echo " - "; echo percents($server['gq_numplayers'],$server['gq_maxplayers']); } echo "</td>\n";

		if($vsettings['v_sett_vip'] == "1"){

		if($row['v_status_vip_url'] != ""){

		echo "<td class='".$class."' align='center' style='white-space: nowrap'><a href='".$row['v_status_vip_url']."'><img src='".VSIMAGES."icons/vip.png' title='VIP' alt='vip'/></a></td>\n";

        } else {

		echo "<td class='".$class."' align='center' style='white-space: nowrap'></td>\n";	

		}

		}

		if($vsettings['v_sett_show_bl'] == "1"){

		echo "<td class='".$class."' align='center' style='white-space: nowrap'><a href='".$row['v_status_bl_url']."'><img src='".VSIMAGES."icons/banlist.png' title='".$locale['vss_p_004']."' alt='".$locale['vss_p_004']."'/></a></td>\n";

		}

		if($vsettings['v_sett_show_hl'] == "1"){

		echo "<td class='".$class."' align='center' style='white-space: nowrap'><a href='".$row['v_status_hl_stats_url']."'><img src='".VSIMAGES."icons/stats.png' title='".$locale['vss_p_006']."' alt='".$locale['vss_p_006']."'/></a></td>\n";

		}

		if($vsettings['v_sett_vote'] == "1"){

		echo "<td class='".$class."' align='center' style='white-space: nowrap'>".$vote."</td>\n";

		}

		echo "</tr>\n";

        $i++;

			

    }

} else {

    echo "<tr>\n<td align='center' class='tbl1'>".$locale['vss_p_003']."</td>\n</tr>\n";

}

echo "</table>\n";

}



copy_virel_status();	

closetable();



require_once THEMES."templates/footer.php";

?>