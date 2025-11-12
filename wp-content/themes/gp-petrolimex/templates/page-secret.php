<?php

/**
 * Template Name: Bí quyết
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();
$secret_banner_background = get_field('secret_banner_background');
$secret_banner_title = get_field('secret_banner_title');

$secrets_query = new WP_Query([
	'post_type' => 'biquyetcuakhoang',
	'posts_per_page' => -1,
	'post_status' => 'publish',
]);

$taxonomy = 'biquyet';
$terms = get_terms([
	'taxonomy' => $taxonomy,
	'hide_empty' => false,
]);

$page_secret = get_pages([
	'meta_key'   => '_wp_page_template',
	'meta_value' => 'templates/page-secret.php'
]);
$page_secret_url = !empty($page_secret) ? get_permalink($page_secret[0]->ID) : home_url('/');
$items = [];
$items[] = [
	'title' => __('All', 'gp-petrolimex'),
	'url' => esc_url($page_secret_url),
	'is_active' => (!is_tax($taxonomy) && empty($data['term_id'])),
];
?>
<div class="w-100 layout layout--secret">
	<?php
	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'mb-1',
		'title' => $secret_banner_title,
		'background_image_id' => $secret_banner_background,
		'static_image_width' => 1600,
		'static_image_height' => 340
	]);

	foreach ($terms as $term) {
		$is_active = (is_tax($taxonomy) && get_queried_object_id() == $term->term_id) || (!empty($data['term_id']) && $term->term_id == $data['term_id']);
		$items[] = [
			'title' => esc_html($term->name),
			'url' => esc_url(get_term_link($term)),
			'is_active' => $is_active,
		];
	}

	get_template_part('templates/blocks/subnav', null, [
		'class' => 'subnav--categories',
		'items' => $items,
	]);

	get_template_part('templates/blocks/secrets-grid', null, [
		'items' => $secrets_query
	]);
	?>
</div>
<?php get_footer();
