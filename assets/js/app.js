
$(document).ready(function(){
  $("#signup").click(function () {
    $("#first").fadeOut("slow", function () {
      $("#second").fadeIn("slow");
    });
  });

  $("#signin").click(function () {
    $("#second").fadeOut("slow", function () {
      $("#first").fadeIn("slow");
    });
  });

  $('#basketac').on('click', function() {
    $('.basket').toggle();
  });




$(window).on('load',function(){
  $('.preloader').addClass('complete')
});

$(window).on('scroll',function(){
  var scroll = $(window).scrollTop();
  console.log(scroll);
  if(scroll >=50){
    $(".sticky").addClass("stickyadd");
  }else{
    $(".sticky").removeClass("stickyadd");
  }
});

// progress bars

var waypoint = new Waypoint({
  element: document.getElementById('experience'),
  handler: function() {

    var p = document.querySelectorAll('.progress-bar');
    p[0].setAttribute("style", "width:92.36%;transition:1s all;");
    p[1].setAttribute("style", "width:5%;transition:1.5s all;");
    p[2].setAttribute("style", "width:7%;transition:1.7s all;");
    p[3].setAttribute("style", "width:119%;transition:2s all;");
    p[4].setAttribute("style", "width:63.18%;transition:2.3s all;");
    p[5].setAttribute("style", "width:48%;transition:2.5s all;");
  },
   offset: '90%'
});

var $child = $('.way-fade-up').children();
$child.each(function(){
  var self= $(this);
  $(this).waypoint(function(){
    self.addClass('animated fadeInUp');
  },{offset: '90%'});
});

var $child = $('.way-fade-left').children();
$child.each(function(){
  var self= $(this);
  $(this).waypoint(function(){
    self.addClass('animated fadeInLeft');
  },{offset: '90%'});
});

var $child = $('.way-fade-right').children();
$child.each(function(){
  var self= $(this);
  $(this).waypoint(function(){
    self.addClass('animated fadeInRight');
  },{offset: '90%'});
});

$('.owl-carousel').owlCarousel({
    loop:true,
    nav:false,
    autoplay:true,
    autoplayTimeout:4000,
    items:1,
    animateIn : "fadeInRight"

});

$('a').smoothScroll({
  speed:500,
});

});
