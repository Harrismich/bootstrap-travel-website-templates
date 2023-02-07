$( document ).ready(function() {
    var w = window.innerWidth;

    if(w > 767){
        $('#menu-jk').scrollToFixed();
    }else{
        $('#menu-jk').scrollToFixed();
    }



})


$( document ).ready(function() {

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay: true,
        dots: true,
        autoplayTimeout: 5000,
        navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })


});

        // popup window
$(document).ready(function() {
    $(".makereview").click(function() {
        var choice = $(this).closest('icons').find('.makereview').val();
       document.querySelector(".account-form").style.visibility= "visible";
    //   $.ajax({
    //    method: "POST",
    //    url: "ytcritics.php",
    //     success: function(result) {
    //       var classContent = $(result).find(".account-form");
    //       $("#displayArea").html(classContent);
    //     }
    //   });
    });
  });
  