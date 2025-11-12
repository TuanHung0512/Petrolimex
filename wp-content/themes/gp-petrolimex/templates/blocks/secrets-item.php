<?php

/**
 * Block: Secrets Items
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$_class = 'secrets-item';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> h-100 overflow-hidden" data-block="static-modal">
	<button type="button" class="static-modal-<?php the_ID(); ?> h-100 position-relative bg-white d-flex flex-column p-0 border text-decoration-none rounded-2 overflow-hidden">
		<?php
		$thumbnail_id = get_post_thumbnail_id(get_the_ID());
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $thumbnail_id,
			'image_size' => 'large',
			'lazyload' => true,
			'class' => 'secrets-item__image',
			'image_class' => 'w-100 object-fit-cover ratio-1x1 ratio',
		]);
		?>
		<h3 class="fs-16 text-start text-uppercase secrets-item__title mb-0  p-1"><?php the_title(); ?></h3>
	</button>
	<?php
	get_template_part('templates/blocks/static-modal', null, [
		'content' => get_the_content(),
		'id' => get_the_ID(),
		'class' => 'position-fixed'
	]);
	?>
</div>
