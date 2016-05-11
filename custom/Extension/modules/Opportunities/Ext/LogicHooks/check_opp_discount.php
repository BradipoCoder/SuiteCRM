<?php
$hook_version = 1;
$hook_array = array();
$hook_array['before_save'] = array();
$hook_array['before_save'][] = array(
    1,
    'Check discount percentage on opp save',
    'custom/modules/Opportunities/customLogicHook.php',
    'CheckOppDiscount',
    'check_opp_discount'
);
