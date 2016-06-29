/**
 * Created by jack on 28/06/16.
 */
(function ($) {

    /*
     * Fix Search form - stuff I cannot do with smarty
     * */
    $(document).ready(function () {
            $("input, select", "form.search_form .form-group").addClass("form-control");

            SUGAR.savedViews.handleForm();
        }
    );

})(jQuery);