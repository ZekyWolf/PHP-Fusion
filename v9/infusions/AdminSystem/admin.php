<?php
    /*-------------------------------------------------------+
    | PHPFusion Content Management System
    | Copyright (C) PHP Fusion Inc
    | https://phpfusion.com/
    +--------------------------------------------------------+
    | Filename: admin.php
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
    require_once '../../maincore.php';
    require_once THEMES.'templates/admin_header.php';

    pageAccess('AS');

    $locale = fusion_get_locale('', AS_LOCALE);

    $allowed_pages = [
        "ateam_list", "ateam_manage", "agroup_list", "agroup_manage", "ateam_link"
    ];
    $_GET['section'] = isset($_GET['section']) && in_array($_GET['section'], $allowed_pages) ? $_GET['section'] : "";
    $edit = (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['ats_id']) && isnum($_GET['ats_id']));

    $tab['title'][] = $locale['as_alist'];
    $tab['id'][] = 'ateam_list';
    $tab['icon'][] = '';

    $tab['title'][] = $locale['as_glist'];
    $tab['id'][] = 'agroup_list';
    $tab['icon'][] = '';

    $tab['title'][] = $edit ? $locale['as_aedit'] : $locale['as_acreate'];
    $tab['id'][] = 'ateam_manage';
    $tab['icon'][] = '';

    $tab['title'][] = $edit ? $locale['as_gedit'] : $locale['as_gcreate'];
    $tab['id'][] = 'agroup_manage';
    $tab['icon'][] = '';

    $tab['title'][] = $locale['as_teamlink'];
    $tab['id'][] = 'ateam_link';
    $tab['icon'][] = '';

    $tab_active = $_GET['section'];
    opentable("Admin System");
    echo opentab($tab, $tab_active, "AdminSystem", TRUE, "", "section", ['rowstart', 'filter_cid']);
    switch ($_GET['section']) {
        case "ateam_list":
            include "admin/ateamlist.php";
            break;
        case "ateam_manage":
            include "admin/ateammanage.php";
            break;
        case "agroup_list":
            include "admin/agrouplist.php";
            break;
        case "agroup_manage":
            include "admin/agroupmanage.php";
            break;
        case "ateam_link":
            redirect(INFUSIONS."AdminSystem/team.php?group=1");
            break;
        default: 
            include "admin/default_page.php";
    }
    echo closetab();
    closetable();
    require_once THEMES.'templates/footer.php';
