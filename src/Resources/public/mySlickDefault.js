$(document).ready(function(){
  let settings = __setting__;
  settings.slide = '.slick-child';
  console.log(settings);
   $('.nh-slick').slick(
    settings
  );
});