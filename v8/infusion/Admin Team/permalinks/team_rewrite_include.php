<?php
if (!defined("IN_FUSION")) {
    die("Access Denied");
}

$regex = [
    "%id%"    => "([0-9]+)",
    '%title%' => '([0-9a-zA-Z._\W]+)',
];

$pattern = [
    "team/%id%" => "infusions/admin_system/team.php?skupina=%id%",
    "team"              => "infusions/admin_system/team.php",
];

$pattern_tables["%id%"] = [
    "table"       => DB_ADMINS_GROUPS,
    "primary_key" => "id",
    "id"          => ["%id%" => "id"],
    //"columns"     => ["%title%" => "nazev"]
];
