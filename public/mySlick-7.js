$(document).ready(function(){
  let settings = {"mobileFirst":true,"adaptiveHeight":true,"autoplay":true,"arrows":true,"centerMode":true,"centerPadding":"0","dots":true,"draggable":false,"infinite":false,"initialSlide":"0","lazyLoad":"'ondemand'","pauseOnFocus":false,"pauseOnHover":false,"pauseOnDotsHover":false,"slidesToShow":1,"slidesToScroll":1,"swipe":false,"swipeToSlide":false,"touchMove":false,"variableWidth":false,"zIndex":1000,"autoplaySpeed":6000,"responsive":[[],{"breakpoint":576},{"breakpoint":768},{"breakpoint":992},{"breakpoint":1200},{"breakpoint":1400}]};
  settings.slide = '.slick-child';
  console.log(settings);
   $('.nh-slick').slick(
    settings
  );
});