<?php

/**
 * Block: Topic Post
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
	'items' => [],
]);

$_class = 'topic-post';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> border-1 border-dark-subtle border-top mt-3 pb-2 pt-2" data-block="topic-post">
	<h3 class="h5 mb-1"><?php echo __('Articles on the same topic', 'gp-petrolimex') ?></h3>
	<div class="container">
		<div class="row position-relative">
			<?php
			$swiper_items = [];
			if (!empty($data['items']) && is_array($data['items'])) {
				foreach ($data['items'] as $post_id) {
					ob_start();
					get_template_part('templates/blocks/post-card', null, [
						'class'    => '',
						'class_slider' => 'js-swiper',
						'post_id' => $post_id,
					]);
					$slide_html = ob_get_clean();
					$swiper_items[] = [
						'content' => $slide_html
					];
				}
			}

			if (!empty($swiper_items)) {
				get_template_part('templates/core-blocks/swiper', null, [
					'class' => 'post-slider__swiper js-swiper',
					'items' => $swiper_items,
					'settings' => [
						'autoplay' => true,
						'pagination' => false,
						'prevNextButtons' => false
					]
				]);
			}
			?>
			<button type="button" class="position-absolute translate-middle-y top-50 start-0 border-0 post-slider__prev d-md-none z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-flex align-items-center justify-content-center" aria-label="Previous">‹</button>
			<button type="button" class="position-absolute translate-middle-y top-50 end-0 border-0 post-slider__next d-md-none z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-flex align-items-center justify-content-center" aria-label="Next">›</button>
		</div>
	</div>
</div>
