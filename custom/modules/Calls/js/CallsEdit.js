(function ($) {

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

                //clear date_start
                $("#date_start").val('');
                $("#date_start_date").val('');
                $("#date_start_hours").val('');
                $("#date_start_minutes").val('');

                //clear date_end
                $("#date_end").val('');
                $("#date_end_date").val('');
                $("#date_end_hours").val('');
                $("#date_end_minutes").val('');
            }
        }
    };

    /*
    var statusChangeHandler = function()
    {
        if($("#status").val()=='Planned') {
            //
            alignStartDateWithScheduledDate();
            //
            $("#date_end").val("");
            $("#date_end_date").val("");
            $("#date_end_hours").val("");
            $("#date_end_minutes").val("");
            //
            $("#result_c").val('');
            $("#negative_motivation_c").val('');
        } else {
            console.log("STATUS: HELD");
        }
    };*/

    /*
    var setStatusChangeHandler = function()
    {
        $("#status").on("change", statusChangeHandler);
    };*/

    /*
    var setScheduledDateChangeHandler = function()
    {
        $("#date_schedule_c").on("change", statusChangeHandler);
        $("#date_schedule_c_date").on("change", statusChangeHandler);
        $("#date_schedule_c_hours").on("change", statusChangeHandler);
        $("#date_schedule_c_minutes").on("change", statusChangeHandler);
    };*/

    /*
    var alignStartDateWithScheduledDate = function() {
        $("#date_start").val($("#date_schedule_c").val());
        $("#date_start_date").val($("#date_schedule_c_date").val());
        $("#date_start_hours").val($("#date_schedule_c_hours").val());
        $("#date_start_minutes").val($("#date_schedule_c_minutes").val());
    };
    */

    /*
    var setMinutesInModify = function(){
        var $minutes=$("#duration_minutes");
        if ($minutes.val()!= 0 || $minutes.val()!= 5 || $minutes.val()!= 15 || $minutes.val()!= 30 || $minutes.val()!= 45 )
        {
            $minutes.val(5);
        }
    };
    */

    $(document).ready(function () {
        closeAndCreateSetStatus();
        //setMinutesInModify();
        //
        //statusChangeHandler();
        //setStatusChangeHandler();
        //setScheduledDateChangeHandler();
        //
    });
})(jQuery);
