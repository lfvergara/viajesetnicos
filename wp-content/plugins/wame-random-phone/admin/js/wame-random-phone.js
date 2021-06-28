(function ($) {
  'use strict';

  $(function () {
    var count = $('input[id^=whatsappme_phone]').length;

    if (typeof (intlTelInput) === 'function') {
      var country_request = JSON.parse(localStorage.whatsappme_country_code || '{}');
      var country_code = (country_request.code && country_request.date == new Date().toDateString()) ? country_request.code : false;
      var iti_settings = {
        // hiddenInput: $phone.data('name') || 'whatsappme[telephone]',
        initialCountry: 'auto',
        preferredCountries: [country_code || ''],
        geoIpLookup: function (callback) {
          if (country_code) {
            callback(country_code);
          } else {
            $.getJSON('https://ipinfo.io').always(function (resp) {
              var countryCode = (resp && resp.country) ? resp.country : '';
              localStorage.whatsappme_country_code = JSON.stringify({ code: countryCode, date: new Date().toDateString() });
              callback(countryCode);
            });
          }
        },
        utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/' + intl_tel_input_version + '/js/utils.js'
      };

      // Enable intlTelInput
      for (var i = 0; i < count; i++) {
        var input = document.getElementById('whatsappme_phone_' + i);
        var iti = intlTelInput(input, $.extend({}, iti_settings, { hiddenInput: $(input).data('name') }));
        iti.hiddenInput.value = input.value;
        input.autocomplete = 'off_' + Math.random().toString(36).substring(2, 15);
      }

      // Enable input events delegated to <td> container,
      // also add events to Wame chat metabox
      $('#wame-random-phome-add').parent('td').add('.whatsappme-metabox')
        .on('input', 'input[type=text]', function () {
          var $this = $(this);
          var iti = intlTelInputGlobals.getInstance(this);

          $this.css('color', $this.val().trim() && !iti.isValidNumber() ? '#ca4a1f' : '');
          iti.hiddenInput.value = iti.getNumber();
        })
        .on('blur', 'input[type=text]', function () {
          var iti = intlTelInputGlobals.getInstance(this);
          iti.setNumber(iti.getNumber());
        });
    }

    // Add phone number
    $('#wame-random-phome-add').click(function (e) {
      e.preventDefault();
      var int_tel = typeof (intlTelInput) === 'function';
      var name = $('#whatsappme_phone_0').data('name') || $('#whatsappme_phone_0').attr('name');
      name = name.replace('0', count);

      $('<br><input id="whatsappme_phone_' + count + '" ' + (int_tel ? 'data-' : '') + 'name="' + name + '" value="" type="text">').insertBefore(this);

      var input = document.getElementById('whatsappme_phone_' + count);
      if (int_tel) {
        intlTelInput(input, $.extend({}, iti_settings, { hiddenInput: name }));
      }
      input.autocomplete = 'off_' + Math.random().toString(36).substring(2, 15);
      input.focus();

      count++;
    });

  });
})(jQuery);
