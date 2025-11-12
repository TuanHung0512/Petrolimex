<?php

/**
 * Block: Secrets Modal
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
	'content' => '',
	'id' => '',
	'class' => ''
]);
$_class = 'static-modal';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="h-100 left-0 <?php echo esc_attr($_class); ?> d-flex align-items-center justify-content-center top-0 w-100 bg-black z-3 bg-opacity-75 opacity-0" id="static-modal-<?php echo esc_attr($data['id']); ?>">
	<div class="modal-body px-1 py-2 p-md-2 mt-5 position-relative bg-white">
		<button type="button" class="btn-close position-absolute top-0 bg-black border-0 d-flex align-items-center justify-content-center z-1" data-bs-dismiss="modal" aria-label="Close">
			<?php echo gp_petrolimex_get_svg_icon('menu-close'); ?>
		</button>
		<div class="static-modal__content position-relative z-1 fs-16 text-start">
			<?php echo wp_kses_post($data['content']); ?>
		</div>
		<figure class="position-absolute bottom-0 h-auto z-0 left-0 w-100">

		</figure>
	</div>
</div>
