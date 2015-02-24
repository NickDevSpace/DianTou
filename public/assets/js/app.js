(function($) {
  'use strict';

  $(function() {

      $('#login-btn').click(function(){
          window.location.href = "/auth/login";
      });
      $('#register-btn').click(function(){
          window.location.href = "/auth/register";
      });
  });
})(jQuery);


function dump_obj(myObject) {
    var s = "";
    for (var property in myObject) {
        s = s + "\n "+property +": " + myObject[property] ;
    }
    alert(s);
}