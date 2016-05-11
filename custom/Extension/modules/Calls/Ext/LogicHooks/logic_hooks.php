<?php
/**
 * Created by Adam Jakab.
 * Date: 29/04/16
 * Time: 11.17
 */
$hook_array['before_save'][] = Array(
    999,
    'Calls Custom Fix Dates',
    'custom/modules/Calls/Hooks/HookCallsCustomFixDates.php',
    'HookCallsCustomFixDates',
    'fixEmptyScheduledDate'
);

