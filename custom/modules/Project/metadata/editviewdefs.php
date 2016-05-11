<?php
$viewdefs ['Project'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
      'form' => 
      array (
        'hidden' => '<input type="hidden" name="is_template" value="{$is_template}" />',
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 
          array (
            'customCode' => '{if !empty($smarty.request.return_action) && $smarty.request.return_action == "ProjectTemplatesDetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesDetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif !empty($smarty.request.return_action) && $smarty.request.return_action == "DetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'DetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif $is_template}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesListView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {/if}',
          ),
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_PROJECT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_project_information' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'priority',
        ),
        1 => 
        array (
          0 => 'estimated_start_date',
          1 => 'assigned_user_name',
        ),
        2 => 
        array (
          0 => 'estimated_end_date',
          1 => 
          array (
            'name' => 'tipo_c',
            'studio' => 'visible',
            'label' => 'LBL_TIPO',
          ),
        ),
        3 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'codice_commessa_metodo_c',
            'label' => 'LBL_CODICE_COMMESSA_METODO',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
          1 => 
          array (
            'name' => 'area_dinteresse_mekit_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA_DINTERESSE_MEKIT',
          ),
        ),
        5 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'area_dinteresse_imp_c',
            'studio' => 'visible',
            'label' => 'LBL_AREA_DINTERESSE_IMP',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'analisi_realta_c',
            'studio' => 'visible',
            'label' => 'LBL_ANALISI_REALTA',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'aggiornamenti_c',
            'studio' => 'visible',
            'label' => 'LBL_AGGIORNAMENTI',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fineeffettiva_c',
            'label' => 'LBL_FINEEFFETTIVA',
          ),
          1 => 
          array (
            'name' => 'data_chiusura_effettiva_c',
            'label' => 'LBL_DATA_CHIUSURA_EFFETTIVA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'conclusioni_c',
            'studio' => 'visible',
            'label' => 'LBL_CONCLUSIONI',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'esito_progetto_c',
            'studio' => 'visible',
            'label' => 'LBL_ESITO_PROGETTO',
          ),
          1 => 
          array (
            'name' => 'raggiungimentopercentuale_c',
            'label' => 'LBL_RAGGIUNGIMENTOPERCENTUALE',
          ),
        ),
      ),
    ),
  ),
);
?>
