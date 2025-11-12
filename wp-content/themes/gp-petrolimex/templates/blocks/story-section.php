<?php

/**
 * Block: Story Section
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */


$banner_title = get_field('banner_title');
$banner_sub_title = get_field('banner_sub_title');
$banner_description = get_field('banner_description');
$banner_text_more = get_field('banner_view_more_text');

$hidden_description = get_field('hidden_description');

$discovery_title = get_field('discovery_title');
$discovery_sub_title = get_field('discovery_sub_title');
$discovery_button_text = get_field('discovery_button_text');
$discovery_button_url = get_field('discovery_button_url');

?>
<div class="story-section" data-block="story-section">
	<div class="w-100 position-relative story-section__screen story-section__screen--1">
		<?php
		get_template_part('templates/core-blocks/responsive-static-image', null, [
			'static_mobile_filename' => 'bg-story-1-mobile.jpg',
			'static_pc_filename' => 'bg-story-1-pc.jpg',
			'breakpoint' => 800,
			'lazyload' => false,
			'image_class' => 'position-absolute top-0 start-0 w-100 h-100 object-fit-cover',
			'class' => 'position-absolute z-1 top-0 start-0 w-100 h-100 story-section__background-image pe-none'
		]);
		?>
		<div class="position-relative z-2 w-100 story-section__wrapper pt-5 pt-md-0">
			<div class="container">
				<div class="text-center story-section__inner">
					<h1 class="h2 text-uppercase fw-bold font-title mb-0 story-section__title"><?php echo wp_kses_post($banner_title); ?></h1>
					<div class=" font-subtitle story-section__subtitle fw-bold"><?php echo esc_html($banner_sub_title); ?></div>
					<div class="mt-1 mx-auto story-section__description"><?php echo esc_html($banner_description); ?></div>
					<div class="mt-1 text-center story-section__footer">
						<p class="mb-1">
							<span class="w-100 mb-1 text-blue-light story-section__view-more-text"><?php echo esc_html($banner_text_more); ?></span>
						</p>
						<div>
							<button class="border-0 rounded-circle bg-primary d-inline-flex align-items-center justify-content-center story-section__view-more-button overflow-visible position-relative js-view-more-trigger" aria-label="<?php esc_attr_e('View more description', 'gp-petrolimex'); ?>">
								<span class="icon d-inline-flex align-items-center justify-content-center text-white pe-none position-relative z-2"><?php echo gp_petrolimex_get_svg_icon('plus'); ?></span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w-100 position-relative story-section__screen story-section__screen--2 z-2 story-section__screen--hidden js-hidden-screen">

		<div class="position-relative z-2 story-section__wrapper overflow-hidden">
			<div class="container">
				<div class="story-section__hidden-content-wrap">
					<div class="py-2 py-lg-4 text-center story-section__hidden-content">
						<div class="mb-2 mb-lg-2">
							<button class="border-0 rounded-circle d-inline-flex align-items-center justify-content-center story-section__close-button js-view-more-trigger cursor-pointer fs-4 lh-1 translate-middle-x mx-auto overflow-visible" aria-label="<?php esc_attr_e('Close description', 'gp-petrolimex'); ?>">
								<span class="icon d-flex align-items-center justify-content-center text-white pe-none position-relative z-2"><?php echo gp_petrolimex_get_svg_icon('plus'); ?></span>
							</button>
						</div>
						<div class="story-section__inner">
							<div class="small text-white story-section__hidden-description w-100 lh-base mx-auto py-md-1 fs-md-5 col-md-10 col-lg-8"><?php echo wp_kses_post($hidden_description); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w-100 position-relative story-section__screen story-section__screen--3 z-3">
		<?php
		get_template_part('templates/core-blocks/responsive-static-image', null, [
			'static_mobile_filename' => 'bg-story-3-mobile.jpg',
			'static_pc_filename' => 'bg-story-3-pc.jpg',
			'breakpoint' => 800,
			'lazyload' => true,
			'image_class' => 'position-absolute top-0 start-0 w-100 h-100 object-fit-cover',
			'class' => 'position-absolute z-1 top-0 start-0 w-100 h-100 story-section__background-image'
		]);
		?>
		<div class="position-relative z-2 story-section__wrapper min-vh-100 d-flex align-items-center">
			<div class="container">
				<div class="text-center py-4 story-section__inner">
					<h2 class="m-0 text-white text-uppercase fw-bold lh-1 display-5 display-md-6 display-lg-4 story-section__title">
						<?php echo wp_kses_post($discovery_title); ?>
					</h2>
					<div class="text-white font-subtitle fs-5 fs-md-4 story-section__subtitle fw-bold">
						<?php echo esc_html($discovery_sub_title); ?>
					</div>
					<div class="mt-1 d-flex flex-column justify-content-center story-section__footer">
						<?php get_template_part('templates/core-blocks/button', null, [
							'button_text' => $discovery_button_text,
							'button_url'  => $discovery_button_url,
							'type' => 'primary',
							'class' => 'bg-blue fw-bold d-inline-flex mx-auto rounded-0 story-section__button'
						]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
