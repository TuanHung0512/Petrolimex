<?php

/**
 * Template Name: Home
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();
$banner_slider = get_field('banner_slider');

$about_title = get_field('about_title');
$about_ingredient = get_field('about_ingredient');

$choose_products = get_field('choose_products');
$product_text_button = get_field('product_text_button');
$product_link_button = get_field('product_link_button');
$home_product_hidden_text = get_field('home_product_hidden_text');
$_class = 'layout';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> layout--home mt-0 mt-md-0">
	<?php get_template_part('templates/blocks/banner-slide', null, [
		'banner_slider' => $banner_slider
	]);

	get_template_part('templates/blocks/ingredient-intro', null, [
		'title' => $about_title,
		'items' => $about_ingredient
	]);

	get_template_part('templates/blocks/product-grid', null, [
		'items' => $choose_products,
		'show_water_volume' => false,
		'class' => 'py-3',
		'hidden_letter' => $home_product_hidden_text,
		'link_text' => $product_text_button,
		'redirect' => $product_link_button
	]);

	?>

</div>
<?php get_footer();
