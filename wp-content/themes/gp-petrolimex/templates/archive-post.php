<?php
/**
 * Post Archive Template
 *
 * @package gp-petrolimex
 * @since 1.9.0
 */

get_header();
global $wp_query;

$banner_title = __('News and Events', 'gp-petrolimex');
$current_term = get_queried_object();

$news_page = get_pages([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'templates/page-news.php',
    'number'     => 1
]);

$page_id       = !empty($news_page) ? $news_page[0]->ID : null;
$section_title = !empty($page_id) ? get_field('latest_news_title', $page_id) : '';
$categories    = !empty($page_id) ? get_field('categories', $page_id) : [];

$default_post_args = [
    'post_type'              => 'post',
    'post_status'            => 'publish',
    'fields'                 => 'ids',
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
    'no_found_rows'          => true,
];

$two_up_post_ids = [];

if ( !empty( $categories ) ) :
	foreach( $categories as $index => $category_id ) {
		$category_object = get_term($category_id, 'category');
		$is_current_category = $current_term->term_id === $category_id;

		if ($is_current_category) {
			$two_up_post_args = wp_parse_args($default_post_args, [
				'posts_per_page' => 3,
				'category__in' => [$category_id]
			]);
		} else {
			$two_up_post_args = wp_parse_args($default_post_args, [
				'posts_per_page' => 1,
				'category__in' => [$category_id]
			]);
		}

		$two_up_posts = get_posts($two_up_post_args);

		if (!empty($two_up_posts)) {
			$two_up_post_ids[] = $two_up_posts[0];
		}

		$subnav_links[] = [
			'title' => $category_object->name,
			'url' => get_term_link($category_id),
			'is_active' => $is_current_category
		];
	}
endif;

?>
<div class="w-100 layout layout--category">
    <?php
    get_template_part('templates/blocks/hero-title', null, [
        'class'                 => 'hero-title--secrets-page mb-2 mb-lg-4',
        'title'                 => $banner_title,
        'static_image_filename' => 'bannertip.jpg',
        'static_image_width'    => 1600,
        'static_image_height'   => 340
    ]);

    get_template_part('templates/blocks/two-up-posts', null, [
        'title'    => $section_title,
        'post_ids' => $two_up_post_ids
    ]);

    get_template_part('templates/blocks/subnav', null, [
        'items' => $subnav_links
    ]);

    get_template_part('templates/blocks/post-grid', null, [
		'class' => '',
        'post_ids' => $wp_query->posts
    ]);

	if ($wp_query->max_num_pages > 1) :
		get_template_part('templates/blocks/pagination', null, [
			'class' => 'mb-2 mb-lg-4',
			'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
			'post_query' => $wp_query,
		]);
	endif;

    ?>
</div>
<?php get_footer(); ?>
