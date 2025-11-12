<?php

/**
 * Block: Brand Intro
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'title' => '',
	'background' => '',
	'description' => '',
]);
$_class = 'brand-intro';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100">
	<div class="row m-0">
		<div class="col-md-6 p-0">
			<?php
			get_template_part('templates/core-blocks/image', null, [
				'image_id' => $data['background'],
				'image_size' => 'large',
				'lazyload' => true,
				'image_class' => 'w-100 h-100 object-fit-cover',
				'class' => 'brand-intro__background h-100',
			]);
			?>
		</div>
		<div class="col-md-6 p-0 bg-blue-light px-1 py-2 p-md-4">
			<div class="brand-intro__content text-white">
				<h2 class="brand-intro__title fw-bold lh-1 mt-0">
					<?php echo esc_html($data['title']) ?>
				</h2>
				<div class="brand-intro__description fw-semibold mt-1">
					<?php echo wpautop(wp_kses_post($data['description'])); ?>
				</div>
			</div>
		</div>
	</div>
</div>
