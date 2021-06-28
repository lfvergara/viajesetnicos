<?php if(is_array($tours_list) && count($tours_list)) : ?>
		<?php foreach($tours_list as $tour_item) :
			global $post;

			$post = $tour_item;
			setup_postdata($tour_item); ?><!--
		--><?php echo mkdf_tours_get_tour_module_template_part('templates/tour-item/'.$type, 'tours', '', '', array(
				'thumb_size' => $thumb_size,
				'text_length' => $text_length,
				'title_tag' => $title_tag
			));?><!--
		--><?php endforeach; ?>
<?php else: ?>
	<p><?php esc_html_e('Aún no tenemos ninguna ruta con tus criterios de búsqueda, pero puedes ponerte en contacto con nosotros a direccion@viajesetnicos.com o visitar las rutas que ya hemos diseñado para ti.', 'mkdf-tours'); ?></p>
	<br><br>
	<p><center><a href="https://viajesetnicos.com/nuestros-viajes" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid" data-searching-label="Buscando...">+ RUTAS</a></center></p>
<?php endif; ?>
