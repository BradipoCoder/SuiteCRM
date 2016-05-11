<?php
$viewdefs ['Calls'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Reminders/Reminders.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Calls/js/CallsEdit.js',
        ),
      ),
      'maxColumns' => '2',
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
          1 => '<input type="hidden" name="send_invites">',
          2 => '<input type="hidden" name="user_invitees">',
          3 => '<input type="hidden" name="lead_invitees">',
          4 => '<input type="hidden" name="contact_invitees">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id="SAVE_HEADER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\'; document.EditView.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; {/if}formSubmitCheck();;" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '<input title="{$MOD.LBL_SEND_BUTTON_TITLE}" id="SAVE_SEND_HEADER" class="button" onclick="document.EditView.send_invites.value=\'1\';SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\';document.EditView.return_action.value=\'EditView\';document.EditView.return_module.value=\'{$smarty.request.return_module}\';formSubmitCheck();;" type="button" name="button" value="{$MOD.LBL_SEND_BUTTON_LABEL}">',
          ),
        ),
        'buttons_footer' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id="SAVE_FOOTER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\'; document.EditView.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; {/if}formSubmitCheck();;" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '<input title="{$MOD.LBL_SEND_BUTTON_TITLE}" id="SAVE_SEND_FOOTER" class="button" onclick="document.EditView.send_invites.value=\'1\';SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\';document.EditView.return_action.value=\'EditView\';document.EditView.return_module.value=\'{$smarty.request.return_module}\';formSubmitCheck();;" type="button" name="button" value="{$MOD.LBL_SEND_BUTTON_LABEL}">',
          ),
        ),
        'footerTpl' => 'modules/Calls/tpls/footer.tpl',
      ),
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>

<script>toggle_portal_flag();function toggle_portal_flag()  {ldelim} {$TOGGLE_JS} {rdelim}
function formSubmitCheck(){ldelim}var duration=true;if(typeof(isValidDuration)!="undefined"){ldelim}duration=isValidDuration();{rdelim}if(check_form(\'EditView\') && duration){ldelim}SUGAR.ajaxUI.submitForm("EditView");{rdelim}{rdelim}</script>',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CALL_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_call_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_schedule_c',
            'label' => 'LBL_DATE_SCHEDULE',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_start',
            'displayParams' => 
            array (
              'updateCallback' => 'SugarWidgetScheduler.update_time();',
            ),
            'label' => 'LBL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'date_end',
            'comment' => 'Date is which call is scheduled to (or did) end',
            'label' => 'LBL_DATE_END',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'direction',
              ),
              1 => 
              array (
                'name' => 'status',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'result_c',
            'studio' => 'visible',
            'label' => 'LBL_RESULT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'negative_motivation_c',
            'studio' => 'visible',
            'label' => 'LBL_NEGATIVE_MOTIVATION',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'duration_hours',
            'label' => 'LBL_DURATION',
            'customCode' => '{literal}<script type="text/javascript">function isValidDuration() { form = document.getElementById(\'EditView\'); if ( form.duration_hours.value + form.duration_minutes.value <= 0 ) { alert(\'{/literal}{$MOD.NOTICE_DURATION_TIME}{literal}\'); return false; } return true; }</script>{/literal}<input id="duration_hours" name="duration_hours" size="2" maxlength="2" type="text" value="{$fields.duration_hours.value}" onkeyup="SugarWidgetScheduler.update_time();"/>{$fields.duration_minutes.value}&nbsp;<span class="dateFormat">{$MOD.LBL_HOURS_MINUTES}</span>',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'direction',
            'comment' => 'Indicates whether call is inbound or outbound',
            'label' => 'LBL_DIRECTION',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'campagna_telefonica_c',
            'studio' => 'visible',
            'label' => 'LBL_CAMPAGNA_TELEFONICA',
          ),
          1 => 
          array (
            'name' => 'relativo_a_campagna_c',
            'studio' => 'visible',
            'label' => 'LBL_RELATIVO_A_CAMPAGNA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'office_phone_c',
            'label' => 'LBL_OFFICE_PHONE',
          ),
          1 => 
          array (
            'name' => 'call_period_c',
            'studio' => 'visible',
            'label' => 'LBL_CALL_PERIOD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'assigned_client_c',
            'label' => 'LBL_ASSIGNED_CLIENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_postalcode_c',
            'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
          ),
          1 => 
          array (
            'name' => 'billing_address_city_c',
            'label' => 'LBL_BILLING_ADDRESS_CITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street_c',
            'label' => 'LBL_BILLING_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'location_zone_c',
            'studio' => 'visible',
            'label' => 'LBL_LOCATION_ZONE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'company_status_c',
            'studio' => 'visible',
            'label' => 'LBL_COMPANY_STATUS',
          ),
          1 => 
          array (
            'name' => 'profitability_c',
            'studio' => 'visible',
            'label' => 'LBL_PROFITABILITY',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'target_c',
            'studio' => 'visible',
            'label' => 'LBL_TARGET',
          ),
          1 => 
          array (
            'name' => 'industry_c',
            'studio' => 'visible',
            'label' => 'LBL_INDUSTRY',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'istatoazienda_c',
            'studio' => 'visible',
            'label' => 'LBL_ISTATOAZIENDA',
          ),
          1 => 
          array (
            'name' => 'ifasestato_c',
            'studio' => 'visible',
            'label' => 'LBL_IFASESTATO',
          ),
        ),
      ),
    ),
  ),
);
?>
