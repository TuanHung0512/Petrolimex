<?php

/** Block: Benefit Card
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'post_id' => ''
]);

$_class = 'position-relative benefit-card';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$post_title = get_the_title($data['post_id']);

?>

<div class="<?php echo esc_attr($_class); ?>">
	<?php get_template_part('templates/core-blocks/image', null, [
		'image_id' => get_post_thumbnail_id($data['post_id']),
		'image_size' => 'full',
		'class' => 'z-1 ratio ratio-1x1 image--cover benefit-card__image',
		'lazyload' => false
	]); ?>
	<div class="benefit-card__overlay position-absolute z-2 w-100 h-100"></div>
	<div class="position-absolute w-100 h-100 d-flex justify-content-start z-3 benefit-card__wrapper">
		<p class="fs-16 m-0 benefit-card__title fw-bold text-white benefit-card w-100 text-start text-sm-center" style="text-decoration: none;"><?php echo esc_html($post_title); ?></p>
	</div>
	<button type="button" class="static-modal-<?php echo esc_attr($data['post_id']); ?> border-0 bg-transparent benefit-card__overlay-link position-absolute z-3 w-100 h-100" title="<?php echo esc_attr($post_title); ?>"></button>

	<?php
	get_template_part('templates/blocks/static-modal', null, [
		'content' => apply_filters('the_content', get_post_field('post_content', $data['post_id'])),
		'id' => $data['post_id'],
		'class' => 'position-fixed'
	]);
	?>
</div>
