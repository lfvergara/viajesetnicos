<?php

/*** Child Theme Function  ***/

function roam_mikado_child_theme_enqueue_scripts() {
	
	$parent_style = 'roam_mikado_default_style';
	
	wp_enqueue_style('roam_mikado_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action( 'wp_enqueue_scripts', 'roam_mikado_child_theme_enqueue_scripts' );

// Change default WP email sender
 add_filter('wp_mail_from', 'doEmailFilter');
 add_filter('wp_mail_from_name', 'doEmailNameFilter');

function doEmailFilter($email_address){
 if($email_address === "wordpress@dominio.com")
 return 'info@viajesetnicos.com';
 else
 return $email_address;
 }
 function doEmailNameFilter($email_from){
 if($email_from === "WordPress")
 return 'VIAJES ÉTNICOS';
 else
 return $email_from;
 }

//Añadir checkbox despues del campo Comentario
add_filter( 'comment_form_field_comment', 'my_comment_form_field_comment' );
function my_comment_form_field_comment( $comment_field ) {
return $comment_field.'<p class="pprivacy"><label for="pprivacy"><input type="checkbox" style="width:30px" name="privacy" value="Privacidad Aceptada" class="privacyBox" aria-req="true">He leido y acepto <a target="blank" href="https://viajesetnicos.com/aviso-legal-y-politica-de-privacidad">la política de privacidad</a></label><p>';
}
//javascript validation
add_action('wp_footer','valdate_privacy_comment_javascript');
function valdate_privacy_comment_javascript(){
if (! is_admin() && is_single() && comments_open() ){
wp_enqueue_script('jquery');
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#submit").click(function(e)){
if (!$('.privacyBox').prop('checked')){
e.preventDefault();
alert('Debes confirmar que estás de acuerdo con nuestra política de privacidad marcando la "cajita" ....<p><a href="javascript:history.back()">' . __('&laquo; Volver') . '</a></p>');
return false;
}
}
});
</script>
<?php
}
}

//no js fallback validation
add_filter( 'preprocess_comment', 'verify_comment_privacy' );
function verify_comment_privacy( $commentdata ) {
if ( ! isset( $_POST['privacy'] ) && ! is_admin() )
wp_die( __( 'Error: Debes confirmar que estás de acuerdo con nuestra política de privacidad marcando la "cajita" ..... <p><a href="javascript:history.back()">' . __('&laquo; Volver') . '</a></p>' ) );

return $commentdata;
}

// Guardamos el valor aceptado en la tabla comment metadata
function save_comment_meta_data ( $post_id ) {
$privacy_comment = $_POST['privacy'];
if ( $privacy_comment ) {
add_comment_meta( $post_id, 'privacy', $privacy_comment, true );
}}

add_action( 'comment_post', 'save_comment_meta_data', 1 );

// Mostramos el valor del metadato en la página de administración de comentarios
if ( is_admin() ) {
function show_commeta() {
   echo get_comment_text(), '<br><br><strong>', get_comment_meta(get_comment_ID(), 'privacy',1), '<strong>';
   }
add_action('comment_text', 'show_commeta');
}

function hormi_change_note_after_comment_form($arg) {
$arg['comment_notes_after'] = '<p class="comment-notes">Responsable: Viajes Étnicos
Finalidad: Mantener una relación comercial y el envío de comunicaciones.
Legitimación: Consentimiento del usuario.
Destinatarios: No se comunicarán los datos a terceros, salvo por una obligación legal.
Derechos: Acceder, rectificar y suprimir los datos, así como otros derechos, como se explica en la información adicional.
Información adicional: Puede consultar la información detallada sobre la protección de datos <a target="blank" href="https://viajesetnicos.com/aviso-legal-y-politica-de-privacidad">aquí.</a></p>';
return $arg;
}

add_filter('comment_form_defaults', 'hormi_change_note_after_comment_form');

//* Campo comentario al final de nuevo */
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );