<?php

/**
 * Block: About Value
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'items' => []
]);
$_class = 'about-value';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100">
	<div class="d-flex flex-column flex-md-row">
		<?php foreach ($data['items'] as $item): ?>
			<div class="about-value__develop position-relative d-flex align-items-center justify-content-center col-12 col-md">
				<?php
				get_template_part('templates/core-blocks/image', null, [
					'image_id' => $item['background_image'],
					'image_size' => 'large',
					'lazyload' => true,
					'image_class' => 'w-100 h-100 object-fit-cover',
					'class' => 'about-value__image position-absolute top-0 start-0 w-100 h-100',
				]);
				?>
				<div class="about-value__content p-md-4 p-2 m-auto <?php if (empty($item['content'])) {
																		echo 'py-5';
																	} ?> text-center w-100 position-relative z-1 mx-auto">
					<?php if (!empty($item['name'])): ?>
						<div class="about-value__title text-white text-uppercase h4 lh-sm">
							<?php echo esc_html($item['name']); ?>
						</div>
					<?php endif; ?>
					<?php if (!empty($item['content'])): ?>
						<div class="about-value__description m-0 text-white fw-semibold mt-1 lh-base">
							<?php echo wp_kses_post($item['content']); ?>
						</div>
					<?php endif; ?>
					<?php if (!empty($item['button_link'])): ?>
						<a href="<?php echo esc_url($item['button_link']) ?>"
							class="btn__primary about-value__button fs-18 m-auto mt-1 d-block text-decoration-none fw-bold btn__primary bg-blue text-white">
							<span><?php echo esc_html($item['button_text']) ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
