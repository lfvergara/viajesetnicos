<?php  ?>

<div class="mkdf-tour-booking-form-holder mkdf-boxed-widget">
	<h4 class="mkdf-tour-booking-title"><?php esc_html_e('Quiero más info de este viaje', 'mkdf-tours'); ?></h4>
	<form id="mkdf-tour-booking-form" method="POST">
		<?php wp_nonce_field('mkdf_tours_booking_form', 'mkdf_tours_booking_form'); ?>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" placeholder="<?php esc_attr_e('Nombre *', 'mkdf-tours'); ?>" value="<?php echo esc_attr(mkdf_tours_get_current_user_name()); ?>" name="user_name">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-pencil"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" value="<?php echo esc_attr(mkdf_tours_get_current_user_email()); ?>" placeholder="<?php esc_attr_e('Email *', 'mkdf-tours'); ?>" name="user_email">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-mail"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" autocomplete="off"  value="" placeholder="<?php esc_attr_e('Confirmar Email *', 'mkdf-tours'); ?>" name="user_confirm_email">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-mail"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" placeholder="<?php esc_attr_e('Teléfono', 'mkdf-tours'); ?>" name="user_phone">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-phone"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="text" class="mkdf-tour-period-picker" placeholder="<?php echo esc_attr('Fecha aproximada *'); ?>" name="date">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-calendar"></i>
			</span>
		</div>

		<div id="mkdf-tour-booking-time-picker"></div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<input type="number" name="number_of_tickets" min="1" placeholder="<?php esc_attr_e('Número de personas *', 'mkdf-tours'); ?>">

			<span class="mkdf-tours-input-icon">
				<i class="dripicons-ticket"></i>
			</span>
		</div>

		<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
			<textarea name="message" placeholder="<?php esc_attr_e('Mensaje', 'mkdf-tours'); ?>"></textarea>
			<span class="mkdf-tours-input-icon">
				<i class="dripicons-document-edit"></i>
			</span>
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
				<div class="mkdf-tour-booking-field-holder mkdf-tours-input-with-icon">
					<select name="time">
						<% _.each(times, function(time) { %>
							<option value="<%= time.time %>"><%= time.time %></option>
						<% }) %>
					</select>

					<span class="mkdf-tours-input-icon">
						<i class="lnr lnr-clock"></i>
					</span>
				</div>
			<% } %>
		</script>

		<?php if(mkdf_tours_theme_installed()) : ?>
			<?php echo roam_mikado_execute_shortcode('mkdf_button', array(
				'text' => esc_html__('Disponibilidad', 'mkdf-tours'),
				'type' => 'grey',
				'custom_attrs' => array(
					'data-loading-label' => esc_attr__('Comprobando...', 'mkdf-tours')
				),
				'custom_class' => 'mkdf-tours-check-availability'
			)); ?>
		<?php else: ?>
			<a href="#" class="mkdf-tours-check-availability"><?php esc_html_e('Disponibilidad', 'mkdf-tours'); ?></a>
		<?php endif; ?>

		<?php if(mkdf_tours_theme_installed()) : ?>
			<?php echo roam_mikado_execute_shortcode('mkdf_button', array(
				'html_type' => 'input',
				'input_name' => 'submit',
				'text' => esc_html__('Enviar ahora', 'mkdf-tours'),
				'custom_attrs' => array(
					'data-loading-label' => esc_attr__('Trabajando...', 'mkdf-tours'),
					'data-redirecting-label' => esc_attr__('Redirigiendo...', 'mkdf-tours'),
					'disabled' => 'disabled'
				)
			)) ?>
		<?php else : ?>
			<input disabled data-redirecting-label="<?php esc_attr_e('Redirigiendo...', 'mkdf-tours') ?>" data-loading-label="<?php esc_attr_e('Trabajando...', 'mkdf-tours'); ?>" type="submit" value="<?php echo esc_attr('Enviar ahora', 'mkdf-tours'); ?>">
		<?php endif; ?>
		<br></p>
		<br></p>
		Al enviar este formulario estas aceptando el <a href="https://viajesetnicos.com/aviso-legal-y-politica-de-privacidad" target="_blank"><b>Aviso legal</b></a> y la <a href="https://viajesetnicos.com/aviso-legal-y-politica-de-privacidad" target="_blank"><b>Política de privacidad.</b></a>
	</form>
</div>
