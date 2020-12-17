<?php

    require_once "../../maincore.php";  

    require_once INFUSIONS . "admin_system/infusion_db.php";
    require_once THEMES."templates/admin_header.php";

    if (file_exists( AS_DIR."locale/".LANGUAGE.".php")) {
        include AS_DIR."locale/".LANGUAGE.".php";
    } else {
        include AS_DIR."locale/English.php";
    }

    if (!checkrights("AS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) 
    { 
        redirect("../../index.php"); 
    }

    opentable($locale['AS_TABLE1']);
    include "menu.php";
    closetable();

    if(isset($_POST["pridat_skupinu"]) && ($_POST["nazev"] != ""))
    {
    	$result = dbquery("INSERT INTO ".DB_ADMINS_GROUPS."(nazev) VALUES('".$_POST["nazev"]."')");
		redirect("admin.php".$aidlink."&page=skupiny");
    }
    elseif((isset($_GET["page"]) && $_GET["page"] == "skupiny") && (isset($_GET["admin"]) && $_GET["admin"]=="smazat") && (isset($_GET["id"]) && isnum($_GET["id"]))) 
    {
	    $result = dbquery("DELETE FROM ".DB_ADMINS_GROUPS." WHERE id='".$_GET["id"]."'");
	   	$result = dbquery("DELETE FROM ".DB_ADMINS_USERS." WHERE skupina='".$_GET["id"]."'");
		redirect("admin.php".$aidlink."&page=skupiny");
    }
    elseif(isset($_POST["upravit_skupinu"]) && (isset($_POST["nazev"]) && $_POST["nazev"]!="") && (isset($_POST["group_id"]) && isnum($_POST["group_id"]))) 
    {
	    $result = dbquery("UPDATE ".DB_ADMINS_GROUPS." SET nazev='".$_POST["nazev"]."' WHERE id='".$_POST["group_id"]."'");
    	redirect("admin.php".$aidlink."&page=skupiny");
    }
    elseif((isset($_GET["page"]) && $_GET["page"] == "admini") && (isset($_POST["user_id"]) && isnum($_POST["user_id"])) && (isset($_POST["group"]) && isnum($_POST["group"])) && (isset($_POST["funkce"]) && $_POST["funkce"]!=""))
    {
        $result = dbquery("INSERT INTO ".DB_ADMINS_USERS."(skupina,user_id,funkce) VALUES('".$_POST["group"]."', '".$_POST["user_id"]."', '".$_POST["funkce"]."')");
    	redirect("admin.php".$aidlink."&page=admini");
    }
    elseif((isset($_GET["page"]) && $_GET["page"] == "admini") && (isset($_GET["admin"]) && $_GET["admin"]=="smazat") && (isset($_GET["id"]) && isnum($_GET["id"]))) 
    {
        $result = dbquery("DELETE FROM ".DB_ADMINS_USERS." WHERE id='".$_GET["id"]."'");
        redirect("admin.php".$aidlink."&page=admini");
    }
    elseif(isset($_POST["upravit_admina"]) && isset($_POST["skupina"]) && isset($_POST["user_id"]) && isnum($_POST["user_id"])) 
    {
        $result = dbquery("UPDATE ".DB_ADMINS_USERS." SET funkce='".$_POST["funkce"]." WHERE id='".$_POST["id"]."' AND skupina='".$_POST["skupina"]."'");
    	redirect("admin.php".$aidlink."&page=admini");
    }       

    if (isset($_GET["page"]) && ($_GET["page"] == "admini")) 
    {
        $option_groups = "";
        $g = 0;
        $groups = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE 1 ORDER BY nazev");

        while($group = dbarray($groups))
	    {
	        $g = 1; $option_groups.="<option value='".$group["id"]."'>".$group["nazev"]."</option>"; 
        } 
	    $option_users = "";
	    $users = dbquery("SELECT * FROM ".DB_USERS." WHERE 1 ORDER BY user_id");	
	    while($user=dbarray($users))
	    {
	        $option_users.="<option value='".$user["user_id"]."'>".$user["user_name"]."</option>"; }
		    opentable($locale['AS_TABLE2']);
            if($g == 1) 
            {
		        if((isset($_GET["page"]) && $_GET["page"] == "admini") && (isset($_GET["admin"]) && $_GET["admin"]=="upravit") && (isset($_GET["id"]) && isnum($_GET["id"]))) 
                {
			        $user = dbarray(dbquery("SELECT * FROM ".DB_ADMINS_USERS." WHERE id='".$_GET["id"]."'"));
			        $data_user = dbarray(dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$user["user_id"]."'"));
			        $data_group = dbarray(dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE id='".$user["skupina"]."'"));
				    
                    echo "<form action='' method='POST'>";
				    echo "<table width='500px' align='center'>";
			        echo "<input type='hidden' name='user_id' value='".$user["user_id"]."' />";
			        echo "<input type='hidden' name='id' value='".$user["id"]."' />";
			        echo "<input type='hidden' name='skupina' value='".$user["skupina"]."' />";
			        echo "<tr><td>".$locale['AS_ADMIN3'].":</td><td><input type='text' value='".$data_user["user_name"]."' class='textbox' disabled /></td></tr>";
			        echo "<tr><td>".$locale['AS_ADMIN4'].":</td><td><input type='text' value='".$data_group["nazev"]."' class='textbox' disabled /></td></tr>";
                    echo "<tr><td>".$locale['AS_ADMIN5'].":</td><td><input type='text' name='funkce' value='".$user["funkce"]."' class='textbox' /></td></tr>";
                    echo "<tr><td></td><td><input type='submit' name='upravit_admina' class='button' value='".$locale['AS_ADMIN7']."' /></td></tr>";
                    echo "</table>";
                    echo "</form>";
                }
                else
                {
                    echo "<form action='' method='POST'>";
                    echo "<table width='500px' align='center'>";
                    echo "<tr><td>".$locale['AS_ADMIN3'].":</td><td><select class='textbox' name='user_id'>".$option_users."</select></td></tr>";
                    echo "<tr><td>".$locale['AS_ADMIN4'].":</td><td><select class='textbox' name='group'>".$option_groups."</select></td></tr>";
                    echo "<tr><td>".$locale['AS_ADMIN5'].":</td><td><input type='text' name='funkce' class='textbox' /></td></tr>";
                    echo "<tr><td></td><td><input type='submit' name='pridat_admina' class='button' value='".$locale['AS_ADMIN7']."' /></td></tr>";
                    echo "</table>";
                    echo "</form>";
                }   
            }
            else
            { 
                echo $locale['AS_MESSAGE1'];
            }
            closetable();
            opentable($locale['AS_TABLE3']);
            $u = 0;
            $radek = "";
            $users = dbquery("SELECT * FROM ".DB_ADMINS_USERS." WHERE 1 ORDER BY skupina");
            while($user = dbarray($users)) 
            {
            	$data_user = dbarray(dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$user["user_id"]."'"));
            	$data_group = dbarray(dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE id='".$user["skupina"]."'"));
            	$u = 1;
            	$radek .= "<tr><td><a href='".BASEDIR."profile.php?lookup=".$data_user["user_id"]."'>".$data_user["user_name"]."</a></td><td>".$user["funkce"]."</td><td>".$data_group["nazev"]."</td><td><a href='admin.php".$aidlink."&page=admini&admin=upravit&id=".$user["id"]."'>".$locale['AS_ADMIN11']."</a> | <a href='admin.php".$aidlink."&page=admini&admin=smazat&id=".$user["id"]."'>".$locale['AS_ADMIN12']."</a></td></tr>";
            }
            if($u == 1)
            {
            	echo "<table width='100%'>";
            	echo "<tr style='font-weight:bold;'><td>".$locale['AS_SHOW1']."</td><td>".$locale['AS_SHOW2']."</td><td>".$locale['AS_SHOW4']."</td><td>".$locale['AS_SHOW5']."</td></tr>";
                echo $radek;
                echo "</table>"; 
            }
            else
            { 
            	echo $locale['AS_MESSAGE2'];
            }
            closetable();
	    } 
	    elseif (isset($_GET["page"]) && ($_GET["page"] == "skupiny")) 
        {
            if((isset($_GET["page"]) && $_GET["page"] == "skupiny") && (isset($_GET["admin"]) && $_GET["admin"]=="upravit") && (isset($_GET["id"]) && isnum($_GET["id"]))) 
            {
                $group = dbarray(dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE id='".$_GET["id"]."'"));
                opentable($locale['AS_TABLE4']);
                echo "<form action='' method='POST'>";
                echo "<table width='500px' align='center'>";
                echo "<tr><td>".$locale['AS_ADMIN9'].":</td><td><input type='text' name='nazev' value='".$group["nazev"]."' class='textbox' /></td></tr>";
                echo "<input type='hidden' value='".$_GET["id"]."' name='group_id' />";
                echo "<tr><td></td><td><input type='submit' value='".$locale['AS_ADMIN7']."' name='upravit_skupinu' class='button' /></td></tr>";
                echo "</table>";
                echo "</form>";
            }
            else
            {
                opentable($locale['AS_TABLE5']);
                echo "<form action='' method='POST'>";
                echo "<table width='500px' align='center'>";
                echo "<tr><td>".$locale['AS_ADMIN9'].":</td><td><input type='text' name='nazev' class='textbox' /></td></tr>";
                echo "<tr><td></td><td><input type='submit' value='".$locale['AS_ADMIN7']."' name='pridat_skupinu' class='button' /></td></tr>";
                echo "</table>";
                echo "</form>";
            }
            closetable();
            opentable($locale['AS_TABLE6']);
            $g = 0;
            $radek = "";
            $groups = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE 1 ORDER BY nazev");
            while($group = dbarray($groups)) 
            {
                $g = 1;
                $radek .= "<tr><td>".$group["nazev"]."</td><td>".dbcount("(user_id)",  DB_ADMINS_USERS."", "skupina=".$group["id"]."")."<td><a href='admin.php".$aidlink."&page=skupiny&admin=upravit&id=".$group["id"]."'>".$locale['AS_ADMIN11']."</a> | <a href='admin.php".$aidlink."&page=skupiny&admin=smazat&id=".$group["id"]."'>".$locale['AS_ADMIN12']."</a></td></tr>";
            }
            if($g == 1) 
            {
                echo "<table width='100%'>";
                echo "<tr style='font-weight:bold;'><td width='33%'>".$locale['AS_ADMIN9']."</td><td width='33%' >".$locale['AS_ADMIN10']."</td><td width='33%'>".$locale['AS_SHOW5']."</td></tr>";
                echo $radek;
                echo "</table>"; 
            }
            else
            { 
                echo $locale['AS_MESSAGE3'];
            }
            closetable();
        }
        elseif (isset($_GET["page"]) && $_GET["page"] == "omodu") 
        {
            opentable("Info");
            echo "
            This mod originally made by ZeXiiK <br/>
            Fix by Zeky & RobiNN
            ";
            closetable();
        }

    require_once THEMES . "templates/footer.php"; 
?>