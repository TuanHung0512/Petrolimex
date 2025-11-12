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
$banner_title = __('The secret power of minerals', 'gp-petrolimex');

$current_term = get_queried_object();
$tax_query = [];
if ($current_term instanceof WP_Term) {
    $tax_query = [
        [
            'taxonomy' => 'biquyet',
            'field'    => 'term_id',
            'terms'    => $current_term->term_id,
        ]
    ];
}

$secrets_query = new WP_Query([
    'post_type' => 'biquyetcuakhoang',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'tax_query' => $tax_query,
]);

$taxonomy = 'biquyet';
$page_secret = get_pages([
	'meta_key'   => '_wp_page_template',
	'meta_value' => 'templates/page-secret.php'
]);
$page_secret_url = !empty($page_secret) ? get_permalink($page_secret[0]->ID) : home_url('/');
$terms = get_terms([
	'taxonomy' => $taxonomy,
	'hide_empty' => false,
]);
$items = [];
$items[] = [
	'title' => __('All', 'gp-petrolimex'),
	'url' => esc_url($page_secret_url),
	'is_active' => !is_tax($taxonomy),
];
foreach ($terms as $term) {
	$is_active = is_tax($taxonomy) && (get_queried_object_id() == $term->term_id);
	$items[] = [
		'title' => esc_html($term->name),
		'url' => esc_url(get_term_link($term)),
		'is_active' => $is_active,
	];
}
?>
<div class="w-100 layout">
	<?php
	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'hero-title--secrets-page mb-1',
		'title' => $banner_title,
		'static_image_filename' => 'bannertip.jpg',
		'static_image_width' => 1600,
		'static_image_height' => 340
	]);
	get_template_part('templates/blocks/subnav', null, [
		'class' => 'category-secrets__subnav',
		'items' => $items,
	]);
	get_template_part('templates/blocks/secrets-grid', null, [
		'items' => $secrets_query
	]);
	?>
</div>
<?php get_footer();
