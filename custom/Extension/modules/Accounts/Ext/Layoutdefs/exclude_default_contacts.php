<?php
/**
 * Excluding default contacts sub-panel
 */
if(isset($layout_defs["Accounts"]["subpanel_setup"]["contacts"])) {
    unset($layout_defs["Accounts"]["subpanel_setup"]["contacts"]);
}
