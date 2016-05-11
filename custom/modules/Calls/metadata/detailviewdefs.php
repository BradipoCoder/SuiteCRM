<?php
$viewdefs ['Calls'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 
          array (
            'customCode' => '{if $fields.status.value != "Held" && $bean->aclAccess("edit")} <input type="hidden" name="isSaveAndNew" value="false">  <input type="hidden" name="status" value="">  <input type="hidden" name="isSaveFromDetailView" value="true">  <input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}"   class="button"  onclick="this.form.status.value=\'Held\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Calls\';this.form.isDuplicate.value=true;this.form.isSaveAndNew.value=true;this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'" id="close_create_button" name="button"  value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}"  type="submit">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}',
                'class' => 'button',
                'onclick' => 'this.form.isSaveFromDetailView.value=true; this.form.status.value=\'Held\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Calls\';this.form.isDuplicate.value=true;this.form.isSaveAndNew.value=true;this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'',
                'name' => 'button',
                'id' => 'close_create_button',
              ),
              'template' => '{if $fields.status.value != "Held" && $bean->aclAccess("edit")}[CONTENT]{/if}',
            ),
          ),
          4 => 
          array (
            'customCode' => '{if $fields.status.value != "Held" && $bean->aclAccess("edit")} <input type="hidden" name="isSave" value="false">  <input title="{$APP.LBL_CLOSE_BUTTON_TITLE}"  accesskey="{$APP.LBL_CLOSE_BUTTON_KEY}"  class="button"  onclick="this.form.status.value=\'Held\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Calls\';this.form.isSave.value=true;this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'" id="close_button" name="button1"  value="{$APP.LBL_CLOSE_BUTTON_TITLE}"  type="submit">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
                'accesskey' => '{$APP.LBL_CLOSE_BUTTON_KEY}',
                'class' => 'button',
                'onclick' => 'this.form.status.value=\'Held\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Calls\';this.form.isSave.value=true;this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\';this.form.isSaveFromDetailView.value=true',
                'name' => 'button1',
                'id' => 'close_button',
              ),
              'template' => '{if $fields.status.value != "Held" && $bean->aclAccess("edit")}[CONTENT]{/if}',
            ),
          ),
        ),
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew">',
          1 => '<input type="hidden" name="status">',
          2 => '<input type="hidden" name="result_c" value="Held_Recall">',
          3 => '<input type="hidden" name="isSaveFromDetailView">',
          4 => '<input type="hidden" name="isSave">',
        ),
        'headerTpl' => 'modules/Calls/tpls/detailHeader.tpl',
      ),
      'maxColumns' => '2',
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
      'useTabs' => true,
      'includes' => 
      array (
        'SA_RESCHEDULE' => 
        array (
          'file' => 'modules/Calls_Reschedule/reschedule_form.js',
        ),
        0 => 
        array (
          'file' => 'modules/Reminders/Reminders.js',
        ),
      ),
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
            'label' => 'LBL_SUBJECT',
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
            'customCode' => '{$fields.date_start.value} {$fields.time_start.value}&nbsp;',
            'label' => 'LBL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'parent_name',
            'customLabel' => '{sugar_translate label=\'LBL_MODULE_NAME\' module=$fields.parent_type.value}',
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
            'comment' => 'The status of the call (Held, Not Held, etc.)',
            'studio' => 
            array (
              'detailview' => false,
            ),
            'label' => 'LBL_STATUS',
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
            'customCode' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV}&nbsp;',
            'label' => 'LBL_DURATION',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'customCode' => '{$fields.assigned_user_name.value}',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'direction',
            'customCode' => '{$fields.direction.options[$fields.direction.value]} {$fields.status.options[$fields.status.value]}',
            'label' => 'LBL_STATUS',
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
