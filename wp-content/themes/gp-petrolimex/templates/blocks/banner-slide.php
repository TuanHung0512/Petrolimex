<?php

/**
 * Block: Banner Slide
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'banner_slider' => [],
	'class' => ''
]);

if (!empty($data['banner_slider'])) :
	$swiper_items = [];
	foreach ($data['banner_slider'] as $item) {
		ob_start();
		get_template_part('templates/core-blocks/image', null, [
			'class' => 'd-block w-100 banner-slide__image',
			'image_id' => $item['background'],
			'image_size' => 'full',
			'lazyload' => false,
			'image_class' => 'object-fit-cover h-100 w-100',
		]);
?>
		<div class="banner-slide__content w-100 position-absolute h-auto object-fit-cover mt-0 mt-md-4">
			<h3 class="banner-slide__title fw-bold text-uppercase fw-semibold lh-1">
				<?php echo esc_html($item['title']); ?>
			</h3>
			<h4 class="banner-slide__subtitle fw-bold lh-1 text-blue font-subtitle">
				<?php echo esc_html($item['subtitle']); ?>
			</h4>
			<div class="banner-slide__description mb-2 fs-16 w-50 d-none d-md-block">
				<?php echo wpautop(wp_kses_post($item['desctiption'])); ?>
			</div>
			<a href="<?php echo esc_url($item['link_button']); ?>"
				class="btn__primary banner-slide__button bg-blue text-white text-decoration-none px-2 py-1 fw-semibold d-block">
				<span><?php echo esc_html($item['text_button']); ?></span>
			</a>
		</div>
	<?php
		$slide_html = ob_get_clean();
		$swiper_items[] = [
			'content' => $slide_html,
			'lazyload' => false,
		];
	}
	?>
	<div class="banner-slide position-relative pt-2 pt-md-0 <?php echo esc_attr($data['class']); ?>" data-block="banner-slide">
		<div class="js-swiper-wrapper is-not-loaded">
			<noscript>
				<?php
				get_template_part('templates/core-blocks/swiper', null, [
					'class' => 'banner-slide__swiper banner-slide__item js-swiper h-100',
					'items' => $swiper_items,
					'settings' => [
						'autoplay' => false,
						'pagination' => false,
						'prevNextButtons' => false,
					]
				]);
				?>
			</noscript>
		</div>
		<div class="swiper-banner-next position-absolute end-0 translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-md-none d-flex align-items-center justify-content-center top-50">></div>
		<div class="swiper-banner-prev position-absolute translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-md-none d-flex align-items-center justify-content-center top-50"><</div>
		</div>
	<?php endif; ?>
