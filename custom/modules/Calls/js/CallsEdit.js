(function ($) {

    var closeAndCreateSetStatus = function () {
        var temp = window.location.search;
        var temp2 = temp.search("isDuplicate=true");
        if (temp2 > 0) {
            var $form = $("form#EditView");
            if ($form.length == 1) {
                var $status = $("#status");
                var $result = $("#result_c");

                if ($status.length == 1 ) { //&& $status.val()=='Planned'
                    $status.val('Planned');
                    $result.val('');
                    //alert("Result: " + $result.val());
                }
            }
        }
    };


    var statusChangeHandler = function()
    {
        if($("#status").val()=='Planned') {
            console.log("STATUS: PLANNED");
            //
            $("#date_start").val("");
            $("#date_start_date").val("");
            $("#date_start_hours").val("");
            $("#date_start_minutes").val("");
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
    };

    var setStatusChangeHandler = function()
    {
        statusChangeHandler();
        $("#status").on("change", statusChangeHandler);
    };

    var setMinutesInModify = function(){
        var $minutes=$("#duration_minutes");
        if ($minutes.val()!= 0 || $minutes.val()!= 5 || $minutes.val()!= 15 || $minutes.val()!= 30 || $minutes.val()!= 45 )
        {
            $minutes.val(5);
        }
    };


    $(document).ready(function () {
        closeAndCreateSetStatus();
        setMinutesInModify();
        setStatusChangeHandler();
    });
})(jQuery);
