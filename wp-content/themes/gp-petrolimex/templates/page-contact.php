<?php

/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */
get_header();

?>
<div class="w-100 layout layout--contact">
	<?php
	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'mb-2 mb-lg-4',
		'title' => get_field('hero_title'),
		'static_image_filename' => 'bg-contact.jpg',
		'static_image_width' => 1600,
		'static_image_height' => 340
	]);

	get_template_part('templates/blocks/agency-list', null, [
		'class' => 'position-relative z-2 agency-list--contact-page',
		'title' => get_field('agency_title'),
		'items' => get_field('agency_items'),
	]);

	get_template_part('templates/blocks/cta-section', null, [
		'class' => 'position-relative z-1 pt-4 pt-lg-6',
		'title' => get_field('cta_title'),
		'description' => get_field('cta_description')
	]);

	?>
</div>

<?php get_footer();
