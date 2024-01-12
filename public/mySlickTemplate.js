$(document).ready(function(){
  let settings = __setting__;
  settings.slide = '.slick-child';
  console.log(settings);
   $(__class__).slick(
    settings
  );
});