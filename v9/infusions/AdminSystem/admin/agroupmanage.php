<?php
    $atsid = isset($_POST['ats_id']) ? $_POST['ats_id'] : $_GET['ats_id'];
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ats_id']) && isnum($_GET['ats_id']))
    {
        $result = dbquery("DELETE FROM ".DB_ADMINS_GROUPS." WHERE id=".$atsid.";");
        redirect(FUSION_SELF.$aidlink);
    }
    if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_POST['ats_id']) && isnum($_POST['ats_id'])) || (isset($_GET['ats_id']) && isnum($_GET['ats_id'])))
    {
    	$result = dbquery("SELECT * FROM ".DB_ADMINS_GROUPS." WHERE id=".$atsid.";");
    	if(dbrows($result)){
    		$data = dbarray($result);
    	}else{
    		redirect(FUSION_SELF.$aidlink);
    	}
    }
    /**
     * Admin Group Create
     */
    if(isset($_POST['CreateAdminGroup'])){
        if(empty(post('gname'))){ addNotice('danger', 'Please add Group Name.'); }

        $data = [
            'gname'          	=>  form_sanitizer(post('gname'), '', 'gname')
        ];
        if (\defender::safe()){
            addNotice('success', 'Group: '.$data['gname'].' created.');
            dbquery("INSERT INTO ".DB_ADMINS_GROUPS." SET gname='".$data['gname']."';");
        }else{
            addNotice('danger', 'Something went wrong...');
        }
        redirect(FUSION_REQUEST);
    }
    /**
     * Admin Group Update
     */
    if(isset($_POST['UpdateAdminGroup'])){
        if(empty(post('gname'))){ addNotice('danger', 'Please add Group Name.'); }

        $data = [
            'gname'          	=>  form_sanitizer(post('gname'), '', 'gname')
        ];
        if (\defender::safe()){
            addNotice('success', 'Group: '.$data['gname'].' updated.');
            dbquery("UPDATE ".DB_ADMINS_GROUPS." SET gname='".$data['gname']."' WHERE id='".$atsid."';");
        }else{
            addNotice('danger', 'Something went wrong...');
        }
        redirect(FUSION_REQUEST);
    }

    /**
     * Forms
     */
    $locale = fusion_get_locale();
    $aidlink = fusion_get_aidlink();

    opentable($edit ? $locale['as_gedit'] : $locale['as_gcreate']);
    echo openform('inputform', 'post', FUSION_REQUEST);
    echo "<div class='row'>\n";
    echo '<div class="table-responsive"><table class="table">';
    echo "<div class='col-xs-12 col-sm-12 col-md-7 col-lg-8'>\n";
    echo form_text('gname', $locale['apm_gname'], isset($data['gname']) ? $data['gname'] : '', [
        'required'    => TRUE,
        'inline'      => TRUE,
        'placeholder' => "Owners",
        'max_length'  => 64,
        'error_text'  => "Please add correct group name"
    ]);

    if($edit){
        echo form_button('UpdateAdminGroup', $locale['agm_bedit'], $locale['agm_bedit']);
    }else{
        echo form_button('CreateAdminGroup', $locale['agm_bcreate'], $locale['agm_bcreate']);
    }
    
    echo "</div>\n";
    echo '</div></table>';
    echo "</div>\n";
    echo closeform();
    closetable();