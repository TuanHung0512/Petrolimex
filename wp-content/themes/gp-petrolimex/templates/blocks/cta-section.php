<?php
/**
 * Block: CTA Section
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'description' => ''
]);

$_class = 'py-2 py-lg-4 text-center cta-section';
$_class .= !empty( $data['class'] ) ? esc_attr(' ' . $data['class'] ) : '';

if ( !empty( $data['title'] ) ) : ?>
	<div class="<?php echo esc_attr( $_class ); ?>">
		<div class="container">
			<h2 class="h2 text-blue-light cta-section__title"><?php echo esc_html( $data['title'] ); ?></h2>
			<div class="cta-section__description fs-18"><?php echo wp_kses_post( $data['description'] ); ?></div>
		</div>
	</div>
<?php endif;
