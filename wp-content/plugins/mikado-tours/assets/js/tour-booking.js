(function($) {
	'use strict';

	$(document).ready(function() {
		fieldsHelper().datepicker.initDatepicker();
		tourBooking().init();
	});

	/**
	 * Handles form submission and AJAX call
	 * @type {{init, form}}
	 */
	function tourBooking() {
		var $form = $('#mkdf-tour-booking-form');

		var handleFormSubmit = function() {
			if(!$form.length) {
				return false;
			}

			$form.on('submit', function(e) {
				e.preventDefault();
				e.stopPropagation();

				var $submitButton = $form.find('input[type="submit"]'),
					loadingLabel = $submitButton.data('loading-label'),
					originalText = $submitButton.val(),
					redirectingText = $submitButton.data('redirecting-label');

				if(!formValidation.validate()) {
					return false;
				}

				$submitButton.val(loadingLabel);

				var data = {
					action: 'check_tour_booking'
				};

				data.fields = $form.serialize();

				$.ajax({
					url: mkdfTourData.ajaxUrl,
					dataType: 'json',
					type: 'POST',
					data: data,
					success: function(response) {
						if(!response.status) {
							formValidation.updateValidationTemplate(response.messages);
							$submitButton.val(originalText);
						} else {
							$submitButton.val(redirectingText)
							window.location = response.redirectURI;
						}
					}
				});
			});
		};

		var disableBookButton = function() {
			$form.find('input[type="submit"]').attr('disabled', '');
		};

		var enableBookButton = function() {
			$form.find('input[type="submit"]').removeAttr('disabled');
		};

		var checkAvailability = function() {
			var $checkAvailabilityButton = $form.find('.mkdf-tours-check-availability');

			if($checkAvailabilityButton.length) {
				$checkAvailabilityButton.on('click', function(e) {
					e.preventDefault();
					e.stopPropagation();

					disableBookButton();

					if(!formValidation.validateAvailability()) {
						return false;
					}

					var checkingText = $checkAvailabilityButton.data('loading-label');
					var originalText = $checkAvailabilityButton.text();

					var data = {
						action: 'mkdf_tours_check_availability'
					}

					data.fields = $form.serialize();

					$checkAvailabilityButton.text(checkingText);

					$.ajax({
						url: mkdfTourData.ajaxUrl,
						dataType: 'json',
						type: 'POST',
						data: data,
						success: function(response) {
							var alertType = response.status ? 'success' : 'danger';
							formValidation.updateValidationTemplate(response.messages, alertType);

							if(response.status) {
								enableBookButton();
							} else {
								disableBookButton();
							}

							$checkAvailabilityButton.text(originalText);
						}
					});
				});
			}
		};

		return {
			init: function() {
				handleFormSubmit();
				checkAvailability();
			},
			form: $form
		};
	};

	/**
	 * Handles form validation and validation template updating
	 * @type {{validate}}
	 */
	var formValidation = function() {
		var $form = tourBooking.form || $('#mkdf-tour-booking-form'),
			validationMessages = [],
			$validationTemplateHolder = $('#booking-validation-messages-holder'),
			$validationMessagesHolder = $('#booking-validation-messages'),
			validationTemplate;

		if($validationMessagesHolder.length) {
			validationTemplate = _.template(
				$validationMessagesHolder.html()
			);
		}

		/**
		 * Updates form validation template based on validation messages variable
		 */
		var updateValidationTemplate = function(messages, type) {
			$validationTemplateHolder.empty();

			var type = type || 'danger';

			$validationTemplateHolder.append(
				validationTemplate({
					messages: messages,
					type: type
				})
			);
		};

		/**
		 * Validates form and returns true if form is valid
		 * Calls updateValidationTemplate function
		 * @returns {boolean}
		 */
		var validate = function() {
			var $nameField = $form.find('[name="user_name"]'),
				$emailField = $form.find('[name="user_email"]'),
				$dateField = $form.find('[name="date"]'),
				$numberOfTicketsField = $form.find('[name="number_of_tickets"]'),
				labels = mkdfTourData.labels;

			validationMessages = [];

			if(typeof $nameField === 'undefined' || $nameField.val() === '') {
				validationMessages.push(labels.name);
			}

			var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

			if(typeof $emailField === 'undefined' || !re.test($emailField.val())) {
				validationMessages.push(labels.email);
			}

			updateValidationTemplate(validationMessages);

			return validationMessages.length === 0;
		};

		var validateAvailability = function() {
			var $dateField = $form.find('[name="date"]'),
				$numberOfTicketsField = $form.find('[name="number_of_tickets"]'),
				labels = mkdfTourData.labels;

			validationMessages = [];

			updateValidationTemplate(validationMessages);

			return validationMessages.length === 0;
		};

		return {
			validate: validate,
			validateAvailability: validateAvailability,
			updateValidationTemplate: updateValidationTemplate
		}
	}();

	/**
	 * Wrapper around function that work with various field types
	 * @type {{datepicker, timePicker}}
	 */
	function fieldsHelper() {

		/**
		 * Updates time template based on given times variable
		 * @type {{updateTemplate}}
		 */
		var timePicker = function() {
			var $timeBookingTempalte = $('#booking-time-template');
			var $templateHolder = $('#mkdf-tour-booking-time-picker');

			if($timeBookingTempalte.length) {
				var template = _.template(
					$timeBookingTempalte.html()
				);
			}

			return {
				updateTemplate: function(times) {
					if($templateHolder.length) {
						$templateHolder.empty();

						$templateHolder.append(
							template({
								times: times
							})
						);
					}
				}
			};
		}();

		/**
		 * Initializes datepicker functionality
		 * @type {{initDatepicker}}
		 */
		var datepicker = function() {
			var initDatepicker = function() {
				var $datepicker = $('.mkdf-tour-period-picker');
				var dateFormat = "dd-mm-yy";

				if($datepicker.length) {
					$datepicker.each(function() {
						var $thisDatepicker = $(this);

						$thisDatepicker.datepicker({
							dateFormat: dateFormat,
							prevText: '<span class="lnr lnr-chevron-left"></span>',
							nextText: '<span class="lnr lnr-chevron-right"></span>',
							beforeShowDay: function(date) {
								var availableDates = mkdfTourData.data.availableDays;
								var formattedDate = $.datepicker.formatDate('dd-mm-yy', date);
								var dateAvailable = $.inArray(formattedDate, availableDates) >= 0;

								return [dateAvailable, ''];
							},
							onSelect: function(date) {
								date = $(this).datepicker('getDate');
								var formattedDate = $.datepicker.formatDate('dd-mm-yy', date);

								var tourPeriods = mkdfTourData.data.datesWithTimes,
									periodTimes;

								$.each(tourPeriods, function(key, value) {
									if(formattedDate >= value.startDate && formattedDate <= value.endDate) {
										periodTimes = value.times;

										return false;
									}
								});

								timePicker.updateTemplate(periodTimes);
							}
						});
					});
				}
			};

			return {
				initDatepicker: initDatepicker
			};
		}();

		return {
			datepicker: datepicker,
			timePicker: timePicker
		};
	};
})(jQuery);
