window.$ = $;
window.jQuery = jQuery;

import "./node_modules/bootstrap/js/src/alert";
import "./node_modules/bootstrap/js/src/button";
import "./node_modules/bootstrap/js/src/collapse";
import "./node_modules/bootstrap/js/src/util";

$(document).ready(function() {
    
    /* toggle menu buton class */
    $(".hamburger").click(function () {
        $(".hamburger").toggleClass("is-active");
        $("body").toggleClass("body-fixed");
    });

    //navbar change color on scroll 
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".navbar");
            $nav.toggleClass('scrolled', $(this).scrollTop() > 0);
        });
    });
});