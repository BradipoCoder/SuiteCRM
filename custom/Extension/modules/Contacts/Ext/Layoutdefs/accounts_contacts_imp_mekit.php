<?php

/**
 * Creating 10 subpanels for relationships between accounts and contacts
 */
use Mekit\SugarCrm\SecurityGroup AS MekitSecurityGroup;

$___ORDER = 30;
foreach (array('imp', 'mekit') as $___GROUP) {
    if(MekitSecurityGroup::isCurrentUserInGroup($___GROUP)) {
        foreach (array('adm', 'dir', 'acq', 'com', 'opr') as $___POSITION) {
            $___REL_NAME = 'accounts_contacts_' . $___GROUP . '_' . $___POSITION;
            $___LABEL = strtoupper('LBL_' . $___REL_NAME . '_ACCOUNTS');//LBL_ACCOUNTS_CONTACTS_IMP_ADM_ACCOUNTS
            $layout_defs["Contacts"]["subpanel_setup"][$___REL_NAME] = array(
                'order' => $___ORDER++,
                'module' => 'Accounts',
                'subpanel_name' => 'default',
                'sort_order' => 'asc',
                'sort_by' => 'id',
                'title_key' => $___LABEL,
                'get_subpanel_data' => $___REL_NAME,
                'top_buttons' => array(
                    0 => array('widget_class' => 'SubPanelTopButtonQuickCreate'),
                    1 => array('widget_class' => 'SubPanelTopSelectButton', 'mode' => 'MultiSelect')
                ),
            );
        }
    }
}
