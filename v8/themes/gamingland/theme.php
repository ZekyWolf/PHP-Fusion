<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }
define("THEME_BULLET", "");
define('LINKWEB', ($_SERVER['REQUEST_SCHEME'] == 'http' ? 'http' : 'https').'://'.(preg_match('/^[www.]+$/i', $_SERVER['SERVER_NAME']) ? 'www.' : '').$_SERVER['SERVER_NAME']);
require_once INCLUDES."theme_functions_include.php";
function render_page($license = false) {
global $settings, $main_style, $locale, $mysql_queries_time, $userdata, $aidlink, $lastvisited;

//EDIT LOCALE ----------------------------------------------------

//LOGIN
$nickname = 'Přezdívka';
$password = 'Heslo';
$submmit = 'Potvrdit';
$register = 'Registrace';
$genpassword = 'Zapomněl jsem Heslo';

//SOCIAL
$facebookurl = 'https://www.facebook.com/web';
$steamurl = '';
$youtubeurl = 'https://www.youtube.com/channel/UC5Bw7MYurqTj2Ky2IjUGEOg';

//NAVBAR
$navbar = array(
"Home"  => array("title"=>"GamerzPro.cz",  "url"=>"".LINKWEB."/news.php"),
"Forum"  => array("title"=>"Forum",  "url"=>"".LINKWEB."/forum/index.php"),
"Team"  => array("title"=>"Team",  "url"=>"".LINKWEB."/team.php"),
"Servers"  => array("title"=>"Servery",  "url"=>"".LINKWEB."/servers.php"),
"VIP"  => array("title"=>"VIP",  "url"=>"".LINKWEB."/vip/rozcestnik.php"),
"Contact"  => array("title"=>"Kontakt",  "url"=>"".LINKWEB."/contact.php"),
"HlStatsX"  => array("title"=>"HlstatsX",  "url"=>"http://hlstatsx.crew.sk/hlx_33837/hlstats.php?game=cstrike"),
"Banlist"  => array("title"=>"Banlist",  "url"=>"http://amxbans_9360.gsp-europe.net/ban_list.php"),
);

//SLIDERS
$sliders = array(
"Slider 0"  => array("number"=>"0", "line"=>"line", "active"=>"active", "images"=>"sliders5.jpg", "title"=>"Ultimátní Zombíci", "minitext"=>"Zavítejte na naše zombie servery !", "text"=>"Zavítejte na naše zombie servery čeká vás nový EXP systém, spousta zábavy nový design a hlavně nejlepší zabíjení zombieků ever !"),
"Slider 1"  => array("number"=>"1", "line"=>"line", "active"=>"", "images"=>"sliders5.jpg", "title"=>"Basebuilder",  "minitext"=>"Zavítejte na naše basebuilder servery !", "text"=>"Určitě se musíte dostavit na náš basebuilder. Mód, který vás zabaví až do konce večera."),
"Slider 2"  => array("number"=>"2", "line"=>"line", "active"=>"", "images"=>"sliders5.jpg", "title"=>"Komunikace na 1. místě",  "minitext"=>"Přijďte na náš ts3 server!", "text"=>"Přijďte na náš ts3 server a spojte se s námi !"),
"Slider 3"  => array("number"=>"3", "line"=>"", "active"=>"", "images"=>"sliders5.jpg", "title"=>"Vyzkousejte nase forum!",  "minitext"=>"Zajděte okusit naše forum! Můžete si zde požádat také o práva!", "text"=>"Již jste si všimli, že funguje na webu forum, tak tam můžete sledovat všelijaké novinky, updaty, návody a také si můžete zažádat o unban, o práva apod. Prostě směs informací na jednom místě !"),
);

//FOOTER
$copy = 'Powered by <a href="https://www.php-fusion.co.uk/" title="PHP-Fusion">PHP-Fusion</a> copyright &copy; 2002 - '.date("Y").' by Nick Jones.<br/>';
$copy2 = 'Released as free software without warranties under <a href="https://www.gnu.org/licenses/agpl-3.0.en.html" title="GNU Affero GPL v3">GNU Affero GPL v3</a>.';
$nodelete = 'Design navrhl: <a title="Barron" href="#">Barron</a>, nakódoval: <a title="Hopyers" href="http://hopyers.6f.sk">Hopyers</a>, GamerzPro.cz © Copyright 2019';
//--------------------------------------------------------------------------------------

// LOGIN
echo '<section class="login p-3">';
echo '<h2 class="hidden">Login</h2>';
echo '<div class="container">';

if (iMEMBER) {
echo '<div class="row">';

$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");

echo '<div class="col-md-10">';
echo '<div class="links" style="margin-bottom:6px">';
echo '<a href="'.BASEDIR.'edit_profile.php">'.$locale['global_120'].'</a>';
echo ' | '; 
echo '<a href="'.BASEDIR.'messages.php">'.$locale['global_121'].' ('.$msg_count.')</a>';
echo ' | '; 
echo '<a href="'.BASEDIR.'members.php">'.$locale['global_122'].'</a>';
if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
echo ' | '; 
echo '<a href="'.ADMIN.'index.php'.$aidlink.'">'.$locale['global_123'].'</a>';
}
echo ' | '; 
echo '<a href="'.BASEDIR.'index.php?logout=yes">'.$locale['global_124'].'</a>';
echo '</div>';
echo '</div>';

echo '</div>';
} else {
$action_url = $settings['opening_page'];
if (isset($_GET['error']) && isnum($_GET['error'])) {
if (isset($_GET['redirect']) && strpos(urldecode($_GET['redirect']), "/") === 0) {
$action_url = cleanurl(urldecode($_GET['redirect']));
}
}

echo '<form name="loginpageform" method="post" action="'.$action_url.'">';
echo '<div class="row">';

echo '<div class="col-md-3">';
echo '<div class="input-group input-group-sm">';
echo '<div class="input-group-prepend">';
echo '<span class="input-group-text">'.$nickname.'</span>';
echo '</div>';
echo '<input type="text" name="user_name" class="form-control" placeholder="" aria-label="">';
echo '</div>';
echo '</div>';

echo '<div class="col-md-3 marginpassword">';
echo '<div class="input-group input-group-sm">';
echo '<div class="input-group-prepend">';
echo '<span class="input-group-text passwords">'.$password.'</span>';
echo '</div>';
echo '<input type="password" name="user_pass" class="form-control passwordsinput" placeholder="" aria-label="">';
echo '</div>';
echo '</div>';

echo '<div class="col-md-1 marginbtn">';
echo '<button type="submit" name="login" class="btn btn-block btn-sm btnlogin">'.$submmit.'</button>';
echo '</div>';

echo '<div class="col-md-3">';
echo '<div class="links">';
echo '<a title="'.$register.'" href="'.LINKWEB.'/register.php">'.$register.'</a>';
echo ' | '; 
echo '<a title="'.$genpassword.'" href="'.LINKWEB.'/lostpassword.php">'.$genpassword.'</a>';
echo '</div>';
echo '</div>';

echo '</div>';
echo '</form>';
}
echo '<div class="socials text-rights">';
echo '<a title="Facebook" href="'.$facebookurl.'">';
echo '<img src="'.LINKWEB.'/'.THEME.'images/icons/fb.png" alt="Facebook">';
echo '</a>';
echo '<a title="Steam" href="'.$steamurl.'">';
echo '<img src="'.LINKWEB.'/'.THEME.'images/icons/steam.png" alt="Steam">';
echo '</a>';
echo '<a title="Youtube" href="'.$youtubeurl.'">';
echo '<img src="'.LINKWEB.'/'.THEME.'images/icons/yt.png" alt="Youtube">';
echo '</a>';
echo '</div>';

echo '</div>';
echo '</section>';

// HEADER
echo '<header class="p-3">';
echo '<div class="container">';
echo '<div class="row">';

echo '<div class="col-md-4 text-rightss">';
echo '<img class="logo" src="'.LINKWEB.'/'.THEME.'images/logo/logo.png" alt="logo">';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</header>';

echo '<nav class="navbar navbar-expand-lg navbar-light">';
echo '<div class="container">';
echo '<div class="row">';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';

echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
echo '<ul class="navbar-nav mr-auto">';

foreach($navbar as $key => $data){
echo '<li class="nav-item'.(strpos(strtolower($data['url']), strtolower($_SERVER["REQUEST_URI"])) !== false ? ' active':null).'">';
echo '<a class="nav-link" title="'.$data["title"].'" href="'.$data["url"].'">'.$data["title"].'</a>';
echo '</li>';
}

echo '</ul>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</nav>';

// STRED
echo '<section class="containers">';
echo '<h2 class="hidden">Container</h2>';
echo '<div class="container">';
echo '<div class="row containers">';

if (preg_match("#news.php#", FUSION_REQUEST)) {
echo '<div class="col-md-8 mt-4">';
echo '<div id="sliders" class="carousel slide carousel-fade" data-ride="carousel">';
echo '<div class="carousel-inner">';

foreach($sliders as $key => $data){
echo '<div class="carousel-item '.$data["active"].'">';
echo '<div class="sliders" style="background-image:url('.LINKWEB.'/'.THEME.'images/sliders/'.$data["images"].'">';
echo '<div class="info p-3">';
echo '<div class="h4">';
echo $data["title"];
echo '</div>';
echo '<p>';
echo $data["text"];
echo '</p>';
echo '</div>';
echo '</div>';
echo '</div>';
}

echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="col-md-4 mt-4">';
echo '<div class="subsliders">';

foreach($sliders as $key => $data){
echo '<div class="carousel-buttons">';
echo '<a data-target="#sliders" data-slide-to="'.$data["number"].'" href="#">';
echo '<div class="p-3 subsliders2 '.$data["active"].'">';
echo '<span class="fa fa-chevron-left" aria-hidden="true"></span>';
echo '<div class="text">';
echo '<div class="titles">'.$data["title"].'</div>';
echo '<div class="texts">'.$data["minitext"].'</div>';
echo '</div>';
echo '<div class="'.$data["line"].'"></div>';
echo '</div>';
echo '</a>';
echo '</div>';
}

echo '</div>';
echo '</div>';
}else{
}

echo '<div class="col-md-8 mt-4">';
echo U_CENTER.CONTENT.L_CENTER;
echo '</div>';

echo '<div class="col-md-4 mt-4">';
echo LEFT.RIGHT;
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

// FOOTER
echo '<footer>';
echo '<div class="container">';
echo '<div class="row">';

echo '<div class="col-md-6 mt-3">';
echo '<p>';
echo $copy;
echo $copy2;
echo '</p>';
echo '</div>';

echo '<div class="col-md-6 mb-3 forumssss">';
echo '<span>';
echo $nodelete;
echo '</span>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</footer>';

}
function render_comments($c_data, $c_info){
global $locale, $settings;
opentable($locale['c100']);
if (!empty($c_data)){
echo "<div class='comments floatfix'>\n";
$c_makepagenav = '';
if ($c_info['c_makepagenav'] !== FALSE) { 
echo $c_makepagenav = "<div style='text-align:center;margin-bottom:5px;'>".$c_info['c_makepagenav']."</div>\n"; 
}
foreach($c_data as $data) {
$comm_count = "<a href='".FUSION_REQUEST."#c".$data['comment_id']."' id='c".$data['comment_id']."' name='c".$data['comment_id']."'>#".$data['i']."</a>";
echo "<div class='tbl2 clearfix floatfix'>\n";
if ($settings['comments_avatar'] == "1") { echo "<span class='comment-avatar'>".$data['user_avatar']."</span>\n"; }
echo "<span style='float:right' class='comment_actions'>".$comm_count."\n</span>\n";
echo "<span class='comment-name'>".$data['comment_name']."</span>\n<br />\n";
echo "<span class='small'>".$data['comment_datestamp']."</span>\n";
if ($data['edit_dell'] !== false) { echo "<br />\n<span class='comment_actions'>".$data['edit_dell']."\n</span>\n"; }
echo "</div>\n<div class='tbl1 comment_message'>".$data['comment_message']."</div>\n";		
}
echo $c_makepagenav;
if ($c_info['admin_link'] !== FALSE) {
echo "<div style='float:right' class='comment_admin'>".$c_info['admin_link']."</div>\n";		
}
echo "</div>\n";
} else {	
echo $locale['c101']."\n";	
}
closetable();
}
function render_news2($subject, $news, $info) {
echo '<article class="activess3 mb-5">';
echo '<div class="row mb-5">';
echo '<div class="col-md-12">';
echo '<div class="newss" style="background-image:linear-gradient(rgba(47, 154, 194, 0.0),rgba(47, 154, 194, 0.0),rgba(47, 154, 194, 0.0),rgba(16,18,23, 94%),rgba(47, 154, 194, 100%)),url('.$info['cat_image'].')"></div>';
echo '<div class="borderss"></div>';
echo '</div>';
echo '</div>';
echo '<div class="row marginss">';
echo '<div class="col-md-12">';
echo '<h2 class="mb-3">';
echo $subject;
echo '</h2>';
echo '</div>';
echo '<div class="col-md-12 infosss">';
echo '<span class="view">'.$info['news_reads'].'x prečitané</span>';
echo '<span class="comment">'.$info['news_comments'].' komentárou</span>';
echo '<span class="categorie">'.$info['cat_name'].'</span>';
echo '</div>';
echo '<div class="col-md-12">';
echo '<p class="mt-4">'.$news.'</p>';
echo '</div>';
echo '</div>';
echo '</article>';

}
function render_news($subject, $news, $info) {
echo '<div class="articles mb-4 p-3">';
echo '<div class="img p-3" style="background-image:url('.$info['cat_image'].')"></div>';
echo '<div class="h4 mt-3">';
echo $subject;
echo '</div>';
echo '<p>';
echo $news;
echo '</p>';
echo '<div class="footer">';
echo '<div class="info">';
echo 'Autor: <a title="'.$info['user_name'].'" href="'.LINKWEB.'/profile.php?lookup='.$info['user_id'].'">'.$info['user_name'].'</a> | '.$info['cat_name'];
echo '</div>';
echo '<div class="view text-right">';
echo '<a title="Zobrazit Celé" href="'.LINKWEB.'/news.php?readmore='.$info['news_id'].'">Zobrazit Celé</a>';
echo '</div>';
echo '</div>';
echo '</div>';
}
function renders_news2($subject, $news, $info) {
echo '<div class="articles mb-4 p-3">';
echo '<div class="img p-3" style="background-image:url('.$info['cat_image'].')"></div>';
echo '<div class="h4 mt-3">';
echo $subject;
echo '</div>';
echo '<p>';
echo $news;
echo '</p>';
echo '<div class="footer">';
echo '<div class="info">';
echo 'Autor: <a title="'.$info['user_name'].'" href="'.LINKWEB.'/profile.php?lookup='.$info['user_id'].'">'.$info['user_name'].'</a> | '.$info['cat_name'];
echo '</div>';
echo '</div>';
echo '</div>';
}
function render_article($subject, $article, $info) {
}
function opentable($title) {
echo '<div class="panel-title p-3">';
echo $title;
echo '</div>';
echo '<div class="panel-body mb-4 p-3">';
}
function closetable() {
echo '</div>';
}

function openside($title, $collapse = false, $state = "on") {
global $panel_collapse; $panel_collapse = $collapse;
echo '<div class="panel-title p-3">';
echo $title;
echo '</div>';
echo '<div class="panel-body mb-4 p-3">';
if ($collapse == true) {
$boxname = str_replace(" ", "", $title);
}	
if ($collapse == true) { 
echo panelstate($state, $boxname); 
}
}
function closeside() {
global $panel_collapse;
if ($panel_collapse == true) {
}	
echo '</div>';
}

