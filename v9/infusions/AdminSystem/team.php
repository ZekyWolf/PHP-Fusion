<?php
    require_once __DIR__."/../../maincore.php";
    require_once THEMES."templates/header.php";
    require_once INFUSIONS."AdminSystem/infusion_db.php";

    $locale = fusion_get_locale('', AS_LOCALE);

    opentable($locale['at_title']);
    $result_g = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." ORDER BY id");
    if (dbrows($result_g) > 0){
        echo "<center>";
	    echo "<div class='btn-group'>";
	    while($group = dbarray($result_g))
	    {
		    echo "<td><a class='btn-invisible btn btn-primary' type='submit' href='".INFUSIONS."AdminSystem/team.php?group=".$group["id"]."'>".$group["gname"]."</a></td>";
	    }
	    echo "</div>";
	    echo "</center>";
    }
    closetable();

    opentable();
    if(isset($_GET["group"]) && isnum($_GET["group"]))
    {
        $result_u = dbquery('SELECT * FROM '.DB_ADMINS_USERS.' WHERE groupid="'.$_GET["group"].'";');
        if (dbrows($result_u) > 0){
            echo '<table style="text-align:center;margin-bottom:15px;" width="350" height="auto" align="center">';
            echo '<div class="table-responsive">';
            echo '<tr>';
            while($data_u = dbarray($result_u)) 
            {
                $user = dbarray(dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$data_u["user_id"]."'"));
                echo '<td width="100">';
                if(file_exists(IMAGES."avatars/".$user["user_avatar"]) && $user["user_avatar"]!="") 
			    {
			    	echo "<img src='".IMAGES."avatars/".$user["user_avatar"]."' style='border:1px solid #fff;' width='100' height='100' valign='top' align='center'>";
			    }else{ 
			    	echo "<img src='".BASEDIR."/images/no_photo.png' style='border:1px solid #fff;' width='100' height='100' valign='top' align='center'>"; 
			    }
                echo '</td>';
                echo '<td>';
                echo '<a href="profile.php?lookup='.$user["user_id"].'">'.$user["user_name"].'</a>';
                echo '<br/>';
                echo $locale['at_positon'].'<br/>'.$data_u["position"].'<br />';
                echo '</td>';
            }
            echo '</tr>';
            echo '</div>';
            echo '</table>';
        }
    }
    closetable();
    require_once THEMES."templates/footer.php";