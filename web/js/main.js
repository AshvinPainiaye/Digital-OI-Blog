$(window).scroll(
     function () {
         if ($(window).scrollTop() > $("header").offset().top) {
                 $('nav').addClass("navBarFixed");
         } else {
             $('nav').removeClass("navBarFixed");
         }
     }
);
