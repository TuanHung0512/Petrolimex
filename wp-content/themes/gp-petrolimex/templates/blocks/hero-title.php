<?php

/**
 * Block: Hero Title
 *
 * Usage: Contact page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'background_image_id' => '',
	'static_image_filename' => 'bg-contact.jpg',
	'static_image_width' => '1600',
	'static_image_height' => '340'
]);

$_class = 'py-2 py-lg-4 overflow-hidden text-center position-relative hero-title';
$_class .= !empty($data['class']) ? ' ' . esc_attr($data['class']) : '';
$_class .= !empty($data['background_image_id']) ? ' has-background-image' : '';
$_class .= !empty($data['static_image_filename']) ? ' has-static-background-image' : '';

if (!empty($data['title'])) : ?>
	<div class="<?php echo esc_attr($_class); ?>">
		<?php if (!empty($data['background_image_id'])) : ?>
			<div class="position-absolute pe-none top-0 left-0 w-100 h-100 hero-title__background-image">
				<?php
				get_template_part('templates/core-blocks/image', null, [
					'image_id' => $data['background_image_id'],
					'image_size' => 'full',
					'class' => 'position-absolute top-0 left-0 w-100 h-100',
					'image_class' => 'object-fit-cover w-100 h-100'
				]); ?>
			</div>
		<?php elseif (!empty($data['static_image_filename'])): ?>
			<div class="position-absolute pe-none top-0 left-0 w-100 h-100 hero-title__background-image">
				<figure class="position-absolute top-0 left-0 w-100 h-100">
					<img class="object-fit-cover w-100 h-100" src="<?php echo get_theme_file_uri('static-assets/images/' . $data['static_image_filename']); ?>" alt="" width="<?php echo esc_attr($data['static_image_width']); ?>" height="<?php echo esc_attr($data['static_image_height']); ?>">
				</figure>
			</div>
		<?php endif; ?>
		<div class="position-relative hero-title__wrapper d-flex align-items-center justify-content-center min-vh-75 min-vh-md-100 pt-1 pb-1">
			<div class="container">
				<div class="hero-title__inner">
					<h1 class="m-0 mt-1 mt-md-1 text-white fw-bold hero-title__title text-wrap lh-sm display-5 display-md-3 display-lg-1">
						<?php echo wp_kses($data['title'], ['br' => []]); ?> </h1>
				</div>
			</div>
		</div>
	</div>
<?php endif;
