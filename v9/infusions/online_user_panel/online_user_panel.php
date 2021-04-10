<?php
    /*-------------------------------------------------------+
    | PHP-Fusion Content Management System
    | Copyright © 2002 - 2008 Nick Jones
    | http://www.php-fusion.co.uk/
    +--------------------------------------------------------+
    | Filename: online_users_panel.php
    | Author: ptown67
    | Website: http://pennerprofi.bplaced.net
    +--------------------------------------------------------+
    | This program is released as free software under the
    | Affero GPL license. You can redistribute it and/or
    | modify it under the terms of this license which you
    | can read by viewing the included agpl.txt or online
    | at www.gnu.org/licenses/agpl.html. Removal of this
    | copyright header is strictly prohibited without
    | written permission from the original author(s).
    +--------------------------------------------------------*/

    if (!defined("IN_FUSION")) 
    { 
        die("Access Denied"); 
    }
    add_to_head ("
    	<link rel='stylesheet' type='text/css' href='".INFUSIONS."online_users_panel/tooltip.css' />
    	<script src='".INFUSIONS."online_users_panel/jquery.tooltip.pack.js' type='text/javascript'></script>
    	<script type='text/javascript'>
    	$(function() {
    	$('#boxover a').tooltip({
    	track: true,
    	delay: 0,
    	showURL: false,
    	showBody: ' - ',
    	fade: 250
    	});
    	});
    	</script>
    ");
    // Functions
    $result = dbquery("SELECT * FROM ".DB_ONLINE." WHERE online_user=".($userdata['user_level'] != 0 ? "'".$userdata['user_id']."'" : "'0' AND online_ip='".USER_IP."'"));
    if (dbrows($result)) {
    	$result = dbquery("UPDATE ".DB_ONLINE." SET online_lastactive='".time()."' WHERE online_user=".($userdata['user_level'] != 0 ? "'".$userdata['user_id']."'" : "'0' AND online_ip='".USER_IP."'")."");
    } else {
    	$result = dbquery("INSERT INTO ".DB_ONLINE." (online_user, online_ip, online_lastactive) VALUES ('".($userdata['user_level'] != 0 ? $userdata['user_id'] : "0")."', '".USER_IP."', '".time()."')");
    }
    $result = dbquery("DELETE FROM ".DB_ONLINE." WHERE online_lastactive<".(time()-600)."");
    $online_guests = dbcount("(online_ip)", DB_ONLINE, "online_user='0' AND online_lastactive > (".time()."-0.1*60)");
    $guests = 0; 
    $members = array();
    $result = dbquery ("SELECT ton.*, tu.user_id,user_name FROM ".DB_ONLINE." ton LEFT JOIN ".DB_USERS." tu ON ton.online_user=tu.user_id");

    while ($data = dbarray($result)) {
    	if ($data['online_user'] == "0") {
    		$guests++;
    	} else {
    		array_push($members, array($data['user_id'], $data['user_name']));
    	}
    }
    openside("<small>Users: ".count($members)." | Guests: ".$online_guests."</small>\n");
    $result = dbquery("SELECT * FROM ".DB_USERS." ORDER BY user_lastvisit DESC LIMIT 0,10");
	echo "\n <div id='boxover'>\n  <table width='100%' cellpadding='0' cellspacing='0'>\n";
	if (dbrows($result) != 0) {
		while ($data = dbarray($result)){
			$lastseen = time() - $data['user_lastvisit'];
			if ($lastseen < 10){
				$lastseen = "<td style='width: 40px;text-align: right;'><font color='#3cb371' alt='Online' title='Now Online'><strong>Online</strong></font></td>";
            } 
            else if ($lastseen < 600) {
				$lastseen = "<td style='width: 40px;text-align: right;'><font color='#da9055' alt='10minut' title='10 Minutes'><strong>10Min</strong></font></td>";
			} else {
				$lastseen = "<td style='width: 40px;text-align: right;'><font color='#b34242' alt='Offline' title='Now Offline'><strong>Offline</strong></font></td>";
			}
			echo "<tr>\n";
			echo "<td class='side-small' align='left'><a href='".BASEDIR."profile.php?lookup=".$data['user_id']."' title='".trimlink($data['user_name'], 30)." [".$userlevelfortitle."] - Registred: ".showdate("longdate", $data['user_joined'])." - Last Visit: ".showdate("longdate", $data['user_lastvisit'])."' class='side'><font class='side'><strong>".trimlink($data['user_name'],15)."</strong></font></a></td>\n";
            echo "<td class='side-small' align='right'>".$lastseen."</td>\n   </tr>\n";
		}
	}
	echo "</table>\n </div>\n";
	echo $locale['global_014'].": <font color='#3cb371'>".number_format(dbcount("(user_id)", DB_USERS, "user_status<='1'"))."</font><br />\n"; 
	$data = dbarray(dbquery("SELECT user_id, user_name FROM ".DB_USERS." WHERE user_status='0' ORDER BY user_joined DESC LIMIT 0,1"));
	echo $locale['global_016'].": <a href='".BASEDIR."profile.php?lookup=".$data['user_id']."' class='side'>".trimlink($data['user_name'], 20)."</a>\n";
    closeside();
?>