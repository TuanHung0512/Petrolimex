<?php

/**
 * Block: Achievements About
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'title' => '',
	'description' => '',
	'items' => '',
	'note' => '',
	'text_redirect' => '',
	'link_redirect' => '',
	'background' => '',
	'background_award' => ''
]);

$mapping_items = [
    'prev' => 'angle-small-left',
    'next' => 'angle-small-right'
];

$_class = 'achievements-about position-relative';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
if (!empty($data['items'])) :

	$swiper_items = [];
	foreach ($data['items'] as $item) {
		ob_start();
		get_template_part('templates/core-blocks/image', null, [
			'class' => 'd-block d-flex w-100 top-0 start-0 justify-content-center align-items-center p-md-0 overflow-hidden achievements-about__item-image',
			'image_id' => $item['image'],
			'image_size' => 'full',
			'lazyload' => false,
			'image_class' => 'object-fit-contain opacity-0 w-100',
		]);
		$awards_item = ob_get_clean();
		ob_start();
?>
		<div class="achievements-about__right pt-0 pt-md-5">
			<div class="achievements-about__item-description position-relative h-auto">
				<div class="achievements-about__item-box top-0 start-0 p-1 p-md-3 opacity-0">
					<div class="achievements-about__item-name h3 text-uppercase text-white fw-bold">
						<?php echo $item['name']; ?>
					</div>
					<div class="achievements-about__item-content text-white fw-semibold">
						<?php echo $item['content']; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
		$awards_item .= ob_get_clean();
		$swiper_items[] = [
			'content' => $awards_item
		];
	}
	?>
	<div class="<?php echo esc_attr($_class); ?> w-100 position-relative py-5" data-block="achievements-about">
		<figure class="achievements-about__item-background d-flex align-items-end justify-content-center position-absolute bottom-0 w-100 h-100">
			<img class="w-100 h-auto object-fit-cover" src="<?php echo get_theme_file_uri('static-assets/images/bg-achievements.jpg'); ?>" alt="" width="1600" height="1310">
		</figure>
		<div class="container position-relative">
			<h2 class="achievements-about__title  text-center text-blue-light fw-bold m-0 text-accent">
				<?php echo esc_html($data['title']) ?>
			</h2>

			<div class="achievements-about__description text-center m-auto lh-base fw-semibold mb-2 mb-md-0">
				<?php echo esc_html($data['description']) ?>
			</div>
			<div class="achievements-about__listing position-relative mx-auto w-100">
				<figure class="achievements-about__background-award position-absolute d-flex align-items-center justify-content-center object-fit-contain w-100">
					<img class="w-100 h-100 object-fit-fill" src="<?php echo get_theme_file_uri('static-assets/images/bg-certifi.jpg'); ?>" alt="" width="1600" height="1310">
				</figure>

				<div class="achievements-about__slide position-relative overflow-hidden">
					<div class="js-swiper-wrapper is-not-loaded">
						<noscript>
							<?php
							get_template_part('templates/core-blocks/swiper', null, [
								'class' => 'achievements-about-slide__swiper js-swiper',
								'items' => $swiper_items,
								'settings' => [
									'autoplay' => false,
									'pagination' => false,
									'prevNextButtons' => false,
								],
							]);
							?>
						</noscript>
					</div>
					<div class="achievements-about__btn d-flex position-absolute gap-1 justify-content-between w-100 justify-content-md-start z-2">
						<button type="button" class="border-0 achievements-about__btn--left z-1 bg-body-secondary rounded-circle p-0 fs-22 cursor-pointer d-flex align-items-center justify-content-center" aria-label="Previous"><?php echo gp_petrolimex_get_svg_icon( $mapping_items['prev'] ); ?></button>
						<button type="button" class="border-0 achievements-about__btn--right z-1 bg-body-secondary rounded-circle p-0 fs-22 cursor-pointer d-flex align-items-center justify-content-center" aria-label="Next"><?php echo gp_petrolimex_get_svg_icon( $mapping_items['next'] ); ?></button>
					</div>
				</div>

				<div class="achievements-about__note text-center fw-bold fs-18 d-block m-auto mt-3 w-75">
					<?php echo wpautop(wp_kses_post($data['note'])); ?>
				</div>
				<?php
				get_template_part('templates/blocks/bottom-cta', null, [
					'button_text' => $data['text_redirect'],
					'button_url' => $data['link_redirect']
				]);
				?>
			</div>
		</div>
	<?php endif; ?>
