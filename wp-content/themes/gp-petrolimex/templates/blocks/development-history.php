<?php

/**
 * Block: Development History
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'id' => '',
	'class' => '',
	'background' => '',
	'image' => '',
	'title' => '',
	'description' => '',
]);
$_class = 'development-history';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100 position-relative" id="<?php echo esc_attr($data['id']); ?>">
	<div class="development-history__top position-relative text-center">
		<?php
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $data['background'],
			'image_size' => 'large',
			'lazyload' => true,
			'image_class' => 'w-100 object-fit-cover',
			'class' => 'development-history__background w-100 h-100 z-1',
		]);
		?>
	</div>
	<div class="container">
		<?php
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $data['image'],
			'image_size' => 'full',
			'lazyload' => true,
			'class' => 'development-history__image has-image-size-full image position-absolute start-50 top-0 translate-middle-x z-2',
			'image_class' => 'd-block mx-auto h-auto',
		]);
		?>
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-11">
				<div class="development-history__box mx-auto bg-white text-center position-relative shadow-lg py-2 px-1 p-md-5 w-100 z-3">
					<h2 class="development-history__title text-blue-light fw-bold lh-sm">
						<?php echo esc_html($data['title']) ?>
					</h2>
					<div class="development-history__description fw-bold text-md-center">
						<?php echo wpautop(wp_kses_post($data['description'])); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
