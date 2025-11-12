<?php

/**
 * Block: Sticky Contacts
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
	'facebook_url' => '',
]);

$_class = 'sticky-contacts';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<a class="<?php echo esc_attr($_class); ?> position-fixed z-3" target="_blank" href="<?php echo esc_url($data['facebook_url']); ?>">
	<figure>
		<img class="image__img w-100 h-100" src="<?php echo get_theme_file_uri('static-assets/images/mess-fb.png'); ?>" alt="" width="200" height="200">
	</figure>
</a>
