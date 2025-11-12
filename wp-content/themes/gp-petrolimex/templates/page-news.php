<?php

/**
 * Template Name: Tin tức
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();

$section_title = get_field('latest_news_title');
$categories = get_field('categories');

$default_post_args = [
	'post_type' => 'post',
	'post_status' => 'publish',
	'fields' => 'ids',
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
	'no_found_rows' => true,
];

$two_up_post_ids = [];
$latest_post_ids = [];
$subnav_links = [];
$post_query= [];

if ( !empty( $categories ) ) :
	foreach( $categories as $index => $category_id ) {
		$category_object = get_term($category_id, 'category');
		$is_current_category = $index === 1;

		if ($is_current_category) {
			$post_args = wp_parse_args($default_post_args, [
				'posts_per_page' => 3,
				'category__in' => [$category_id]
			]);
		} else {
			$post_args = wp_parse_args($default_post_args, [
				'posts_per_page' => 1,
				'category__in' => [$category_id]
			]);
		}

		$posts = get_posts($post_args);

		if (!empty($posts)) {
			$two_up_post_ids[] = $posts[0];

			if ($is_current_category) {
				$latest_post_ids = $posts;
			}
		}

		$subnav_links[] = [
			'title' => $category_object->name,
			'url' => get_term_link($category_id, 'category'),
			'is_active' => $is_current_category
		];
	}
endif;

?>
<div class="layout layout--news">
	<?php

	get_template_part('templates/blocks/hero-title', null, [
		'class' => 'mb-2 mb-lg-4 hero-title--news-page',
		'title' => get_field('banner_title'),
		'static_image_filename' => 'bg-news.jpg',
		'static_image_width' => 1600,
		'static_image_height' => 380
	]);

	get_template_part('templates/blocks/two-up-posts', null, [
		'title' => $section_title,
		'post_ids' => $two_up_post_ids
	]);

	get_template_part('templates/blocks/subnav', null, [
		'items' => $subnav_links
	]);

	get_template_part('templates/blocks/post-grid', null, [
		'class' => 'mb-2',
		'post_ids' => $latest_post_ids
	]);

	?>
</div>
<?php get_footer();
