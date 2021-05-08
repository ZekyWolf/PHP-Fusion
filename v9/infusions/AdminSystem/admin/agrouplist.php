<?php
    $limit = 5;
    $total_rows = dbrows(dbquery("SELECT * FROM ".DB_ADMINS_GROUPS.";"));
    $rowstart = isset($_GET['rowstart']) && ($_GET['rowstart'] <= $total_rows) ? $_GET['rowstart'] : 0;

    $result = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." LIMIT $rowstart, $limit");

    opentable($locale['agl_title']);
    echo '<div class="table-responsive"><table class="table">';
        echo '<thead>';
            echo '<th>#</th>';
            echo '<th>'.$locale['agl_name'].'</th>';
            echo '<th>'.$locale['agl_action'].'</th>';
        echo '</thead>';
    if (dbrows($result) > 0){
        while ($data = dbarray($result)) {
            echo '<tbody>';
                echo '<th>' . $data["id"] . '</th>';
                echo '<th>' . $data["gname"] . '</th>';
                echo '<th class="btn-group">';
                echo '<a class="btn btn-primary" href="'.FUSION_SELF.$aidlink.'&amp;section=agroup_manage&amp;action=edit&amp;ats_id='.$data["id"].'">'.$locale["btn_edit"].'</a>';
                echo "<a class='btn btn-primary' href='".FUSION_SELF.$aidlink."&amp;action=delete&amp;section=agroup_manage&amp;ats_id=".$data['id']."' onclick=\"return confirm('".$locale['btn_confirm']."');\">".$locale['btn_delete']."</a>\n";
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