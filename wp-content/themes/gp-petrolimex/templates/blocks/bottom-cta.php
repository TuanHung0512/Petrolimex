<?php

/**
 * Block: Section Bottom CTA
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => __('See more', 'gp-petrolimex'),
	'button_text' => '',
	'button_url' => ''
]);

$_class = 'bottom-cta';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

?>

<div class="<?php echo esc_attr($_class); ?> text-center fw-semibold">
	<span class="d-block fs-14 text-blue-light"><?php echo esc_html($data['title']); ?></span>
	<a class="d-block text-uppercase fs-18 text-blue-light" href="<?php echo esc_url_raw($data['button_url']); ?>">
		<?php echo esc_html($data['button_text']); ?>
	</a>
</div>
