<?php
    if (!defined("IN_FUSION")) 
    { 
        die("Access Denied"); 
    }
    define("THEME_BULLET", "");
    require_once INCLUDES."theme_functions_include.php";
    
    function odkaz($name, $typ) 
    {
        $web = $_SERVER["REQUEST_URI"];
        if($typ == "1") 
        {
	    	if($web == $name){ 
                $class = "active";
	    	}else{ 
                $class = ""; 
            }
	    }
        else if($typ == "2")  
        {
		    if(strstr($web, $name))
            { 
                $class = "active"; 
            }else{ 
                $class = ""; 
            }
	    }
	    return $class;
    }

    function render_page($license=false) 
    {
        global $settings, $aidlink, $userdata; $_errorHandler;
        
        add_to_head('<script src="'.THEME.'js.js"></script>');		
        echo"<h1>Mix-Arena.eu - Gaming portál</h1>";
        if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) 
        {
            echo"<div class='adminFixPanel'>\n";
            echo"<a href='".ADMIN."index.php".$aidlink."'>ADMINISTRACE</a><br />\n";
            echo"</div>\n";	
        }
		echo"<div class='horna_lista'>\n";
		    echo"<table class='horna_lista_center'>\n<tr>\n";
                echo"<td class='horna_lista_menu'>\n";
                echo"<div class='menu_medzera'></div>\n";
                echo"<a href='/' class='".odkaz("/", "1")."'>ÚVOD</a>\n";	
                echo"<div class='menu_medzera'></div>\n";
                echo"<a href='/forum/' class='".odkaz("/forum/", "2")."'>FÓRUM</a>\n";
                echo"<div class='menu_medzera'></div>\n";
                echo"<a href='/team/vedeni.php' class='".odkaz("/team/", "1")."'>ADMIN TEAM</a>\n";
                echo"<div class='menu_medzera'></div>\n";
                echo"<a href='/banlist/'  class='".odkaz("", "1")."'>BANLISTY</a>\n";
                echo"<div class='menu_medzera'></div>\n";	
                echo"<a href='/pravidla/' class='".odkaz("/pravidla/", "2")."'>PRAVIDLA</a>\n";
                echo"<div class='menu_medzera'></div>\n";	
                echo"<a href='/market/' class='".odkaz("/market/", "1")."'>E/VIP VÝHODY</a>\n";					
                echo"<div class='menu_medzera'></div>\n";
            echo"</td>\n";
        echo"<td class='horna_lista_right'>\n";
        if (iMEMBER) 
        {
            if ($userdata['user_avatar'] && file_exists(IMAGES."avatars/".$userdata['user_avatar'])) 
            {
                $avatar_url = IMAGES."avatars/".$userdata['user_avatar'];
            } else {
                $avatar_url = IMAGES."avatars/noavatar100.png";
            }
            echo"<a id='dropdown_link' class='userpanel_link'>\n";
                echo $userdata['user_name'];
            echo"</a>\n";
		    echo"<div id='dropdown'>\n";
                echo"<div class='dropdown_sipka'></div>\n";
					echo"<div class='dropdown_bg'>\n";
						echo"<table class='userpanel_table_obsah'>\n";
							echo"<tr>\n";
								echo"<td class='userpanel_td1'><img src='".$avatar_url."' alt='' /></td>\n";
								echo"<td class='userpanel_td2'>\n";
									echo"<a href='/profile.php?lookup=".$userdata['user_id']."'>Zobrazit profil</a>\n";
									echo"<br>";
									echo"<a href='".BASEDIR."edit_profile.php'>Upravit profil</a>\n";
									echo"<br>";
									echo"<a href='".BASEDIR."submit.php?stype=p'>Pridat fotku</a>\n";
									echo"<br>";
									if(iMEMBER) {
										$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");
										if ($msg_count) { 
                                            $msgs = " <span style='color:green;'>(".$msg_count.")</span>"; 
                                        } else { 
                                            $msgs = ""; 
                                        }
									} else { 
                                        $msgs = ""; 
                                    }
									echo"<a href='".BASEDIR."messages.php'>Súkromne správy".$msgs."</a>\n";
									echo"<br>";
									echo"<a href='".BASEDIR."index.php?logout=yes'>Odhlásit&nbsp;</a>\n";
								echo"</td>\n";
							echo"</tr>\n";
						echo"</table>\n";
					echo"</div>\n";
				echo"</div>\n";	
			} else {
				echo"<a id='dropdown_link' class='loginpanel_link'>\n";
					echo"Příhlásit se";
				echo"</a>\n";
				echo"<div id='dropdown' class='dropdown_login'>\n";
					echo"<div class='dropdown_bg dropdown_bg_login'>\n";							
						echo"<div class='loginpanel_obsah'>\n";
							echo "<form name='loginpageform' method='post' action='".$_SERVER['REQUEST_URI']."'>\n";
								?>
                                <input class='loginpanel_nick_textbox' size='16' type="text" name="user_name" value="Nick" onblur="if(this.value=='') this.value='Nick';" onfocus="if(this.value=='Nick') this.value='';" />
                                <input class='loginpanel_heslo_textbox' size='14' type="password" name="user_pass" value="password" onblur="if(this.value=='') this.value='password';" onfocus="if(this.value=='password') this.value='';" />
                                <?php
								echo "<input class='loginpanel_login_button' type='submit' name='login' value='přihlásit' /><br />\n";
								echo"<div class='loginpanel_obsah_neodhlasovat'>\n";
									echo "<label><input class='loginpanel_checkbox' type='checkbox' name='remember_me' value='y' title='Zůstat přihlášen' />Zůstat přihlášen</label>\n";
								echo"</div>\n";
								echo"<a class='loginpanel_newpass_link' href='".BASEDIR."lostpassword.php'>Obnovit heslo</a>\n";
								echo"<a class='loginpanel_register_link' href='".BASEDIR."register.php'>Vytvorit účet</a>\n";
							echo "</form>\n";
						echo"</div>\n";
					echo"</div>\n";
				echo"</div>\n";
			}
			echo"</td>\n";
		echo"</tr>\n</table>\n";
	    echo"</div>\n";
	    echo"<div class='clear'></div>\n";
	    echo"<div class='podmenu'>\n<div class='podmenu_center'>\n";		
	    	echo"<table class='menu2'>\n<tr>\n";
	    		echo"<td class='menu2_nalavo'>\n";
	    			echo"<div class='menu2_medzera'>|</div>\n";
	    			echo"<a href='/contact.php'>Kontaktujte nás</a>\n";
	    			echo"<div class='menu2_medzera'>|</div>\n";
	    			echo"<a href='/hltv.php'><span style='color:#4E9EE5'>HLTV</span></a>\n";
	    		    echo"<div class='menu2_medzera'>|</div>\n";						
                    echo"<a href='/search.php'>Vyhledávání</a>\n";
	    			echo"<div class='menu2_medzera'>|</div>\n";
	    			echo"<a href='#' target='_blank'>HLSTATS:X</a>\n";
	    			echo"<div class='menu2_medzera'>|</div>\n";
	    			echo"<a href='/downloads.php'><span style='color:#4E9EE5'>Downloads</span></a>\n";
	    		echo"</td>\n";
	    		echo"<td class='menu2_napravo'>\n";
	    			echo "<a href='#'>Vyhľadávanie</a>\n";
	    			echo "<a href='#'>Uživatelia</a>\n";
	    			echo "<a href='#'>Kontakt</a>\n";
	    		echo "</td>\n";
	    	echo "</tr>\n</table>\n";
	    	echo "</div>\n</div>\n";
	    	echo"<div class='clear'></div>\n";
	    	echo"<div class='header'>\n";
	    		echo"<div class='header_center'>\n";
	    			echo"<table class='header_table'>\n<tr>\n";
	    				echo"<td class='header_logo'>\n";
	    					echo"<a href='#'><img src='".THEME."images/header_christmas2.png' alt='Mix-Arena.eu - Gaming portál' /></a>\n";
	    				echo"</td>\n";
	    				echo"<td class='header_napravo'>\n";
                            //Here you can add what you want
	    				echo"</td>\n";
	    			echo"</tr>\n</table>\n";
	    		echo"</div>\n";
	    	echo"</div>\n";
	    	echo"<div class='clear'></div>\n";
	    	if(strstr($_SERVER['REQUEST_URI'], "/messages.php")) { $messages_page = 0; } else { $messages_page = 1; }
	    	if(iMEMBER && $messages_page == 1) {
	    		$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");
	    		if ($msg_count) {
	    			if($msg_count == "1") {
	    				$msg = "Máš 1 neprečítanu správu";
	    			} else 	if($msg_count == "2" || $msg_count == "3" || $msg_count == "4") {
	    				$msg = "Máš ".$msg_count." neprečítané správy";
	    			} else {
	    				$msg = "Máš ".$msg_count." neprečítaných správ";
	    			}
	    			echo"<div class='new_pm'>\n";
	    				echo"<div class='new_pm_center'>\n";
	    					echo"<a href='/messages.php' class='new_pm_button'>".$msg."</a>\n";
	    				echo"</div>\n";
	    			echo"</div>\n";
	    			echo"<div class='clear'></div>\n";
	    		}
	    	}
	    	echo"<div class='content'>\n";
	    		echo"<div class='content_center'>\n";
	      	if (preg_match('#/news.php#', FUSION_REQUEST)) { 
	    	if (file_exists(INFUSIONS."lgsl/lgsl_files/lgsl_listc.php")) {
	    		require_once (INFUSIONS."lgsl/lgsl_files/lgsl_listc.php");
	    	}
	    }
        echo "<table class='panels'>\n<tr>\n";
        echo "<td class='panels_stred'>".U_CENTER.CONTENT.L_CENTER."</td>\n";
	    if (RIGHT || LEFT) { echo "<td class='panels_napravo'>".RIGHT.LEFT."</td>\n";  }
        echo "</tr>\n</table>\n";
        echo"</div>\n";
        echo"</div>\n";
        echo"<div class='clear'></div>\n";
        echo"</div>\n";		
        echo"</div>\n";
        echo"<div class='clear'></div>\n";
        echo"<div class='footer'>\n";
        echo"<div class='footer_center'>\n";
        echo"<span>Mix-Arena.eu © 2013-2019<hr class='footer_cara'></hr> </span>";		
        echo"<span>Powered by <a href='https://www.php-fusion.co.uk/'>PHP-Fusion</a> copyright © 2002 - 2017 by Nick Jones.<br/>Released as free software without warranties under <a href='http://www.gnu.org/licenses/agpl-3.0.html'>GNU Affero GPL</a> v3.</span>";
        echo"<hr class='footer_cara'>";
        echo"<span>Design by Mix-Arena.eu</span>";
        echo"</div>\n";		
        echo"</div>\n";
    }
    function render_comments($c_data, $c_info){
        opentable("Komentáre");
            if (!empty($c_data)){
                foreach($c_data as $data) 
                {
                    if ($data['edit_dell'] !== false) {
                        $edit_dell = " | ".$data['edit_dell'];
                    } else {
                        $edit_dell = "";
                    }
                    echo"<table id='c".$data['comment_id']."' class='komentar_bg'>\n<tr>\n";
                        echo"<td class='komentar_avatar'>\n";
                            echo $data['user_avatar'];
                        echo"</td>\n";
                    echo"<td class='komentar'>\n";
                    echo"<div class='komentar_sipka'></div>\n";
                        echo"<div class='komentar_info'>\n";
                            echo"<span class='komentar_info_nick'>".$data['comment_name']."</span> <span class='komentar_info_datum'>".$data['comment_datestamp'].$edit_dell."</span>\n";
                            echo"<span class='komentar_info_id'><a href='".FUSION_REQUEST."#c".$data['comment_id']."' id='c".$data['comment_id']."' name='c".$data['comment_id']."'>#".$data['i']."</a></span>\n";
                        echo"</div>\n";
                        echo"<div class='komentar_obsah'>".$data['comment_message']."</div>\n";
                        echo"</td>\n";
                    echo"</tr>\n</table>\n";
			    }
 			    if ($c_info['c_makepagenav'] !== false) { 
			    	echo"<div class='komentare_pagenav'>".$c_info['c_makepagenav']."</div>\n"; 
			    }
            } else {
                echo"<div class='komentare_opentable_title_nocomments'>Komentáre</div>\n";
                echo"Žiadny komentár ešte nebol pridaný.\n";
            }
        closetable();
    }
    function render_news($subject, $news, $info) {
        global $settings;
        if ($info['news_allow_comments'] && $settings['comments_enabled'] == "1") {
            $novinka_komentare = "<span><img src='".THEME."images/novinka-komentare-dark.png' title='Počet komentářů' alt='Komentáře' /><br />".$info['news_comments']."</span>\n";
            $cela_novinka_komentare = "<span><img src='".THEME."images/novinka-komentare-dark.png' title='Komentáře' alt='Komentáře' /> Komentářů: ".$info['news_comments']."</span>";
        } else {
            $novinka_komentare = "";
            $cela_novinka_komentare = "<span><img src='".THEME."images/novinka-komentare-dark.png' title='Komentáre' alt='Komentáre' /> Komentáre nejsú povolené.</span>";
        }
	    opentable($info['news_subject']);
		    echo"<div class='novinka'>\n";
			    echo"<p>".$news."</p>\n";
		    echo"</div>\n";
		    echo"<div class='novinka_info'>\n";
			    echo"<span><img src='".THEME."images/novinka-autor-dark.png' title='Autor novinky' alt='Autor' /> ".profile_link($info['user_id'], $info['user_name'], $info['user_status'])."</span>";
                echo"<span><img src='".THEME."images/novinka-datum-dark.png' title='Dátum pridania' alt='Datum' /> ".showdate("%d.%m.%Y", $info['news_date'])."</span>";
                echo $cela_novinka_komentare;
            echo"</div>\n";
        closetable();
   }
    function render_article($subject, $article, $info) {	
        echo"<div class='opentable'>\n";
            echo"<div class='opentable_title' style='border:none;'>".$subject."</div>\n";
                echo"<div class='opentable_content'>\n";
                echo"<p>";
                    echo ($info['article_breaks'] == "y" ? nl2br($article) : $article);	
                echo"</p>\n";
                echo"<br /><hr><br />\n";
                echo "<div style='text-align:center;'>\n";	
                    echo "Pridal ".profile_link($info['user_id'], $info['user_name'], $info['user_status'])." dňa <span>".showdate("shortdate", $info['article_date'])."</span> do kategórie <a href='/articles.php?cat_id=".$info['cat_id']."'>".$info['cat_name']."</a> | Komentárov: <span>".$info['article_comments']."</span> | Prečítané: <span>".$info['article_reads']."x";	
                echo "</div>\n";
		    echo"</div>\n";
	    echo"</div>\n";
    }
    function opentable($title) {
        echo"<div class='opentable'>";
        echo"<div class='opentable_title'>".$title."</div>";
        echo"<div class='opentable_content'>";
    }
    function closetable() {
        echo"</div>";
        echo"</div>";
    }
    function openside($title, $collapse = false, $state = "on") {
        echo"<div class='openside'>";
        echo"<div class='openside_title'>".$title."</div>";
        echo"<div class='openside_content'>";
    }
    function closeside() {
    	echo"</div></div>";
    }