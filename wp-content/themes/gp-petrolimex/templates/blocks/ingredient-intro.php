<?php

/**
 * Block: Ingredient
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'title' => '',
	'items' => []
]);
if (!empty($data['items'])) :
	$swiper_items = [];
	foreach ($data['items'] as $item) {
		ob_start();
		?>
			<h3 class="ingredient-intro__item-name fw-bold pt-2 mb-1 ms-0 ms-md-2 text-blue"><?php echo esc_html($item['name']); ?></h3>
			<div class="ingredient-intro__item-caption position-relative ps-0 ps-2 pt-0 ps-md-3 pt-md-1">
				<div class="ingredient-intro__item-character fw-lighter text-white z-1"><?php echo wp_kses_post($item['character']); ?></div>
				<div class="d-none d-md-block ingredient-intro__item-description w-50 z-1 mt-2 text-white position-absolute top-0 w-100"><?php echo wp_kses_post($item['description']); ?></div>
			</div>
			<div class="d-block d-md-none ingredient-intro__item-description mt-2 ingredient-intro__description-mobile start-0 position-absolute z-1 pt-1 mt-1 text-white fs-18"><?php echo wp_kses_post($item['description']); ?></div>
		<?php
		$slide_html = ob_get_clean();
		$swiper_items[] = [
			'content' => $slide_html,
			'lazyload' => false,
		];
	}
	$_class = 'ingredient-intro';
	$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
	<div class="<?php echo esc_attr($_class); ?> w-100 position-relative overflow-hidden" data-block="ingredient-slider">
		<img class="ingredient-intro__background d-none d-md-block position-absolute z-1 w-100 h-100 top-0 left-0 object-fit-cover pe-none" src="<?php echo esc_url(get_theme_file_uri('static-assets/images/water1.png')) ?>" alt="" width="1600" height="1310" loading="lazy">
		<img class="ingredient-intro__background d-none d-md-block position-absolute z-1 w-100 h-100 top-0 left-0 object-fit-cover pe-none" src="<?php echo esc_url(get_theme_file_uri('static-assets/images/water2.png')) ?>" alt="" width="1600" height="1310" loading="lazy">
		<img class="ingredient-intro__background d-none d-md-block position-absolute z-1 w-100 h-100 top-0 left-0 object-fit-cover pe-none" src="<?php echo esc_url(get_theme_file_uri('static-assets/images/water3.png')) ?>" alt="" width="1600" height="1310" loading="lazy">
		<div class="container">
			<div class="row  align-items-md-center align-items-start">
				<div class="ingredient-intro__title col-4 mb-md-0 position-relative d-flex align-items-baseline align-items-md-center">
					<figure class="ingredient-intro__left-number w-100 left-0">
						<img class="h-auto" src="<?php echo esc_url(get_theme_file_uri('static-assets/images/ingredient-number.png')) ?>" alt="" width="200" height="311" loading="lazy">
					</figure>
					<h3 class="ingredient-intro__left-title position-absolute translate-middle-y top-50 text-uppercase text-white z-1 mb-4"><?php echo esc_html($data['title']); ?></h3>
				</div>
				<div class="ingredient-intro__slide col-7 position-relative">
					<div class="js-swiper-wrapper is-not-loaded h-100">
						<noscript>
							<?php
							get_template_part('templates/core-blocks/swiper', null, [
								'class' => 'ingredient__swiper ingredient-intro__item js-swiper h-100 py-5',
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

				</div>
				<div class="ingredient-intro__pagination col-1 mt-5 mt-md-0 d-flex align-items-center justify-content-end">
					<div id="swiper-pagination" class="text-white d-flex align-items-end justify-content-center flex-column"></div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
