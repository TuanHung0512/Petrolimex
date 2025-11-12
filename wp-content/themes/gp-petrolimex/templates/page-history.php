<?php

/**
 * Template Name: Lịch sử
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */
get_header();
$history_banner_background = get_field('history_banner_background');
$history_banner_title = get_field('history_banner_title');

$formation_title = get_field('formation_title');
$formation_description = get_field('formation_description');
$formation_icon = get_field('formation_icon');
$formation_items = get_field('formation_items');
$formation_background = get_field('formation_background');

$brand_image = get_field('brand_image');
$brand_title = get_field('brand_title');
$brand_description = get_field('brand_description');

$history_product_items = get_field('history_product_items');
$history_product_link_text = get_field('history_product_link_text');
$history_product_url = get_field('history_product_url');
$history_letter_hidden = get_field('history_letter_hidden');

$develop_id = get_field('develop_id');
$develop_background = get_field('develop_background');
$develop_image = get_field('develop_image');
$develop_title = get_field('develop_title');
$develop_description = get_field('develop_description');
?>
<div class="layout layout--history">
	<?php

	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'mb-2 mb-lg-4 hero-title--history-page',
		'title' => $history_banner_title,
		'background_image_id' => $history_banner_background,
		'static_image_width' => 1600,
		'static_image_height' => 380
	]);

	get_template_part('templates/blocks/history-formation', null, [
		'class' => '',
		'title' => $formation_title,
		'background' => $formation_background,
		'description' => $formation_description,
		'icon' => $formation_icon,
		'history' => $formation_items,
	]);

	get_template_part('templates/blocks/brand-intro', null, [
		'class' => '',
		'title' => $brand_title,
		'background' => $brand_image,
		'description' => $brand_description,
	]);

	get_template_part('templates/blocks/product-grid', null, [
		'items' => $history_product_items,
		'show_water_volume' => false,
		'class' => 'py-5',
		'hidden_letter' => $history_letter_hidden,
		'link_text' => $history_product_link_text,
		'redirect' => $history_product_url
	]);

	get_template_part('templates/blocks/development-history', null, [
		'id' => $develop_id,
		'class' => '',
		'background' => $develop_background,
		'image' => $develop_image,
		'title' => $develop_title,
		'description' => $develop_description,
	]);

	?>
</div>
<?php get_footer();
