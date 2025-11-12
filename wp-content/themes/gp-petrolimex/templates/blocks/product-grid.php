<?php

/**
 * Block: Product Grid
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.5.0
 */

$data = wp_parse_args($args, [
	'class' => '',
	'items' => [],
	'taxonomy_name' => '',
	'hidden_letter' => '',
	'link_text' => '',
	'redirect' => '',
	'hotline' => '',
	'show_water_volume' => false
]);
$_class = 'product-grid' . (!empty($data['class']) ? ' ' . $data['class'] : '');

$_swiper_items = [];
foreach ($data['items'] as $item) {
	$thumbnail_id = get_post_thumbnail_id($item);
	ob_start();
?>

	<?php
	get_template_part('templates/core-blocks/image', null, [
		'image_id' => $thumbnail_id,
		'image_size' => 'full',
		'lazyload' => false,
		'class' => 'product-grid__item-image',
		'image_class' => 'w-auto m-auto d-block mb-1 mb-md-3'
	]); ?>
	<div class="position-relative">
		<?php if (!empty($item->water_volume) && !empty($data['show_water_volume'])): ?>
			<div class="product-grid__item-water text-black-50 fs-12 text-center mt-2"><?php echo esc_html($item->water_volume); ?></div>
		<?php endif; ?>
		<div class="product-grid__item-title text-center fw-bold fs-18"><?php echo esc_attr($item->post_title) ?></div>
		<div class="product-grid__item-content w-100 text-center opacity-0 fs-16 position-absolute top-0">
			<?php echo wp_kses_post($item->post_content) ?>
		</div>
	</div>
	<?php if ($data['hotline']): ?>
		<button class="fs-18 position-relative btn m-auto d-block mt-1 bg-blue px-2 border-0 rounded-0 text-white fw-medium js-open-hotline-modal" type="button" aria-haspopup="dialog" aria-controls="vh-call-modal">
			<span class=" text text-white"><?php echo __('Call now', 'gp-petrolimex'); ?></span>
		</button>
	<?php endif; ?>
<?php
	$html = ob_get_clean();
	$_swiper_items[] = [
		'lazyload' => false,
		'content' => $html,
	];
}
?>
<?php if (!empty($_swiper_items)) : ?>
	<div class="<?php echo esc_attr($_class); ?>" data-block="product-slide">
		<div class="container">
			<?php if ($data['taxonomy_name']): ?>
				<h3 class="product-grid__title text-center position-relative">
					<?php echo esc_html($data['taxonomy_name']); ?>
				</h3>
			<?php endif; ?>
			<div class="product-grid__main position-relative mx-1 mx-md-0">
				<div class="js-swiper-wrapper is-not-loaded">
					<noscript>
						<?php
						get_template_part('templates/core-blocks/swiper', null, [
							'items' => $_swiper_items,
							'class' => 'js-swiper',
							'settings' => [
								'autoplay' => 4000,
								'pagination' => false,
								'prevNextButtons' => false,
							],
						]);
						?>
					</noscript>
				</div>
				<div class="swiper-product-next lh-1 position-absolute end-0 translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-md-none d-flex align-items-center justify-content-center top-50">></div>
				<div class="swiper-product-prev lh-1 position-absolute translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-md-none d-flex align-items-center justify-content-center top-50"><</div>
				<div class="product-grid__item-letter font-subtitle position-absolute translate-middle top-50 start-50 text-center h1 text-blue-light w-100"><?php echo esc_html($data['hidden_letter']); ?></div>
				<?php if ($data['link_text']): ?>
					<div class="product-grid__item-seemore fs-14 mt-3 text-center text-blue-light fw-semibold">
						<?php echo __('See more', 'gp-petrolimex'); ?>
					</div>
					<a class="product-grid__item-link fs-18 text-uppercase d-block text-center fw-semibold text-blue-light" href="<?php echo esc_url($data['redirect']); ?>">
						<?php echo esc_html($data['link_text']); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
