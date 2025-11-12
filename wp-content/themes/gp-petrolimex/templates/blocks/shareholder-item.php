<?php

/**
 * Block: Shareholder Items
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$_class = 'position-relative d-flex flex-column justify-content-between shareholder-item bg-white h-100';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$terms = get_the_terms(get_the_ID(), 'codong');
$term_names_array = !empty($terms) && !is_wp_error($terms) ? wp_list_pluck($terms, 'name') : [];
$term_names = !empty($term_names_array) ? implode(', ', $term_names_array) : '';

?>

<div class="<?php echo esc_attr($_class); ?>">
	<div class="flex-grow-1 d-flex flex-column p-1 shareholder-item__wrapper">
		<div class="shareholder-item__content">
			<p class="shareholder-item__category mb-2 fw-bold text-uppercase fs-12">
				<?php echo esc_html($term_names); ?>
			</p>
			<h3 class="fs-18 shareholder-item__title"><?php the_title(); ?></h3>
		</div>
		<div class="w-100 mt-auto shareholder-item__info d-flex align-items-center justify-content-between">
			<div class="shareholder-item__date fs-12 text-light-emphasis"><?php echo esc_html(get_the_time('d/m/Y')); ?></div>
			<div class="shareholder-item__icon d-flex align-items-center justify-content-center rounded-circle">
				<img loading="lazy" width="16" height="16" src="<?php echo esc_url_raw(get_theme_file_uri('static-assets/images/investment_down_ic.png')); ?>" alt="">
			</div>
		</div>
	</div>
	<a class="shareholder-item__overlay-link position-absolute top-0 left-0 w-100 h-100 z-2 text-decoration-none" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
</div>
