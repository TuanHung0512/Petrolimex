<?php

/**
 * Block: Progress legendary
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
    'items' => [],
    'id' => ''
]);

$_class = 'progress-legendary';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> position-relative vh-100 w-100" data-block="static-modal">
    <?php
    get_template_part('templates/core-blocks/image', null, [
        'image_id' => $data['items']['background_image'],
        'image_size' => 'large',
        'lazyload' => true,
        'class' => 'progress-legendary__background position-absolute top-0 start-0 w-100 h-100',
        'image_class' => 'w-100 h-100 object-fit-cover',
    ]);
    ?>
    <div class="progress-legendary__content w-100 d-flex flex-column align-items-center justify-content-center d-md-block p-1 position-absolute h-100 translate-middle-x start-50">
        <h2 class="progress-legendary__title lh-sm text-center" style="color: <?php echo esc_attr($data['items']['color_text']); ?>">
            <?php echo esc_html($data['items']['title']); ?>
        </h2>
        <div class="progress-legendary__subtitle h5 text-center text-uppercase" style="color: <?php echo esc_attr($data['items']['color_text']); ?>">
            <?php echo esc_html($data['items']['sub_title']); ?>
        </div>
        <?php if (!empty($data['items']['button_text'])) : ?>
            <button class="static-modal-<?php echo esc_attr($data['id']); ?> mb-0 progress-legendary__button m-auto d-block mt-1 fw-bold text-white border-0 bg-blue px-2 py-1 fs-18 lh-1">
                <?php echo esc_html($data['items']['button_text']); ?>
            </button>
        <?php endif; ?>
        <?php
        get_template_part('templates/blocks/static-modal', null, [
            'content' => $data['items']['description'],
            'id' => $data['id'],
            'class' => 'position-absolute',
        ]);
        ?>
    </div>
</div>
