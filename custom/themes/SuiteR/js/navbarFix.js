/**
 * Created by vincent on 22/02/2016.
 */
(function ($) {

    var mailchimpFix = function () {
        var temp = window.location.search;
        var temp2 = temp.search("SugarChimp");
        if (temp2 > 0) {
            var els = document.getElementsByTagName("a");
            for (var i = 0, l = els.length; i < l; i++) {
                var el = els[i];
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=health_status") {
                    el.innerHTML = "<span> Health Status </span>";
                }
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=setup") {
                    el.innerHTML = "<span> Setup </span>";
                }
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=field_mapping") {
                    el.innerHTML = "<span> Field Mapping </span>";
                }
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=campaigns") {
                    el.innerHTML = "<span> Campaigns </span>";
                }
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=license") {
                    el.innerHTML = "<span> License </span>";
                }
            }
        }
    };

    var mailchimpactivityFix = function () {
        var temp = window.location.search;
        var temp2 = temp.search("SugarChimpActivity");
        if (temp2 > 0) {
            var els = document.getElementsByTagName("a");
            for (var i = 0, l = els.length; i < l; i++) {
                var el = els[i];
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimpActivity&action=ListView") {
                    el.innerHTML = "<span> List View </span>";
                }
                if (el.href === "http://crm2.ingrossomaterialipulizia.it/index.php?module=SugarChimp&action=campaigns") {
                    el.innerHTML = "<span> Campaigns </span>";
                }
            }
        }
    };

    $(document).ready(function () {
        mailchimpFix();
        mailchimpactivityFix();
    });
})(jQuery);
