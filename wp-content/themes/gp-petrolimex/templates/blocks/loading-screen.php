<?php
/**
 * Block: Loading Screen
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */


$_class = 'loading-screen w-100 h-100 top-0 start-0 bg-white d-block position-fixed';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?>" data-block="loading-screen">
    <div class="loading-screen__bottle position-absolute top-50 start-50 translate-middle overflow-hidden text-center">

    </div>
</div>
