<?php

/**
 * Block: History formation
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'title' => 'title',
	'background' => '',
	'description' => '',
	'icon' => '',
	'history' => '',
]);
$_class = 'history-formation';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100 position-relative">
	<?php
	get_template_part('templates/core-blocks/image', null, [
		'image_id' => $data['background'],
		'image_size' => 'full',
		'lazyload' => true,
		'image_class' => 'w-100 h-100 object-fit-contain',
		'class' => 'history-formation__background position-absolute top-50 start-50 translate-middle w-100 h-100 z-0 pe-none',
	]);
	?>
	<div class="container">
		<h2 class="history-formation__title mx-auto text-center text-blue-light fw-bold">
			<?php echo esc_html($data['title']); ?>
		</h2>
		<div class="history-formation__description fw-medium text-center mx-auto">
			<?php echo wpautop(wp_kses_post($data['description'])); ?>
		</div>
		<?php
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $data['icon'],
			'image_size' => 'large',
			'lazyload' => true,
			'class' => 'history-formation__icon bg-blue-light mb-2 mt-3 d-flex align-items-center justify-content-center mx-auto rounded-circle',
		]);
		?>
		<div class="history-formation__detail d-flex row-cols-1 row-cols-md-3 z-1 justify-content-between flex-column flex-sm-row mx-auto w-100 pb-3 pb-md-6">
			<?php foreach ($data['history'] as $item): ?>
				<div class="history-formation__item <?php echo empty($item['title']) || empty($item['content']) ? 'no_txt' : ''; ?> z-1 bg-white d-flex position-static h-auto overflow-hidden flex-column-reverse flex-md-column justify-content-end">
					<?php if ($item['title'] || $item['content']): ?>
						<div class="history-formation__box">
							<h3 class="history-formation__box-title fw-bold lh-sm">
								<?php echo esc_html($item['title']); ?>
							</h3>
							<div class="history-formation__box-content fw-medium">
								<?php echo wpautop(wp_kses_post($item['content'])); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php
					get_template_part('templates/core-blocks/image', null, [
						'image_id' => $item['image'],
						'image_size' => 'large',
						'lazyload' => true,
						'class' => 'history-formation__item-img h-100 ratio ratio-1x1',
					]);
					?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
