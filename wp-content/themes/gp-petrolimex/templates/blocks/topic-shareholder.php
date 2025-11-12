<?php

/**
 * Block: Topic Shareholder
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$current_id = get_the_ID();
$terms = get_the_terms($current_id, 'codong');
$related_query = null;
$_swiper_items = [];

if ($terms && !is_wp_error($terms)) {
    $term_ids = wp_list_pluck($terms, 'term_id');
    $related_query = new WP_Query([
        'post_type' => 'quan-he-co-dong',
        'posts_per_page' => 6,
        'post__not_in' => [$current_id],
        'tax_query' => [
            [
                'taxonomy' => 'codong',
                'field'    => 'term_id',
                'terms'    => $term_ids,
            ],
        ],
    ]);
    if ($related_query->have_posts()) {
        while ($related_query->have_posts()) {
            $related_query->the_post();
            ob_start();
            get_template_part('templates/blocks/shareholder-item');
            $item_html = ob_get_clean();
            $_swiper_items[] = [
                'content' => $item_html
            ];
        }
        wp_reset_postdata();
    }
}

$_class = 'topic-shareholder';
$_class .= !empty($data['class']) ? ' ' . $data['class'] : '';

?>
<div class="<?php echo esc_attr($_class); ?>" data-block="topic-shareholder">
    <div class="container">
        <h3 class="fs-24"><?php echo __('Articles on the same topic', 'gp-petrolimex') ?></h3>
		<div class="position-relative mb-5">
			<?php if (!empty($_swiper_items)) : ?>
				<div class="topic-shareholder__swiper px-2 px-lg-5">
					<?php
					get_template_part('templates/core-blocks/swiper', null, [
						'items' => $_swiper_items,
						'class' => 'topic-shareholder-swiper js-swiper',
						'settings' => [
							'pagination' => false,
							'prevNextButtons' => false,
						],
					]);
					?>
				</div>
				<div class="lh-1 button-topic-next position-absolute translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-flex align-items-center justify-content-center">></div>
				<div class="lh-1 button-topic-prev position-absolute translate-middle-y z-1 bg-body-secondary rounded-circle fs-22 cursor-pointer d-flex align-items-center justify-content-center"><</div>
			<?php endif; ?>
		</div>
    </div>
</div>
