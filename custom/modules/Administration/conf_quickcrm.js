function QShowStatus(txt) {
    $('#StatusDiv').html('<em style="color:red;font-size:16px;">' + txt + '</em>');
}
function QHideStatus() {
    $('#StatusDiv').html('');
}

function SaveFields(button, conf_module, conf_type) {
    function onSuccess(res) {
        QShowStatus(SUGAR.language.get('app_strings', 'LBL_SAVED'));
        setTimeout(function () {
            QHideStatus();
        }, 4000);

        $('#conf_sortableD2 li').each(function (indx, element) {
            $(element).addClass('ui-state-default');
            $(element).removeClass('ui-state-highlight');
        })
        $('#conf_sortableD1 li').each(function (indx, element) {
            $(element).removeClass('ui-state-default');
            $(element).addClass('ui-state-highlight');
        })
    }

    var data = {
        conf_module: conf_module,
        conf_type: conf_type,
        input_type: 'JSON',
        response_type: 'html',
        sel_fields: $('#conf_sortableD1').sortable('toArray').toString()
    };
    if (conf_type == 'list') data.colorfield = $('#colorfield').val();
    else if (conf_type == 'fields') data.syncCheckbox = $('#syncCheckbox').is(':checked') ? '1' : '0';

    QShowStatus(SUGAR.language.get('app_strings', 'LBL_SAVING'));

    $.ajax({
        url: 'index.php?module=Administration&action=configquickcrm_save&to_pdf=1',
        dataType: 'html',
        data: data,
        type: 'post',
        cache: false,
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            QShowStatus('An error occured while saving');
        },
        success: onSuccess // callback
    });
}

function conf_get(module, type) {
    function onSuccess(res) {
        QHideStatus();
        $('#confpage').html(res);
    }

    QShowStatus(SUGAR.language.get('app_strings', 'LBL_LOADING'));

    $.ajax(
        {
            url: 'index.php?module=Administration&action=quickcrm_' + type + '&conf_module=' + module + '&to_pdf=true',
            dataType: 'html',
            type: 'get',
            cache: false,
            error: function (xmlHttpRequest, textStatus, errorThrown) {
            },
            success: onSuccess // callback
        }
    );
}

function conf_search(module) {
    conf_get(module, 'search');
}

function conf_list(module) {
    conf_get(module, 'list');
}

function conf_fields(module) {
    conf_get(module, 'fields');
}

function conf_detail(module) {
    conf_get(module, 'detail');
}

function conf_subpanels(module) {
    conf_get(module, 'subpanels');
}

$(function () {
    // workaround for Chrome
    if ($('.sidebar').is(':visible'))
        $('#buttontoggle').click();
});
