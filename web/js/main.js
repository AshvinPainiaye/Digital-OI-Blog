
$(document).ready(function () {

  //Preloader
  $(window).load(function () {
    $('#page-loader').fadeOut(500);
  });
  //fin


  //affiche icone remonter
  $(window).scroll(
    function () {
      if ($(window).scrollTop() > 1) {
        // fixed
        $(".icon-return-top").css('visibility', 'visible');
      } else {
        // unfixed
        $(".icon-return-top").css('visibility', 'hidden');
      }
    }
  );
//fin


  $('a[href^="#returnTop"]').click(function () {
    var the_id = $(this).attr("href");

    $('html, body').animate({
      scrollTop: $(the_id).offset().top
    }, 'slow');
    return false;
  });


});
