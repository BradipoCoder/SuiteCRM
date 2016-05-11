<?php
$viewdefs ['Leads'] = 
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
            'customCode' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}<input title="{$MOD.LBL_CONVERTLEAD_TITLE}" accessKey="{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}" type="button" class="button" onClick="document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'" name="convert" value="{$MOD.LBL_CONVERTLEAD}">{/if}',
            'sugar_html' => 
            array (
              'type' => 'button',
              'value' => '{$MOD.LBL_CONVERTLEAD}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_CONVERTLEAD_TITLE}',
                'accessKey' => '{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}',
                'class' => 'button',
                'onClick' => 'document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'',
                'name' => 'convert',
                'id' => 'convert_lead_button',
              ),
              'template' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}[CONTENT]{/if}',
            ),
          ),
          4 => 'FIND_DUPLICATES',
          5 => 
          array (
            'customCode' => '<input title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" class="button" onclick="this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Leads\';" type="submit" name="Manage Subscriptions" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}">',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
                'class' => 'button',
                'id' => 'manage_subscriptions_button',
                'onclick' => 'this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Leads\';',
                'name' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
              ),
            ),
          ),
          'AOS_GENLET' => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}">',
          ),
        ),
        'headerTpl' => 'modules/Leads/tpls/DetailViewHeader.tpl',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Leads/Lead.js',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_CONTACT_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'comment' => 'First name of the contact',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'last_name',
            'comment' => 'Last name of the contact',
            'label' => 'LBL_LAST_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
          ),
          1 => 
          array (
            'name' => 'location_zone_c',
            'studio' => 'visible',
            'label' => 'LBL_LOCATION_ZONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'industry_c',
            'studio' => 'visible',
            'label' => 'LBL_INDUSTRY',
          ),
          1 => 'lead_source',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'direct_sales_c',
            'studio' => 'visible',
            'label' => 'LBL_DIRECT_SALES',
          ),
          1 => 
          array (
            'name' => 'direct_sales_notes_c',
            'label' => 'LBL_DIRECT_SALES_NOTES',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'p_iva_c',
            'label' => 'LBL_P_IVA',
          ),
          1 => 
          array (
            'name' => 'cod_fisc_c',
            'label' => 'LBL_COD_FISC',
          ),
        ),
        5 => 
        array (
          0 => 'phone_work',
          1 => 
          array (
            'name' => 'phone_alternate_c',
            'label' => 'LBL_PHONE_ALTERNATE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'mobile_1_c',
            'label' => 'LBL_MOBILE_1',
          ),
          1 => 
          array (
            'name' => 'mobile_2_c',
            'label' => 'LBL_MOBILE_2',
          ),
        ),
        7 => 
        array (
          0 => 'phone_fax',
          1 => 
          array (
            'name' => 'phone_fax_2_c',
            'label' => 'LBL_PHONE_FAX_2',
          ),
        ),
        8 => 
        array (
          0 => 'email1',
          1 => 'website',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'label' => 'LBL_PRIMARY_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
            ),
          ),
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name_ref_2_c',
            'label' => 'LBL_NAME_REF_2',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name_ref_3_c',
            'label' => 'LBL_NAME_REF_3',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'account_description',
            'comment' => 'Description of lead account',
            'label' => 'LBL_ACCOUNT_DESCRIPTION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'import_notes_c',
            'label' => 'LBL_IMPORT_NOTES',
          ),
        ),
        4 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'converted',
            'comment' => 'Has Lead been converted to a Contact (and other Sugar objects)',
            'label' => 'LBL_CONVERTED',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'agent_code_c',
            'label' => 'LBL_AGENT_CODE',
          ),
        ),
      ),
      'LBL_SUGARCHIMP' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mailchimp_rating_c',
            'label' => 'LBL_MAILCHIMP_RATING',
          ),
        ),
      ),
    ),
  ),
);
?>
