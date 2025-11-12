<?php
/**
 * Block: Hotline Modal
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.1.1
 */


$title = get_field('hotline_modal_title', 'options');
$sub_title = get_field('hotline_modal_sub_title', 'options');
$button_text = get_field('hotline_modal_button_text', 'options');
$button_url = get_field('hotline_modal_button_url', 'options');
?>

<div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 pe-none hotline-modal" data-block="hotline-modal">
	<div class="position-fixed top-0 start-0 w-100 h-100 z-1 hotline-modal__overlay js-close-hotline-modal"></div>
	<div class="position-relative z-2 bg-white text-center shadow p-2 px-4 px-lg-4 rounded-4 overflow-hidden hotline-modal__wrapper">
		<p class="h5 fw-bold hotline-modal__title"><?php echo esc_html( $title ); ?></p>
		<p class="small fw-semibold h6 hotline-modal__sub-title"><?php echo esc_html( $sub_title ); ?></p>
		<div class="d-flex align-items-center justify-content-center gap-1 hotline-modal__buttons">
			<?php get_template_part('templates/core-blocks/button', null, [
				'button_text' => $button_text,
				'button_url'  => $button_url,
				'type' => 'success',
				'class' => 'text-white rounded-4 overflow-hidden fw-bold hotline-modal__button hotline-modal__button--success',
			]); ?>
			<?php get_template_part('templates/core-blocks/button', null, [
				'button_text' => __('Cancel', 'gp-petrolimex'),
				'type' => 'danger',
				'class' => 'text-white rounded-4 overflow-hidden fw-bold hotline-modal__button hotline-modal__button--danger js-close-hotline-modal',
			]); ?>
		</div>
	</div>
</div>
