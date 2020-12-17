<?php
	include "../../maincore.php";
	include INFUSIONS . "admin_system/infusion_db.php";
	include THEMES."templates/header.php";
    	if (file_exists( AS_DIR."locale/".LANGUAGE.".php")) {
        	include AS_DIR."locale/".LANGUAGE.".php";
    	} else {
        	include AS_DIR."locale/English.php";
    	}

	opentable($locale['AS_TEAM1']);
	$submits="";
	$g=0;
	$groups=dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE 1 ORDER BY id");
	while($group=dbarray($groups))
	{
		$g = 1;
		//$submits.="<td><form action='' method='GET'><input type='hidden' value='".$group["id"]."' name='skupina' /><input class='button' type='submit' value='".$group["nazev"]."'></form></td>";
 		$submits.="<td><a class='button' type='submit' href='".INFUSIONS."admin_system/team.php?skupina=".$group["id"]."'>".$group["nazev"]."</a></td>";
	}
	if($g==1) 
	{
		echo "<table align='center' cellpadding='2' cellspacing='2'>";
		echo "<tr>".$submits."</tr>";
		echo "</table>";
		echo "<hr /><br />";
	}else{
		echo $locale['AS_TEAM_MSG1'];
	}
	if(isset($_GET["skupina"]) && isnum($_GET["skupina"]))
	{
		$users=dbquery("SELECT * FROM ".DB_ADMINS_USERS." WHERE skupina='".$_GET["skupina"]."'");
		$u=0;
		while($userr=dbarray($users)) 
		{
			$u=1;
			$user = dbarray(dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$userr["user_id"]."'")); 
			echo "<table style='text-align:center;margin-bottom:15px;' width='350' height='auto' align='center'>";
			echo "<tr><td width='100'>";
			if(file_exists(IMAGES."avatars/".$user["user_avatar"]) && $user["user_avatar"]!="") 
			{
				echo "<img src='".IMAGES."avatars/".$user["user_avatar"]."' style='border:1px solid #fff;' width='100' height='100' valign='top' align='center'>";
			}else{ 
				echo "<img src='../infusions/admin_system/img/noav.png' style='border:1px solid #fff;' width='100' height='100' valign='top' align='center'>"; 
			}
			echo "</td><td>";
			echo  $locale['AS_TEAM2']."<a href='".BASEDIR."profile.php?lookup=".$user["user_id"]."'>".$user["user_name"]."</a><br />";
			$n = $locale['AS_TEAM_MSG2'];
			$icq = $user["user_icq"]==""? $n : $user["user_icq"];
			$funkce = $userr["funkce"]==""? $n : $userr["funkce"];
			
			echo "<a href='".BASEDIR."messages.php?msg_send=".$user["user_id"]."'>".$locale['AS_TEAM3']."</a><br />";
			echo $locale['AS_TEAM4'].$userr["funkce"]."<br />";
			echo "</td></tr></table>";
		}
		if($u==0)
		{
			echo $locale['AS_TEAM_MSG3'];
		}
	}
	closetable();
	include THEMES."templates/footer.php";
?>
