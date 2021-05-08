<?php
    /*-------------------------------------------------------+
    | PHPFusion Content Management System
    | Copyright (C) PHP Fusion Inc
    | https://phpfusion.com/
    +--------------------------------------------------------+
    | Filename: infusion_db.php
    | Author: Zeky
    +--------------------------------------------------------+
    | This program is released as free software under the
    | Affero GPL license. You can redistribute it and/or
    | modify it under the terms of this license which you
    | can read by viewing the included agpl.txt or online
    | at www.gnu.org/licenses/agpl.html. Removal of this
    | copyright header is strictly prohibited without
    | written permission from the original author(s).
    +--------------------------------------------------------*/
    defined('IN_FUSION') || exit;


    if (!defined('ADMINSYSTEM')) {
        define('ADMINSYSTEM', INFUSIONS.'AdminSystem/');
    }

    if (!defined('AS_LOCALE')) {
        if (file_exists(INFUSIONS.'AdminSystem/locale/'.LOCALESET.'/team.php')) {
            define('AS_LOCALE', INFUSIONS.'AdminSystem/locale/'.LOCALESET.'team.php');
        } else {
            define('AS_LOCALE', INFUSIONS.'AdminSystem/locale/English/team.php');
        }
    }

    //Databases
    if (!defined("DB_ADMINS_USERS")) {
		define("DB_ADMINS_USERS", DB_PREFIX."admins_users_main");
	}
	if (!defined("DB_ADMINS_GROUPS")) {
		define("DB_ADMINS_GROUPS", DB_PREFIX."admins_groups_main");
	}

    // Admin Settings
    \PHPFusion\Admins::getInstance()->setAdminPageIcons('AS', '<i class="fas fa-users"></i>');
