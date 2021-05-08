<?php
    defined('IN_FUSION') || exit;

    $regex = [
        '%id%'      =>      '([0-9]+)',
        '%title%'   =>      '([0-9a-zA-Z._\W]+)',
    ];

    $pattern = [
        "ATeam/%id%/%title%" => "infusions/AdminSystem/team.php?group=%id%",
        "ATeam"              => "infusions/AdminSystem/team.php",
    ];

    $pattern_tables["%id%"] = [
        "table"       => DB_ADMINS_GROUPS,
        "primary_key" => "id",
        "id"          => ["%id%" => "id"],
        "columns"     => ["%title%" => "gname"]
    ];
