<?php

/**
 * Block: Baack to Top
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$_class = 'back-to-top';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<button class="<?php echo esc_attr($_class); ?> d-flex align-items-center justify-content-center bg-white position-fixed z-3" data-block="back-to-top">
	<div class="back-to-top__icon bg-blue-light"></div>
</button>
