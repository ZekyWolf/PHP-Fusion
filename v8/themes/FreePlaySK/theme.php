<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

define("THEME_BULLET", "<span class='bullet'>&middot;</span>");
define("THEME_WIDTH", "1200px");
define("BOOSTRAP", "FALSE");
define("FONTAWESOME", "FALSE");
define("ENTYPO", "FALSE");
require_once __DIR__.'/../../maincore.php';
if (file_exists(THEME."locale/".LANGUAGE.".php")) {
    // Load the locale file matching selection.
    include THEME."locale/".LANGUAGE.".php";
} else {
    // Load the default locale file.
    include THEME."locale/English.php";
}

require_once INCLUDES."theme_functions_include.php";

function render_page($license=false) {
	                                
global $settings, $main_style, $locale, $userdata, $aidlink;

	//header + bannery
	echo "<table cellpadding='0' class='header' cellspacing='0'><tr>";
	echo "<td class='logo-header' align='right'>
	</td></tr>";

	echo"<tr><td class='logo-header' align='right'> 
	</td></tr></table>";



	echo "<div class='layout display-flex'>";
		echo "<div id='menu'>";
			echo "<ul class='display-flex'>";
				echo "<div class='menutext'><a href='/news.php'>".$locale['TH_MENU1']."</a></div>";
				echo "<div class='menutext'><a href='/banlist' target='_blank'>".$locale['TH_MENU2']."</a></div>";
				echo "<div class='menutext'><a href='/forum/index.php'>".$locale['TH_MENU3']."</a></div>";
				echo "<div class='menutext'><a href='/podmienky.php'>".$locale['TH_MENU4']."</a></div>";
				echo "<div class='menutext'><a href='/servery.php'>".$locale['TH_MENU5']."</a></div>";
				echo "<div class='menutext'><a href='/stats/hlstats.php' target='_blank'>".$locale['TH_MENU6']."</a></div>";
				echo "<div class='menutext'><a href='/team.php'>".$locale['TH_MENU7']."</a></div>";
				echo "<div class='menutext'><a href='/vip.php'>".$locale['TH_MENU8']."</a></div>";
			echo "</ul>";
		echo "</div>";
		echo "<div id='groups'>";
			echo "<ul class='display-flex'>";
				echo "<a href='".$locale['TH_LINK1']."' target='_blank'><div class='yt'><div class='gbg'></div></div></a>";
				echo "<a href='".$locale['TH_LINK2']."' target='_blank'><div class='fb'><div class='gbg'></div></div></a>";
				echo "<a href='".$locale['TH_LINK3']."' target='_blank'><div class='st'><div class='gbg'></div></div></a>";
			echo "</ul>";
		echo "</div>";
	echo "</div>";

	//Content
	echo "<table cellspacing='0' cellpadding='0' width='1200px' class='outer-border center'>\n<tr>\n";
	echo "<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
	if (RIGHT) { echo "<td class='side-border-right' valign='top'>".LEFT.RIGHT."</td>"; }
	echo "</tr>\n</table>\n";

	//Footer




?>
<footer class='subfooter' style='margin-right: auto;margin-left: auto;'>
<div class='container'>
<div class='col-lg-12'>
<div class='row'>
<div class='subfooter2'> 
<?php
echo "
<div class='col-lg-1'> 
 <div class='subfooterTITUL'>".$locale['TH_FOOTER1']."</div>
 <div class='infoTEXT'>".$locale['TH_FOOTER2']."</div>
 </div>

 <div class='col-lg-2'> 
 <div class='subfooterTITUL'>".$locale['TH_FOOTER3']."</div>
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' TARGET='_blank' data-toggle='tooltip' title='www.nonsteam.cz' rel='nofollow'>Link #1</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' TARGET='_blank' data-toggle='tooltip' title='www.serverbook.cz' rel='nofollow'>Link #2</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' TARGET='_blank' data-toggle='tooltip' title='www.herni-servery.cz' rel='nofollow'>Link #3</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' TARGET='_blank' data-toggle='tooltip' title='www.gametracker.com' rel='nofollow'>Link #4</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' TARGET='_blank' data-toggle='tooltip' title='Voľná reklamná plocha' rel='nofollow'>Link #5</a> </div> 
 </div> 



 <div class='col-lg-3'> 
 <div class='subfooterTITUL'>".$locale['TH_FOOTER4']."</div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' data-toggle='tooltip' title='Žiadosť o práva' rel='nofollow'>Link #1</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' data-toggle='tooltip' title='Žiadosť o unban' rel='nofollow'>Link #2</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' data-toggle='tooltip' title='VIP Podpora' rel='nofollow'>Link #3</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' data-toggle='tooltip' title='Podporte nás' rel='nofollow'>Link #4</a> </div> 
 <div class='linkODKAZ'> <i style='font-size:25px' class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i> &nbsp; <a href='#' data-toggle='tooltip' title='Spolupracujeme' rel='nofollow'>Link #5</a> </div> 
 </div> 

 <div class='col-lg-4'> 
 <div class='subfooterTITUL'>".$locale['TH_FOOTER5']."</div> 
 <div class='linkODKAZ'> <i class='fa fa-angle-right linkRIGHT' aria-hidden='true'></i>
 <center>
	<a href='http://www.nonsteam.cz' TARGET='_blank'><img src='https://www.freeplay.sk/img/ns.png' alt='nonsteam.cz - seznam CZ/SK Non-Steam Counter Strike serverů' style='border: 0; width: 88px; height: 31px;'></a>
	&nbsp;&nbsp;&nbsp;<a href='http://www.nonsteam.cz' TARGET='_blank'><img src='https://www.freeplay.sk/img/ns.png' alt='nonsteam.cz - seznam CZ/SK Non-Steam Counter Strike serverů' style='border: 0; width: 88px; height: 31px;'></a>
	<br />
	<br />
	<img src='https://toplist.cz/count.asp?id=1792806&logo=mc' border='0' alt='TOPlist' width='88' height='60'/>
</center>
</div>
</div>
";
?>


 </div> 
 </div> 
 </div> 
 </div> 
 </div>

<?php
}


function render_comments($c_data, $c_info){



	opentable("Komentáre");



		if (!empty($c_data)){



			//if ($c_info['admin_link'] !== false) { echp $c_info['admin_link']; }







			foreach($c_data as $data) {



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







//Funkcie
function render_news($subject, $news, $info) 
{
	$top = dbarray(dbquery("SELECT * FROM ".DB_PREFIX."news WHERE news_id='".$info['news_id']."'"));

	if($top['news_sticky'] == '1')
	{
		$hlavna = "<td class='capmain-dl'><strong> ".$subject."</strong>";
	}
	else
	{
		$hlavna = "<td class='capmain'><strong>".$subject."</strong>";
	}
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='border'>\n<tr>\n";
	echo "".$hlavna."";
	echo "<span class='footer-float-right1'>";
	echo newsposter($info);
	echo "</span>";
	echo "</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='news-body'>".$info['cat_image'].$news."</td>\n";
	echo "</tr>\n<tr>\n";
	echo " ";
	echo "<td class='news-footer'>\n";
	echo "<span style='align='left'>Zobrazení­: <span style='color: #00FF00;'>".$info['news_reads']."</span>\n | Komentárov: <span style='color: #00FF00;'>".$info['news_comments']."</span>\n </span>\n<a href='news.php?readmore=".$info['news_id']."'><img src='/themes/freeplaySK/images/cela.png' border='0' style='margin-top:-10px; margin-bottom:5px;' align='right'></a>&nbsp;&nbsp;";
	echo "</td>\n</tr>\n</table>\n";
}


function render_article($subject, $article, $info)
{
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='main-body'>".($info['article_breaks'] == "y" ? nl2br($article) : $article)."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo articleposter($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</td>\n</tr>\n</table>\n";
}

function openslider() {
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td><iframe src='".THEME."slider1/slider.html' frameborder='0' scrolling='no' style='height: 400px; width: 240px;margin: 0px; margin-left: -8px; margin-top: -8px; padding: 0px;'></iframe>\n";
}

function closeslider() {
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
}

function opentable($title) {
    if(iADMIN && isset($_GET["aid"])){
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='admin-cap'>".$title."</td>\n";
	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
	echo "<td class='admin-body'>\n";
    }else{
	echo "<br><table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain'>".$title."</td>\n";
	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='main-body'>\n";
    }
}

function closetable() {
    if(iADMIN && isset($_GET["aid"])){
  echo "</td>\n";
  echo "</tr>\n";
  echo "</table>\n";
    }else{
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td class='down-cap'></td>\n";
  echo "</tr>\n";
  echo "</table>\n";
    }
}

function openside($title, $collapse = false, $state = "on") {
	global $panel_collapse; $panel_collapse = $collapse;
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='scapmain'>$title</td>\n";
	if ($collapse == true) {
		$boxname = str_replace(" ", "", $title);
		echo "<td class='scapmain' align='right'>".panelbutton($state, $boxname)."</td>\n";
	}
	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='side-body'>\n";	
	if ($collapse == true) { echo panelstate($state, $boxname); }
}

function closeside() {
	global $panel_collapse;
	if ($panel_collapse == true) { echo "</div>\n"; }
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td class='down-scap'></td>\n";
  echo "</tr>\n";
  echo "</table>\n";
}

function openside1($title, $collapse = false, $state = "on") {
	global $panel_collapse; $panel_collapse = $collapse;
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
	echo "<td class='scapmain1'>$title</td>\n";
	if ($collapse == true) {
		$boxname = str_replace(" ", "", $title);
		echo "<td class='scapmain1' align='right'>".panelbutton($state, $boxname)."</td>\n";
	}
	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
	echo "<td class='side-body'>\n";	
	if ($collapse == true) { echo panelstate($state, $boxname); }
}

function closeside1() {
	global $panel_collapse;
	if ($panel_collapse == true) { echo "</div>\n"; }
  echo "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "<td class='down-scap'></td>\n";
  echo "</tr>\n";
  echo "</table>\n";
}
?>



