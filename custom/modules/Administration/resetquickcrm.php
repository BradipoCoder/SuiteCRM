<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile Full.
 * QuickCRM Mobile Full is a mobile client for SugarCRM
 * 
 * Author : NS-Team (http://www.ns-team.fr)
 * All rights (c) 2011-2016 by NS-Team
 *
 * This Version of the QuickCRM Mobile Full is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of NS-Team
 * 
 * You can contact NS-Team at NS-Team - 55 Chemin de Mervilla - 31320 Auzeville - France
 * or via email at infos@ns-team.fr
 * 
 ********************************************************************************/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings;

if(isset($_POST['confirmed_yes']) && $_POST['confirmed_yes']==1){

    global $sugar_config;
    require_once('modules/Administration/Administration.php');
    $administration = new Administration();
    $administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'mobile_config', "");
    $administration->saveSetting('QuickCRM', ($sugar_config['quickcrm_trial'] != false?'trial':'').'mobileconfig', "");
    header("Location: index.php?module=Administration&action=updatequickcrmpro");
}
?>
<h2 style="text-align: center"><?php echo $mod_strings['LBL_RESET_QUICKCRM'] ?></h2>
<form method="post" name="confirm"  id="confirm" action="">
    <input type="hidden" value="1" name="confirmed_yes">
</form>
<script type="application/javascript">
    window.onload = function () {
        var yes = confirm("<?php echo $mod_strings['LBL_RESET_QUICKCRM_CONFIRMATION']?>")

        if (yes) {
            document.getElementById("confirm").submit();
        } else {
            window.location.replace("index.php?module=Administration&action=index");
        }
    }

</script>