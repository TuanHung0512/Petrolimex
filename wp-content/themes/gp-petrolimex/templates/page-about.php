<?php

/**
 * Template Name: Giới thiệu
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();
$about_banner_logo = get_field('about_banner_logo');
$about_banner_background = get_field('about_banner_background');
$about_banner_title = get_field('about_banner_title');
$about_banner_description = get_field('about_banner_description');
$about_banner_button_text = get_field('about_banner_button_text');
$about_banner_button_link = get_field('about_banner_button_link');
$about_items = get_field('about_items');
$achievements_background = get_field('achievements_background');
$background_award = get_field('background_award');
$achievements_title = get_field('achievements_title');
$achievements_description = get_field('achievements_description');
$achievements_items = get_field('achievements_items');
$achievements_note = get_field('achievements_note');
$achievements_redirect_text = get_field('achievements_redirect_text');
$achievements_redirect_link = get_field('achievements_redirect_link');
$_class = 'layout';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> layout--about">
	<?php get_template_part('templates/blocks/intro-banner', null, [
		'logo' => $about_banner_logo,
		'background' => $about_banner_background,
		'title' => $about_banner_title,
		'description' => $about_banner_description,
		'text_button' => $about_banner_button_text,
		'link_button' => $about_banner_button_link,
	]); ?>
	<?php get_template_part('templates/blocks/about-value', null, [
		'items' => $about_items
	]); ?>
	<?php get_template_part('templates/blocks/achievements-about', null, [
		'title' => $achievements_title,
		'description' => $achievements_description,
		'items' => $achievements_items,
		'note' => $achievements_note,
		'text_redirect' => $achievements_redirect_text,
		'link_redirect' => $achievements_redirect_link,
		'background' => $achievements_background,
		'background_award' => $background_award
	]); ?>
</div>
<?php get_footer();
