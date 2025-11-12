<?php

/**
 * Single: Shareholder
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */
get_header();
$file__shareholder = get_field('file__shareholder');


$_class = 'single-shareholder';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> position-relative">
	<figure>
		<img class="image__img position-absolute top-0 w-100" src="<?php echo get_theme_file_uri('static-assets/images/bgsec1_prolist.png'); ?>" alt="" width="1600" height="280" loading="lazy">
	</figure>
	<div class="container position-relative z-1">
		<h1 class="fs-h2 lh-sm text-center m-auto single-shareholder__title pt-4"><?php the_title(); ?></h1>
		<div class="single-shareholder__date text-center fs-16 fw-semibold text-black-50 mt-1"><?php echo get_the_time('d/m/Y'); ?></div>
		<div class="row mt-2 border-bottom border-1 pb-2 mb-3 border-dark-subtle">
			<div class="col-md-2 mb-1 mb-md-0">
				<div class="single-shareholder__report d-flex flex-column text-black-50">
					<span class="fs-14 mb-1"><?php echo __('Download report', 'gp-petrolimex') ?></span>
					<a href="<?php echo esc_url($file__shareholder); ?>" class="d-flex align-items-center gap-1 text-uppercase text-decoration-none">
						<div class="single-shareholder__report-icon border border-3 rounded-2 d-flex align-items-center justify-content-center">
							<img width="15" height="15" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/static-assets/images/investment_down_ic.png'); ?>" alt="">
						</div>
						<span class="text-blue-light"><?php echo __('Download', 'gp-petrolimex') ?></span>
					</a>
				</div>
			</div>
			<div class="col-md-10">
				<div class="single-shareholder__content fs-16">
					<span><?php echo __('View detailed report: please click on the', 'gp-petrolimex') ?></span>
					"<a href="<?php echo esc_url($file__shareholder); ?>" class="text-decoration-none single-shareholder__link">
						<?php echo __('Download link', 'gp-petrolimex') ?>
					</a>".
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part('templates/blocks/topic-shareholder');?>

	<?php get_footer();
