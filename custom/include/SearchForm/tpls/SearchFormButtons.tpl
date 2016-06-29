{if $displayType != 'popupView'}
    <div class="search-form-buttons">

        {if $SAVED_SEARCHES_OPTIONS}
            <div class="form-group">
                <label for="saved_search_select">{$APP.LBL_SAVED_SEARCH_SHORTCUT}</label>
                {$SAVED_SEARCHES_OPTIONS}
            </div>
        {/if}

        <input tabindex='2' title='{$APP.LBL_CLEAR_BUTTON_TITLE}'
               onclick='SUGAR.searchForm.clear_form(this.form); document.getElementById("saved_search_select").options[0].selected=true; return false;'
               class='button clear btn btn-primary' type='button' name='clear' id='search_form_clear_advanced'
               value='{$APP.LBL_CLEAR_BUTTON_LABEL}'/>

        <input tabindex='2' title='{$APP.LBL_SEARCH_BUTTON_TITLE}' onclick='SUGAR.savedViews.setChooser()'
               class='button search btn btn-primary' type='submit' name='button' value='{$APP.LBL_SEARCH_BUTTON_LABEL}'
               id='search_form_submit_advanced'/>

        {if $DOCUMENTS_MODULE}
            <input title="{$APP.LBL_BROWSE_DOCUMENTS_BUTTON_TITLE}" type="button" class="button btn btn-primary"
                   value="{$APP.LBL_BROWSE_DOCUMENTS_BUTTON_LABEL}"
                   onclick='open_popup("Documents", 600, 400, "&caller=Documents", true, false, "");'/>
        {/if}

        <span id='go_btn_span' style='display:none'>
            <input tabindex='2' title='go_select' id='go_select'
                   onclick='SUGAR.searchForm.clear_form(this.form);' class='button' type='button'
                   name='go_select' value=' {$APP.LBL_GO_BUTTON_LABEL} '/>
        </span>

    </div>
{/if}