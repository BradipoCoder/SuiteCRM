<?php
// created: 2016-08-10 13:43:23
$dictionary["mkt_Inspection_Washing"]["fields"]["mkt_inspection_washing_accounts"] = array(
    'name'         => 'mkt_inspection_washing_accounts',
    'type'         => 'link',
    'relationship' => 'mkt_inspection_washing_accounts',
    'source'       => 'non-db',
    'module'       => 'Accounts',
    'bean_name'    => 'Account',
    'vname'        => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'id_name'      => 'mkt_inspection_washing_accountsaccounts_ida',
);
$dictionary["mkt_Inspection_Washing"]["fields"]["mkt_inspection_washing_accounts_name"] = array(
    'name'    => 'mkt_inspection_washing_accounts_name',
    'type'    => 'relate',
    'source'  => 'non-db',
    'vname'   => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_ACCOUNTS_TITLE',
    'save'    => true,
    'id_name' => 'mkt_inspection_washing_accountsaccounts_ida',
    'link'    => 'mkt_inspection_washing_accounts',
    'table'   => 'accounts',
    'module'  => 'Accounts',
    'rname'   => 'name',
);
$dictionary["mkt_Inspection_Washing"]["fields"]["mkt_inspection_washing_accountsaccounts_ida"] = array(
    'name'         => 'mkt_inspection_washing_accountsaccounts_ida',
    'type'         => 'link',
    'relationship' => 'mkt_inspection_washing_accounts',
    'source'       => 'non-db',
    'reportable'   => false,
    'side'         => 'right',
    'vname'        => 'LBL_MKT_INSPECTION_WASHING_ACCOUNTS_FROM_MKT_INSPECTION_WASHING_TITLE',
);
