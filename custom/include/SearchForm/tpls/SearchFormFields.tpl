<div class="form-fields">
    {{assign var='accesskeycount' value=0}}
    {{assign var='ACCKEY' value=''}}

    {*<pre>*}
    {*{{$formData|print_r}}*}
    {*</pre>*}

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                       href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {sugar_translate label='LBL_BASIC_SEARCH' module=''}
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    {{foreach name=colIteration from=$formData key=col item=colData}}
                    {{if ($colData.is_basic)}}
                    <div class="form-group">
                        {{math assign="accesskeycount" equation="$accesskeycount + 1"}}
                        {{if $accesskeycount==1}} {{assign var='ACCKEY' value=$APP.LBL_FIRST_INPUT_SEARCH_KEY}} {{else}} {{assign var='ACCKEY' value=''}} {{/if}}

                        {counter assign=index}

                        {{if isset($colData.field.label)}}
                        <label for='{{$colData.field.name}}'>{sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}</label>
                        {{elseif isset($fields[$colData.field.name])}}
                        <label for='{{$fields[$colData.field.name].name}}'>{sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}</label>
                        {{/if}}


                        {{if $fields[$colData.field.name]}}
                        {{sugar_field parentFieldArray='fields' accesskey=$ACCKEY vardef=$fields[$colData.field.name] displayType=$displayType displayParams=$colData.field.displayParams typeOverride=$colData.field.type formName=$form_name}}
                        {{/if}}
                    </div>
                    {{/if}}
                    {{/foreach}}
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {sugar_translate label='LBL_ADVANCED_SEARCH' module=''}
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    {{foreach name=colIteration from=$formData key=col item=colData}}
                    {{if (!$colData.is_basic)}}
                    <div class="form-group">
                        {{math assign="accesskeycount" equation="$accesskeycount + 1"}}
                        {{if $accesskeycount==1}} {{assign var='ACCKEY' value=$APP.LBL_FIRST_INPUT_SEARCH_KEY}} {{else}} {{assign var='ACCKEY' value=''}} {{/if}}

                        {counter assign=index}

                        {{if isset($colData.field.label)}}
                        <label for='{{$colData.field.name}}'>{sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}</label>
                        {{elseif isset($fields[$colData.field.name])}}
                        <label for='{{$fields[$colData.field.name].name}}'>{sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}</label>
                        {{/if}}


                        {{if $fields[$colData.field.name]}}
                        {{sugar_field parentFieldArray='fields' accesskey=$ACCKEY vardef=$fields[$colData.field.name] displayType=$displayType displayParams=$colData.field.displayParams typeOverride=$colData.field.type formName=$form_name}}
                        {{/if}}
                    </div>
                    {{/if}}
                    {{/foreach}}
                </div>
            </div>
        </div>
    </div>
</div>