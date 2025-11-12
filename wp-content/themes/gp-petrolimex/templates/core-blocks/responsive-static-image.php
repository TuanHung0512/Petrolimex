<?php
/**
 * Block: Responsive Static Image
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'static_mobile_filename' => '',
	'static_pc_filename' => '',
	'width' => 600,
	'height' => 338,
	'alt' => '',
	'breakpoint' => 800,
	'lazyload' => true
]);

$_class = 'responsive-static-image';
$_class .= !empty( $data['class'] ) ? esc_attr(' ' . $data['class']) : '';

$_image_class = 'responsive-static-image__image';
$_image_class .= !empty( $data['image_class']) ? esc_attr(' ' . $data['image_class']) : '';
$_image_class .= !empty( $data['lazyload'] ) ? ' no-lazy' : '';

if ( !empty( $data['static_mobile_filename'] ) ) :

?>
	<picture class="<?php echo esc_attr( $_class ); ?>">
		<?php if ( !empty( $data['static_pc_filename'] ) ) : ?>
			<source srcset="<?php echo get_theme_file_uri('static-assets/images/' . $data['static_pc_filename']); ?>" media="(min-width: <?php echo esc_attr( $data['breakpoint'] ); ?>px)">
		<?php endif; ?>
		<img class="<?php echo esc_attr( $_image_class ); ?>" src="<?php echo get_theme_file_uri('static-assets/images/' . $data['static_mobile_filename']); ?>" alt="<?php echo !empty( $data['alt'] ) ? esc_attr($data['alt']) : ''; ?>" width="<?php echo esc_attr($data['width']); ?>" height="<?php echo esc_attr($data['height']); ?>"<?php if (!empty( $data['lazyload'] )) : ?> loading="lazy"<?php endif; ?>>
	</picture>
<?php endif;
