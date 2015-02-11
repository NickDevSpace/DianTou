(function($) {
  'use strict';

  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
      $.AMUI.fullscreen.isFullscreen ? $fullText.text('关闭全屏') : $fullText.text('开启全屏');
    });



      $('#login-btn').click(function(){
          window.location.href = "/auth/login";
      });
      $('#register-btn').click(function(){
          window.location.href = "/auth/register";
      });
  });
})(jQuery);
