<?php
$module_name = 'AOS_Quotes';
$_object_name = 'aos_quotes';
$viewdefs [$module_name] = 
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
          3 => 'FIND_DUPLICATES',
          4 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup(\'pdf\');" value="{$MOD.LBL_PRINT_AS_PDF}">',
          ),
          5 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup(\'emailpdf\');" value="{$MOD.LBL_EMAIL_PDF}">',
          ),
          6 => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup(\'email\');" value="{$MOD.LBL_EMAIL_QUOTE}">',
          ),
          7 => 
          array (
            'customCode' => '<input type="submit" class="button" onClick="this.form.action.value=\'createOpportunity\';" value="{$MOD.LBL_CREATE_OPPORTUNITY}">',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_CREATE_OPPORTUNITY}',
              'htmlOptions' => 
              array (
                'class' => 'button',
                'id' => 'create_contract_button',
                'title' => '{$MOD.LBL_CREATE_OPPORTUNITY}',
                'onclick' => 'this.form.action.value=\'createOpportunity\';',
                'name' => 'Create Opportunity',
              ),
            ),
          ),
          8 => 
          array (
            'customCode' => '<input type="submit" class="button" onClick="this.form.action.value=\'createContract\';" value="{$MOD.LBL_CREATE_CONTRACT}">',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_CREATE_CONTRACT}',
              'htmlOptions' => 
              array (
                'class' => 'button',
                'id' => 'create_contract_button',
                'title' => '{$MOD.LBL_CREATE_CONTRACT}',
                'onclick' => 'this.form.action.value=\'createContract\';',
                'name' => 'Create Contract',
              ),
            ),
          ),
          9 => 
          array (
            'customCode' => '<input type="submit" class="button" onClick="this.form.action.value=\'converToInvoice\';" value="{$MOD.LBL_CONVERT_TO_INVOICE}">',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$MOD.LBL_CONVERT_TO_INVOICE}',
              'htmlOptions' => 
              array (
                'class' => 'button',
                'id' => 'convert_to_invoice_button',
                'title' => '{$MOD.LBL_CONVERT_TO_INVOICE}',
                'onclick' => 'this.form.action.value=\'converToInvoice\';',
                'name' => 'Convert to Invoice',
              ),
            ),
          ),
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '50',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '50',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_ACCOUNT_INFORMATION' => 
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
      'lbl_account_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'document_number_c',
            'label' => 'LBL_DOCUMENT_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'document_year_c',
            'label' => 'LBL_DOCUMENT_YEAR',
          ),
          1 => 
          array (
            'name' => 'data_doc_c',
            'label' => 'LBL_DATA_DOC',
          ),
        ),
        2 => 
        array (
          0 => '',
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'billing_account',
            'label' => 'LBL_BILLING_ACCOUNT',
          ),
          1 => 
          array (
            'name' => 'billing_contact',
            'label' => 'LBL_BILLING_CONTACT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'billing_address_street',
            'label' => 'LBL_BILLING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'billing',
            ),
          ),
          1 => 
          array (
            'name' => 'shipping_address_street',
            'label' => 'LBL_SHIPPING_ADDRESS',
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'shipping',
            ),
          ),
        ),
        5 => 
        array (
          0 => '',
          1 => '',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'total_amt',
            'label' => 'LBL_TOTAL_AMT',
          ),
          1 => 
          array (
            'name' => 'subtotal_amount',
            'label' => 'LBL_SUBTOTAL_AMOUNT',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'discount_amount',
            'label' => 'LBL_DISCOUNT_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'discount_percent_c',
            'label' => 'LBL_DISCOUNT_PERCENT',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'tax_amount',
            'label' => 'LBL_TAX_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'total_amount',
            'label' => 'LBL_GRAND_TOTAL',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'dsc_payment_c',
            'label' => 'LBL_DSC_PAYMENT',
          ),
          1 => '',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 
          array (
            'name' => 'opportunity',
            'label' => 'LBL_OPPORTUNITY',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'line_items',
            'label' => 'LBL_LINE_ITEMS',
            'hideLabel' => true,
          ),
        ),
      ),
    ),
  ),
);
?>
