var customCallsEditScheduleDateUpdate = function () {
    if ($("select#status").val() == 'Planned') {
        $("#date_start").val($("#date_schedule_c").val());
        $("#date_start_date").val($("#date_schedule_c_date").val());
        $("#date_start_hours").val($("#date_schedule_c_hours").val());
        $("#date_start_minutes").val($("#date_schedule_c_minutes").val());
    }
};

(function ($) {
    var strStartDateFull = null;
    var strStartDate = null;
    var strStartHour = null;
    var strStartMinutes = null;

    /**
     *
     */
    var setupDates = function () {
        strStartDateFull = $("#date_start").val();//05/17/2016 09:45
        var time_separator = ':';
        var date_to_time_separator = ' ';
        var dateTimeParts = strStartDateFull.split(date_to_time_separator);
        if (dateTimeParts && dateTimeParts.length == 2) {
            strStartDate = dateTimeParts[0];
            var timeParts = dateTimeParts[1].split(time_separator);
            if (timeParts && timeParts.length == 2) {
                strStartHour = timeParts[0];
                strStartMinutes = timeParts[1];
            }
        }
        //console.log("F:" + strStartDateFull);
        //console.log("D:" + strStartDate);
        //console.log("H:" + strStartHour);
        //console.log("M:" + strStartMinutes);
    };

    var fixEmptyScheduledDate = function () {
        if ($("#date_schedule_c").val() == '') {
            $("#date_schedule_c").val(strStartDateFull);
            $("#date_schedule_c_date").val(strStartDate);
            $("#date_schedule_c_hours").val(strStartHour);
            $("#date_schedule_c_minutes").val('00');
        }
    };

    var cleanStartEndDateFields = function () {
        //clear date_start
        $("#date_start").val('');
        $("#date_start_date").val('');
        $("#date_start_hours").val('');
        $("#date_start_minutes").val('');

        //clear date_end
        //$("#date_end").val('');
        //$("#date_end_date").val('');
        //$("#date_end_hours").val('');
        //$("#date_end_minutes").val('');
    };

    var alignStartEndDateWithScheduledDate = function () {
        fixEmptyScheduledDate();

        $("#date_start").val($("#date_schedule_c").val());
        $("#date_start_date").val($("#date_schedule_c_date").val());
        $("#date_start_hours").val($("#date_schedule_c_hours").val());
        $("#date_start_minutes").val($("#date_schedule_c_minutes").val());

        console.log("ALIGN");

        //$("#date_end").val($("#date_schedule_c").val());
        //$("#date_end_date").val($("#date_schedule_c_date").val());
        //$("#date_end_hours").val($("#date_schedule_c_hours").val());
        //$("#date_end_minutes").val($("#date_schedule_c_minutes").val());
    };



    var closeAndCreateSetStatus = function () {
        var url = window.location.search;
        var isCloseAndCreate = url.search("&isDuplicate=true&") != -1;
        //console.log("T2: " + isCloseAndCreate);

        if (isCloseAndCreate) {
            var $form = $("form#EditView");
            if ($form.length == 1) {
                var $status = $("#status");
                var $result = $("#result_c");

                if ($status.length == 1 ) {
                    $status.val('Planned');
                }
                if ($result.length == 1 ) {
                    $result.val('');
                }

                cleanStartEndDateFields();
            }
        }
    };


    var statusChangeHandler = function()
    {
        if ($("select#status").val() == 'Planned') {
            alignStartEndDateWithScheduledDate();
            $("select#result_c").val('');
            $("select#negative_motivation_c").val('');
        } else {
            cleanStartEndDateFields();
        }
    };



    /*
     var setMinutesInModify = function(){
     var $minutes=$("#duration_minutes");
     if ($minutes.val()!= 0 || $minutes.val()!= 5 || $minutes.val()!= 15 || $minutes.val()!= 30 || $minutes.val()!= 45 )
     {
     $minutes.val(5);
     }
     };
     */

    var setScheduledDateChangeHandler = function () {
        $("input#date_schedule_c").on("change", statusChangeHandler);
        //$("input#date_schedule_c_date").on("change", statusChangeHandler);
        //$("input#date_schedule_c_hours").on("change", statusChangeHandler);
        //$("input#date_schedule_c_minutes").on("change", statusChangeHandler);
    };

    var setStartDateChangeHandler = function () {
        $("input#date_start").on("change", statusChangeHandler);
        $("input#date_start_date").on("change", statusChangeHandler);
        $("input#date_start_hours").on("change", statusChangeHandler);
        $("input#date_start_minutes").on("change", statusChangeHandler);
    };

    var setStatusChangeHandler = function () {
        statusChangeHandler();
        $("select#status").on("change", statusChangeHandler);
    };


    $(document).ready(function () {
        setupDates();
        //
        closeAndCreateSetStatus();
        //setMinutesInModify();
        //
        setStatusChangeHandler();
        setScheduledDateChangeHandler();
        setStartDateChangeHandler();
    });
})(jQuery);
