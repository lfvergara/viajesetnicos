<div class="mkdf-grid-row">
	<div class="mkdf-grid-col-12">
		<form id="mkdf-tour-booking-form" method="post">
			<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>

			<div class="mkdf-tour-booking-field-holder">
				<input type="text" placeholder="<?php esc_attr_e('Name *', 'mkdf-tours'); ?>" value="<?php echo esc_attr(mkdf_tours_get_current_user_name()); ?>" name="user_name">

			<span class="mkdf-tour-booking-field-icon">
				<i class="lnr lnr-pencil"></i>
			</span>
			</div>

			<div class="mkdf-tour-booking-field-holder">
				<input type="text" value="<?php echo esc_attr(mkdf_tours_get_current_user_email()); ?>" placeholder="<?php esc_attr_e('Email *', 'mkdf-tours'); ?>" name="user_email">

			<span class="mkdf-tour-booking-field-icon">
				<i class="lnr lnr-envelope"></i>
			</span>
			</div>

			<div class="mkdf-tour-booking-field-holder">
				<input type="text" placeholder="<?php esc_attr_e('Phone', 'mkdf-tours'); ?>" name="user_phone">

			<span class="mkdf-tour-booking-field-icon">
				<i class="lnr lnr-phone-handset"></i>
			</span>
			</div>

			<div class="mkdf-tour-booking-field-holder">
				<input type="text" class="mkdf-tour-period-picker" placeholder="<?php echo esc_attr('MM dd, yy *'); ?>" name="date">

			<span class="mkdf-tour-booking-field-icon">
				<i class="lnr lnr-calendar-full"></i>
			</span>
			</div>

			<div id="mkdf-tour-booking-time-picker"></div>

			<div class="mkdf-tour-booking-field-holder">
				<input type="number" name="number_of_tickets" placeholder="<?php esc_attr_e('Number of tickets *', 'mkdf-tours'); ?>">

			<span class="mkdf-tour-booking-field-icon">
				<i class="lnr lnr-user"></i>
			</span>
			</div>

			<div class="mkdf-tour-booking-field-holder">
				<textarea name="message" placeholder="<?php esc_attr_e('Message', 'mkdf-tours'); ?>"></textarea>
			</div>

			<input type="hidden" name="tour_id" value="<?php echo esc_attr(get_the_ID()); ?>">

			<div id="booking-validation-messages-holder"></div>

			<script type="text/html" id="booking-validation-messages">
				<% if(typeof messages !== 'undefined' && messages.length) { %>
				<ul class="mkdf-tour-booking-validation-list mkdf-tour-message-<%= type %>">
					<% _.each(messages, function(message) { %>
					<li><%= message %></li>
					<% }) %>
				</ul>
				<% } %>
			</script>

			<script type="text/html" id="booking-time-template">
				<% if(typeof times !== 'undefined' && times.length) { %>
				<div class="mkdf-tour-booking-field-holder">
					<select name="time">
						<% _.each(times, function(time) { %>
						<option value="<%= time.time %>"><%= time.time %></option>
						<% }) %>
					</select>

					<span class="mkdf-tour-booking-field-icon">
						<i class="lnr lnr-clock"></i>
					</span>
				</div>
				<% } %>
			</script>

			<?php if(mkdf_tours_theme_installed()) : ?>
				<?php echo roam_mikado_execute_shortcode('mkdf_button', array(
					'html_type' => 'input',
					'text' => esc_html__('Book now', 'mkdf-tours'),
					'custom_attrs' => array(
						'data-loading-label' => esc_attr__('Working...', 'mkdf-tours'),
						'data-redirecting-label' => esc_attr__('Redirecting...', 'mkdf-tours'),
						'disabled' => 'disabled'
					)
				)) ?>
			<?php else : ?>
				<input disabled data-redirecting-label="<?php esc_attr_e('Redirecting...', 'mkdf-tours') ?>" data-loading-label="<?php esc_attr_e('Working...', 'mkdf-tours'); ?>" type="submit" value="<?php echo esc_attr('Book now', 'mkdf-tours'); ?>">
			<?php endif; ?>
		</form>
	</div>
</div>