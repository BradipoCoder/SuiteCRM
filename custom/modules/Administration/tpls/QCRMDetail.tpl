{literal}
<style>
	#conf_sortableD1, #conf_sortableD2 { border-color: black;border-style: solid; border-width:1px; text-align:center ;margin:10px; width: 180px;list-style-type: none; margin: 10px; padding: 0 0 2.5em; float: left; margin-right: 10px; }
	#conf_sortableD1 li, #conf_sortableD2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 160px; text-align:left ;}
</style>
{/literal}
<h1 id="conftitle">{$TITLE}</h1><br>
<div id="confsynced">
	<span style="color:red;">{$IS_SYNCED}</span>
</div>
<div id="confbuttons" {$HIDEFIELDS}>
	<input title='{$APP_STRINGS.LBL_SAVE_BUTTON_TITLE}' accessKey='M' class='button' onclick="return SaveFields(this,'{$module}','detail');" type='button' name='button' value='{$APP_STRINGS.LBL_SAVE_BUTTON_TITLE}'></input>
	<input title='{$APP_STRINGS.LBL_CANCEL_BUTTON_TITLE}' accessKey='X' class='button' onclick="location.href='index.php?module=Administration&action=index';" type='button' name='button' value='{$APP_STRINGS.LBL_CANCEL_BUTTON_TITLE}'></input>
</div>
<div id="confmodule" {$HIDEFIELDS}>
	<div style="float:left;width:200px;">
		<div id="selected_div">
			<h3></h3>
			<input type="text" id="search_field_sortable1" name="search" placeholder="{$app_strings.LBL_SEARCH}" style="margin-left:10px;width:170px">
			<ul id="conf_sortableD1" class="connectedSortable">{$AVAILABLE}
{foreach name=tabAvailable from=$tabAvailable key=tabColkey item=tabAvailableData}
					<li id= '{$tabAvailableData.field}' class='ui-state-highlight'>{$tabAvailableData.label}</li>
{/foreach}
			</ul>
		</div>
	</div>
	<div style="float:left;width:200px;">
		<div id="selected_div">
			<h3></h3>
			<input type="text" id="search_field_sortable2" name="search" placeholder="{$app_strings.LBL_SEARCH}" style="margin-left:10px;width:170px">
			<ul id="conf_sortableD2" class="connectedSortable">{$HIDDEN}
{foreach name=tabCom from=$tabHidden key=tabColkey item=tabHiddenData}
					<li id= '{$tabHiddenData.field}' class='ui-state-default'>{$tabHiddenData.label}</li>
{/foreach}
			</ul>
		</div>
	</div>
</div>
{literal}
<script>
$(function() {
	$( "#conf_sortableD1, #conf_sortableD2" ).sortable({
		connectWith: ".connectedSortable"
	}).disableSelection();
    $('#search_field_sortable1').on('keyup', function(){
        var str = $(this).val();
        var tt= $('#conf_sortableD1 li');
        $(tt).each(function(indx, element){
            var start_str = $(element).text().toLowerCase();

            if(start_str.indexOf(str.toLowerCase())!==-1){
                $(element).show();
            }
            else {
                $(element).hide();
            }
        })
    });
    $('#search_field_sortable2').on('keyup', function(){
        var str = $(this).val();
        var tt= $('#conf_sortableD2 li');
        $(tt).each(function(indx, element){
            var start_str = $(element).text().toLowerCase();

            if(start_str.indexOf(str.toLowerCase())!==-1){
                $(element).show();
            }
            else {
                $(element).hide();
            }
        })
    });
});
	//$('#conf_sortableD1').sortable().sortable("refresh");
	//$('#conf_sortableD2').sortable().sortable("refresh");
//console.log('loaded script')
</script>
{/literal}
