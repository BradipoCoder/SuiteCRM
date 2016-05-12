<?php
/**
 * Created by Adam Jakab.
 * Date: 12/05/16
 * implemented in: custom/Extension/modules/Calls/Ext/LogicHooks/logic_hooks.php
 */
$hook_array['before_save'][] = Array(
    999,
    'Calls Custom Fix Dates',
    'custom/modules/Calls/Hooks/HookCallsCustomFixDates.php',
    'HookCallsCustomFixDates',
    'fixEmptyScheduledDate'
);

