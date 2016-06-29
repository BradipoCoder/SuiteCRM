{if $DISPLAY_SAVED_SEARCH}
    <div class="saved-searches">
        <input type='hidden' name='saved_search_action' value=''>
        <input type='hidden' name='search_module' value=''>
        <input type='hidden' id='showSSDIV' name='showSSDIV' value='{$SHOWSSDIV}'>

        <div class="form-group">
            <label for="saved_search_name">{sugar_translate label='LBL_SAVE_SEARCH_AS' module='SavedSearch'}</label>
            <input type='text' name='saved_search_name' class="">
        </div>
        <input title='{$APP.LBL_SAVE_BUTTON_LABEL}' value='{$APP.LBL_SAVE_BUTTON_LABEL}'
               class='button ss-save btn btn-primary' type='button' name='saved_search_submit'
               onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("save");'>


        {sugar_translate label='LBL_MODIFY_CURRENT_SEARCH' module='SavedSearch'}: <span id='curr_search_name'></span>

        <input class='button ss-update btn btn-primary'
               onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("update")'
               value='{$APP.LBL_UPDATE}' title='{$APP.LBL_UPDATE}' name='ss_update' id='ss_update' type='button'>
        <input class='button ss-delete btn btn-primary'
               onclick='return SUGAR.savedViews.saved_search_action("delete", "{sugar_translate label='LBL_DELETE_CONFIRM' module='SavedSearch'}")'
               value='{$APP.LBL_DELETE}' title='{$APP.LBL_DELETE}' name='ss_delete' id='ss_delete' type='button'>
        <br>


        <a class='tabFormAdvLink' href='javascript:toggleInlineSearch()'>
            {capture assign="alt_show_hide"}{sugar_translate label='LBL_ALT_SHOW_OPTIONS'}{/capture}
            {sugar_getimage alt=$alt_show_hide name="advanced_search" ext=".gif" other_attributes='border="0" id="up_down_img" '}
            {$APP.LNK_SAVED_VIEWS}
        </a>

        <div style='{$DISPLAYSS}' id='inlineSavedSearch'>
            {$SAVED_SEARCH}
        </div>

    </div>
{/if}

