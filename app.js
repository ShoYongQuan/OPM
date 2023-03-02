$(function() {
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 250) {
            $(".header").addClass("active");
			header.style.backgroundColor = 'rgba(211, 119, 102)';
        } else {
            //remove the background property so it comes transparent again (defined in your css)
			header.style.backgroundColor = 'transparent';
           $(".header").removeClass("active");
        }
    });
});