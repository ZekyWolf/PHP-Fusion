<?php
    /*-------------------------------------------------------+
    | PHPFusion Content Management System
    | Copyright (C) PHP Fusion Inc
    | https://phpfusion.com/
    +--------------------------------------------------------+
    | Filename: infusion.php
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

    $locale = fusion_get_locale('', AS_LOCALE);

    /**
     * Infusion general information
     */
    $inf_title = $locale['as_title'];
    $inf_description = $locale['as_desc'];
    $inf_version = '1.0.0';
    $inf_developer = 'Zeky';
    $inf_email = 'zeky@gamenation.eu';
    $inf_weburl = 'https://gamenation.eu/';
    $inf_folder = 'AdminSystem';
    $inf_image = 'images/team.svg';

    /**
     * Admin Panel Info
     */
    $inf_adminpanel[] = [
        'rights'   => 'AS',
        'image'    => $inf_image,
        'title'    => $locale['as_title'],
        'panel'    => 'admin.php',
        'page'     => 6,
        'language' => LANGUAGE
    ];

    /**
     * Database create
     */
    $inf_newtable[1] = DB_ADMINS_USERS." (
		`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
		`groupid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
		`user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
		`position` VARCHAR(200) NOT NULL,
		`note` VARCHAR(200) NOT NULL,
		PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci;";
    // Second
	$inf_newtable[2] = DB_ADMINS_GROUPS." (
		`id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
		`gname` VARCHAR(100) NOT NULL,
		PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci;";
    
    /**
     * Uninstall and delete rights
     */
    $inf_droptable[1] = DB_ADMINS_USERS;
    $inf_droptable[2] = DB_ADMINS_GROUPS;
    $inf_deldbrow[] = DB_ADMIN." WHERE admin_rights='AS'";