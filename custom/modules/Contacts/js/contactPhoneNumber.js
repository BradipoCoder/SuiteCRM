(function ($) {

    var checkPhoneNumber = function () {
        var $phone_work_contact = $('#phone_work');
        var new_number;
        if ($phone_work_contact[0].value == '' || $phone_work_contact[0].value == null) {
            var $account_phone_work = document.getElementsByTagName('td');
            var i;
            for (i = 0; i < $account_phone_work.length; i++) {
                if ($account_phone_work[i].getAttribute('field') == "phone_office") {
                    if ($account_phone_work[i].children[0].nodeName == "A") {
                        new_number = $account_phone_work[i].children[0].innerHTML;
                    }
                    else {
                        new_number = $account_phone_work[i].innerHTML;
                        new_number = new_number.substring(0, new_number.indexOf('<'));
                    }
                    $phone_work_contact[0].value = new_number;
                }
            }
        }
    };


    $(document).ready(function () {
        checkPhoneNumber();
    });
})(jQuery);
