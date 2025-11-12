<?php
/**
 * Block: Banner half
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'title' => '',
	'background' => '',
]);
$_class = 'banner-half';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100 position-relative">
    <?php
        get_template_part('templates/core-blocks/image', null, [
            'image_id' => $data['background'],
            'image_size' => 'large',
            'lazyload' => true,
            'class' => 'banner-half--background',
            'image_class' => 'w-100 h-100 object-fit-cover',
        ]);
    ?>
    <div class="banner-half__title position-absolute w-100 top-50 start-50 translate-middle text-center text-uppercase fw-bold text-white z-1 pt-2">
        <?php echo wpautop(wp_kses_post($data['title'])); ?>
    </div>
</div>
