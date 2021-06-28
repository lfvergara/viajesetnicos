(function ($) {
  'use strict';

  $(function () {
    $(document).on('whatsappme:open', function (event, args, settings) {
      if (typeof settings.random_phones == 'object') {
        var phone = settings.random_phones[Math.floor(Math.random() * settings.random_phones.length)];
        args.link = args.link.replace(/phone=\d+/, 'phone=' + encodeURIComponent(phone));
      }
    });
  });
})(jQuery);
