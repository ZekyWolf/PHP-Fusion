<?php
    $limit = 10;
    $total_rows = dbrows(dbquery("SELECT * FROM ".DB_ADMINS_USERS.";"));
    $rowstart = isset($_GET['rowstart']) && ($_GET['rowstart'] <= $total_rows) ? $_GET['rowstart'] : 0;

    $result = dbquery("SELECT * FROM ".DB_ADMINS_USERS." LIMIT $rowstart, $limit");

    opentable($locale['as_alist']);
    echo '<div class="table-responsive"><table class="table">';
        echo '<thead>';
            echo '<th>#</th>';
            echo '<th>'.$locale["atl_name"].'</th>';
            echo '<th>'.$locale["atl_position"].'</th>';
            echo '<th>'.$locale["atl_note"].'</th>';
            echo '<th>'.$locale['agl_action'].'</th>';
        echo '</thead>';
    if (dbrows($result) > 0){
        while ($data = dbarray($result)) {
            echo '<tbody>';
                echo '<th>' . $data["id"] . '</th>';
                $result_client = dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$data['user_id']."';");
                $data_client = dbarray($result_client);
                echo '<th>' . $data_client["user_name"] . '</th>';
                echo '<th>' . $data["position"] . '</th>';
                echo '<th>' . $data["note"] . '</th>';
                echo '<th class="btn-group">';
                echo '<a class="btn btn-primary" href="'.FUSION_SELF.$aidlink.'&amp;section=ateam_manage&amp;action=edit&amp;ats_id='.$data["id"].'">'.$locale['btn_edit'].'</a>';
                echo "<a class='btn btn-primary' href='".FUSION_SELF.$aidlink."&amp;action=delete&amp;section=ateam_manage&amp;ats_id=".$data['id']."' onclick=\"return confirm('".$locale['btn_confirm']."');\">".$locale['btn_delete']."</a>\n";
                echo '</th>';
            echo '<th></th>';
            echo '</tbody>';
        }
    }
    echo '</div></table>';

    if ($total_rows > $rows) {
        $filter = isset($_GET['section']) ? "&amp;section=".$_GET['section']."&amp;" : '&amp;';
        echo makepagenav($rowstart, $limit, $total_rows, $limit, clean_request("", ["section"], FALSE).$filter);
    }
    closetable();