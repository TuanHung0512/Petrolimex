<?php

/**
 * Block: Gallery benefits
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => ''
]);

$_class = 'w-100 position-relative pt-6 pb-2 gallery-benefits';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$post_ids = get_posts([
	'post_type' => 'biquyetcuakhoang',
	'post_status' => 'publish',
	'posts_per_page' => 8,
	'fields' => 'ids',
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
	'no_found_rows' => true
]);

$pages = get_pages([
	'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'templates/page-secret.php'
]);

$page_object = !empty($pages) ? $pages[0] : null;

$link = !empty($page_object) ? get_the_permalink($page_object->ID) : '';
$caption_text = !empty($page_object) ? get_the_title($page_object->ID) : '';

if (!empty($post_ids)) :

	$_grid_items = [];
	$_swiper_items = [];

	foreach ($post_ids as $index => $post_id) {
		ob_start();
		get_template_part('templates/blocks/benefit-card', null, [
			'post_id' => $post_id
		]);
		$slide_html = ob_get_clean();

		ob_start();
		get_template_part('templates/blocks/benefit-card', null, [
			'class' => 'flex-grow-1 text-center overflow-hidden benefit-card--grid',
			'post_id' => $post_id
		]);
		$grid_item_html = ob_get_clean();

		$_grid_items[] = [
			'class' => 'd-flex flex-column gallery-benefits__item gallery-benefits__item--pc gallery-benefits__item--' . $index + 1,
			'content' => $grid_item_html,
		];

		$_swiper_items[] = [
			'content' => $slide_html
		];
	}

	if (! empty($page_object)) {
		$caption_raw = $caption_center;
		if (! empty($caption_text)) {
			$words = explode(' ', $caption_text);

			if (count($words) > 2) {
				$first_part = implode(' ', array_slice($words, 0, -2));
				$last_part  = implode(' ', array_slice($words, -2));
				$caption_raw = $first_part . '<br>' . $last_part;
			}
		}
		ob_start(); ?>
		<div class="gallery-benefits__caption position-absolute top-50 start-50 translate-middle text-center z-3">
			<figure class="gallery-benefits__caption-img d-flex align-items-center justify-content-center w-100 h-100">
				<img src="<?php echo esc_url(get_theme_file_uri('static-assets/images/bg-caption-gallery-benefits.jpg')) ?>" alt="" width="340" height="219" loading="lazy">
			</figure>
			<a href="<?php echo esc_url($link); ?>" class="gallery-benefits__inner position-absolute top-50 start-50 translate-middle text-decoration-none">
				<span class="gallery-benefit__caption-title d-inline-block px-4 py-3 rounded text-uppercase text-nowrap fw-semibold">
					<?php echo wp_kses_post($caption_raw); ?>
				</span>
			</a>
		</div>
	<?php
		$center_card_html = ob_get_clean();

		$_grid_items[] = [
			'class'   => 'd-flex flex-column gallery-benefits__item gallery-benefits__center translate-middle z-3',
			'content' => $center_card_html,
		];
	}
	?>
	<div class="<?php echo esc_attr($_class); ?>">

		<figure class="position-absolute top-0 left-0 w-100 h-100 z-1 pe-none gallery-benefits__background-image">
			<img class="object-fit-cover w-100 h-100" src="<?php echo get_theme_file_uri('static-assets/images/bg-gallery-benefits.jpg'); ?>" alt="" width="1600" height="1310" loading="lazy">
		</figure>
		<div class="position-relative z-2 gallery-benefits__main">
			<div class="container">
				<?php if (!empty($page_object)) : ?>
					<div class="d-md-none text-center">
						<a href="<?php echo esc_url($link); ?>" class="text-decoration-none d-block">
							<span class="gallery-benefit__caption-title fw-bold text-white fs-3">
								<?php echo wp_kses_post($caption_raw); ?>
							</span>
						</a>
					</div>
				<?php endif; ?>
				<div class="d-md-none is-not-loaded" data-block="gallery-benefits">
					<noscript>
						<?php
						get_template_part('templates/core-blocks/swiper', null, [
							'items' => $_swiper_items,
							'settings' => [
								'pageDots' => true,
								'pagination' => true,
								'prevNextButtons' => true
							],
							'class' => 'gallery-benefits__swiper js-swiper'
						]);
						?>
					</noscript>
				</div>
				<div class="d-none d-md-block mx-auto" data-block="static-modal">
					<div class="position-relative d-block py-4 mx-auto gallery-benefits__grid d-md-grid gap-3">
						<?php foreach ($_grid_items as $item) : ?>
							<div class="<?php echo esc_attr($item['class']); ?>">
								<?php echo $item['content']; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php
				get_template_part('templates/blocks/bottom-cta', null, [
					'class' => 'mt-1 mt-md-0',
					'button_text' => $caption_text,
					'button_url' => $link
				]);
				?>

			</div>
		</div>

	</div>
<?php endif;
