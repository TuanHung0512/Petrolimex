<?php

/**
 * Template Name: Huyền thoại petrolimex
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();
$legendary_banner_background = get_field('legendary_banner_background');
$legendary_banner_title = get_field('legendary_banner_title');
$legendary_banner_image = get_field('legendary_banner_image');
$legendary_banner_note = get_field('legendary_banner_note');

$progress_items = get_field('progress_items');

$legendary_product_items = get_field('legendary_product_items');
$legendary_product_link_text = get_field('legendary_product_link_text');
$legendary_product_url = get_field('legendary_product_url');
$legendary_product_letter = get_field('legendary_product_letter');

$_class = 'layout-legendary';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> fullpage-legendary" id="layout-legendary" data-block="fullpage-legendary">
	<div class="section">
		<?php
		get_template_part('templates/blocks/banner-legendary', null, [
			'background' => $legendary_banner_background,
			'title' => $legendary_banner_title,
			'image' => $legendary_banner_image,
			'note' => $legendary_banner_note,
		]);
		?>
	</div>
	<?php foreach ($progress_items as $key => $items) : ?>
		<div class="section">
			<?php
			get_template_part('templates/blocks/progress-legendary', null, [
				'items' => $items,
				'id' => $key
			]);
			?>
		</div>
	<?php endforeach; ?>
	<div class="section bg-light">
		<?php
		get_template_part('templates/blocks/product-grid', null, [
			'items' => $legendary_product_items,
			'show_water_volume' => false,
			'class' => 'py-5',
			'hidden_letter' => $legendary_product_letter,
			'link_text' => $legendary_product_link_text,
			'redirect' => $legendary_product_url
		]);
		?>
	</div>
	<div class="section fp-auto-height bg-light">
		<?php get_footer(); ?>
	</div>
</div>

<?php get_template_part('templates/blocks/back-to-top'); ?>
