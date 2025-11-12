<?php

/**
 * Block: Banner legendary
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
    'background' => '',
    'title' => '',
    'image' => '',
    'note' => '',
]);

$_class = 'banner-legendary';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> position-relative vh-100 w-100">
    <?php
    get_template_part('templates/core-blocks/image', null, [
        'image_id' => $data['background'],
        'image_size' => 'large',
        'lazyload' => true,
        'class' => 'banner-legendary__background position-absolute top-0 start-0 w-100 h-100',
        'image_class' => 'w-100 h-100 object-fit-cover',
    ]);
    ?>
    <div class="banner-legendary__content position-absolute top-50 start-50 translate-middle w-75">
        <h1 class="h2 banner-legendary__title fw-bold text-white text-center">
            <?php echo esc_html($data['title']); ?>
        </h1>
        <?php
        get_template_part('templates/core-blocks/image', null, [
            'image_id' => $data['image'],
            'image_size' => 'large',
            'lazyload' => true,
            'class' => 'banner-legendary__image',
            'image_class' => 'm-auto d-block mb-1 mb-md-2 h-auto',
        ]);
        ?>
        <div class="banner-legendary__note fw-bold fs-14 d-flex flex-column align-items-center justify-content-center">
            <div class="banner-legendary__note-icon d-none d-md-flex align-items-center justify-content-center border border-3 border-dark rounded-5">
                <img src="<?php echo get_theme_file_uri('static-assets/images/arrow-down.png'); ?>" width="8" height="16" loading="lazy">
            </div>
            <span><?php echo esc_html($data['note']); ?></span>
        </div>
    </div>
</div>
