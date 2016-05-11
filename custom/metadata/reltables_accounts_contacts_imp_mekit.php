<?php

/**
 * Creating 10 relationship tables between accounts and contacts
 */
foreach (array('imp', 'mekit') as $___GROUP) {
    foreach (array('adm', 'dir', 'acq', 'com', 'opr') as $___POSITION) {
        $___REL_NAME = 'accounts_contacts_' . $___GROUP . '_' . $___POSITION;
        $dictionary[$___REL_NAME] = array();
        $dictionary[$___REL_NAME]['true_relationship_type'] = 'many-to-many';
        $dictionary[$___REL_NAME]['table'] = $___REL_NAME;
        $dictionary[$___REL_NAME]['relationships'] = array();
        $dictionary[$___REL_NAME]['relationships'][$___REL_NAME] = array(
            'lhs_module' => 'Accounts',
            'lhs_table' => 'accounts',
            'lhs_key' => 'id',
            'rhs_module' => 'Contacts',
            'rhs_table' => 'contacts',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => $___REL_NAME,
            'join_key_lhs' => 'account_id',
            'join_key_rhs' => 'contact_id'
        );
        $dictionary[$___REL_NAME]['fields'] = array(
            0 => array('name' => 'id', 'type' => 'varchar', 'len' => 36),
            1 => array('name' => 'date_modified', 'type' => 'datetime'),
            2 => array('name' => 'deleted', 'type' => 'bool', 'len' => '1', 'default' => '0', 'required' => TRUE),
            3 => array('name' => 'account_id', 'type' => 'varchar', 'len' => 36),
            4 => array('name' => 'contact_id', 'type' => 'varchar', 'len' => 36),
        );
        $dictionary[$___REL_NAME]['indices'] = array(
            0 => array(
                'name' => 'pk_' . $___REL_NAME,
                'type' => 'primary',
                'fields' =>
                    array(
                        0 => 'id',
                    ),
            ),
            1 => array(
                'name' => 'idx_' . $___REL_NAME,
                'type' => 'alternate_key',
                'fields' =>
                    array(
                        0 => 'account_id',
                        1 => 'contact_id',
                    ),
            ),
            2 => array(
                'name' => 'idx_del_' . $___REL_NAME,
                'type' => 'alternate_key',
                'fields' =>
                    array(
                        0 => 'account_id',
                        1 => 'contact_id',
                        2 => 'deleted',
                    ),
            ),
        );
    }
}
