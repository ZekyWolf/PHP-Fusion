<?php
    $atsid = isset($_POST['ats_id']) ? $_POST['ats_id'] : $_GET['ats_id'];
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ats_id']) && isnum($_GET['ats_id']))
    {
        $result = dbquery("DELETE FROM ".DB_ADMINS_USERS." WHERE id=".$atsid.";");
        redirect(FUSION_SELF.$aidlink);
    }
    if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['ats_id']) && isnum($_POST['ats_id'])) || (isset($_GET['ats_id']) && isnum($_GET['ats_id'])))
    {
    	$result = dbquery("SELECT * FROM ".DB_ADMINS_USERS." WHERE id='".$atsid."';");
    	if(dbrows($result)){
    		$data = dbarray($result);
    	}else{
    		redirect(FUSION_SELF.$aidlink);
    	}
    }
    /**
     * Saves
     */
    if(isset($_POST['CreateAdminInTeam'])){
        if(empty(post('position'))){ 
            addNotice('danger', 'Please add Position.'); 
            redirect(FUSION_REQUEST);
        }
        if(empty(post('groupid'))){ 
            addNotice('danger', 'Please choose group.'); 
            redirect(FUSION_REQUEST);
        }

        if (\defender::safe()){
            addNotice('success', 'Craeted !');
            dbquery("INSERT INTO ".DB_ADMINS_USERS." SET 
            groupid='".post('groupid')."', 
            user_id='".post('user_id')."',
            position='".post('position')."',
            note='".post('note')."';");
        }else{
            addNotice('danger', 'Something went wrong...');
        }
        redirect(FUSION_SELF.$aidlink."&section=ateam_list");
    }
    /**
     * Update
     */
    if(isset($_POST['UpdateAdminInTeam'])){
        if(empty(post('position'))){ addNotice('danger', 'Please add Position.'); }

        if (\defender::safe()){
            addNotice('success', 'Updated !');
            dbquery("UPDATE ".DB_ADMINS_USERS." SET 
            groupid='".post('groupid')."', 
            user_id='".post('user_id')."',
            position='".post('position')."',
            note='".post('note')."' WHERE id='".$atsid."';");
        }else{
            addNotice('danger', 'Something went wrong...');
        }
        redirect(FUSION_SELF.$aidlink."&section=ateam_list");
    }
    /**
     * Forms
     */
    $locale = fusion_get_locale();
    $aidlink = fusion_get_aidlink();

    opentable($edit ? $locale['as_aedit'] : $locale['as_acreate']);
    echo openform('inputform', 'post', FUSION_REQUEST);
    echo "<div class='row'>\n";
    echo '<div class="table-responsive"><table class="table">';
    echo "<div class='col-xs-12 col-sm-12 col-md-7 col-lg-8'>\n";
 
    $group_options = [];
    $result_g = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS.";");
    if (dbrows($result_g) > 0) {
        while ($data_g = dbarray($result_g)) {
            $group_options[$data_g['id']] = $data_g['gname'];
        }
    }
    echo form_select('groupid', $locale['apm_gname'], isset($data['groupid']) ? $data['groupid'] : '', [
        "inline"  => TRUE,
        'options' => $group_options
    ]);

    //Users
    $users_options = [];
    $result_u = dbquery("SELECT * FROM ".DB_USERS." WHERE 1 ORDER BY user_id");
    if (dbrows($result_u) > 0) {
        while ($data_u = dbarray($result_u)) {
            $users_options[$data_u['user_id']] = $data_u['user_name'];
        }
    }
    echo form_select('user_id', $locale['atl_name'], isset($data['user_id']) ? $data['user_id'] : '', [
        "inline"  => TRUE,
        'options' => $users_options
    ]);

    echo form_text('position', $locale['atl_position'], isset($data['position']) ? $data['position'] : '', [
        'required'    => TRUE,
        'inline'      => TRUE,
        'placeholder' => "Owner",
        'max_length'  => 64,
        'error_text'  => "Please add correct positon"
    ]);
    echo form_text('note', $locale["atl_note"], isset($data['note']) ? $data['note'] : '', [
        'required'    => FALSE,
        'inline'      => TRUE,
        'placeholder' => "This is just in admin",
        'max_length'  => 64,
        'error_text'  => "Please add correct positon"
    ]);
    
    if($edit){
        echo form_button('UpdateAdminInTeam', $locale['as_aedit'], $locale['as_aedit']);
    }else{
        echo form_button('CreateAdminInTeam', $locale['as_acreate'], $locale['as_acreate']);
    }
    echo "</div>\n";
    echo '</div></table>';
    echo "</div>\n";
    echo closeform();
    closetable();