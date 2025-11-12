<?php

/**
 * Shareholder Archive Template
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */
get_header();

global $wp_query;

$current_term = get_queried_object();

$all_terms = get_terms([
	'taxonomy' => $current_term->taxonomy,
	'hide_empty' => false,
]);

$items = [];
foreach ($all_terms as $term) {
	$is_active = ($current_term instanceof WP_Term) && ($current_term->term_id === $term->term_id);
	$items[] = [
		'title' => $term->name,
		'url' => get_term_link($term),
		'is_active' => $is_active,
	];
}

?>
<div class="w-100 layout layout--shareholder">
	<?php
	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'hero-title--shareholder-page mb-1',
		'title' => get_field('shareholder_page_title', 'options'),
		'static_image_filename' => 'bg-shareholder.jpg',
		'static_image_width' => 1600,
		'static_image_height' => 339
	]);

	get_template_part('templates/blocks/subnav', null, [
		'class' => 'subnav--light mb-1',
		'items' => $items,
	]);

	get_template_part('templates/blocks/shareholder-grid', null, [
		'class' => 'mb-2 mb-lg-4',
		'post_query' => $wp_query,
	]);

	$investment_acf_keys = [
		'background_image_id' => 'investment_contact_background',
		'title' => 'investment_contact_title',
		'description' => 'investment_contact_description',
		'items' => 'investment_contact_items',
	];

	$investment_cta_data = [];
	foreach ($investment_acf_keys as $key => $value) {
		$investment_cta_data[$key] = get_field($value, 'option');
	}

	get_template_part('templates/blocks/investment-cta', null, $investment_cta_data);

	?>
</div>
<?php get_footer();
