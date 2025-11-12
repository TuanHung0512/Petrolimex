<?php

/**
 * Flexible Content
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
if (have_rows('sections')) {
	while (have_rows('sections')):
		the_row();
		$layout = get_row_layout();

		switch ($layout):
			case 'intro_banner':
				$data = gp_petrolimex_get_flexible_content_data([
					'logo' => 'logo',
					'background' => 'background',
					'title' => 'title',
					'description' => 'description',
					'text_button' => 'text_button',
					'link_button' => 'link_button',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/intro-banner', null, $data);
				break;
			case 'about_value':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'description' => 'description',
					'slogan' => 'slogan',
					'background' => 'background',
					'text_button' => 'text_button',
					'link_button' => 'link_button',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/about-value', null, $data);
				break;
			case 'banner_slide':
				$data = gp_petrolimex_get_flexible_content_data([
					'list_slide' => 'list_slide',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/banner-slide', null, $data);
				break;
			case 'development_history':
				$data = gp_petrolimex_get_flexible_content_data([
					'background' => 'background',
					'image' => 'image',
					'title' => 'title',
					'description' => 'description',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/development-history', null, $data);
				break;
			case 'banner_half':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'background' => 'background',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/banner-half', null, $data);
				break;
			case 'brand_intro':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'background' => 'background',
					'description' => 'description',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/brand-intro', null, $data);
				break;
			case 'history_formed':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'background' => 'background',
					'description' => 'description',
					'icon' => 'icon',
					'history' => 'history',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/history-formed', null, $data);
				break;
			case 'mineral_secrets_by_category':
				$data = gp_petrolimex_get_flexible_content_data([
					'select_the_categories_tab' => 'select_the_categories_tab',
				]);
				$data['id'] = '';
				$data['class'] = '';
				$term_ids = isset($data['select_the_categories_tab']) && is_array($data['select_the_categories_tab'])
					? $data['select_the_categories_tab']
					: [];
				$term_names = [];
				$term_objects = [];
				$term_urls = [];
				foreach ($term_ids as $term_id) {
					$term = get_term($term_id, 'biquyet');
					if (!is_wp_error($term) && $term !== null) {
						$term_names[] = $term->name;
						$term_objects[] = $term;
						$term_url = get_term_link($term, 'biquyet');
					} else {
						error_log('Lỗi khi lấy term ID ' . $term_id . ': ' . (is_wp_error($term) ? $term->get_error_message() : 'Term không tồn tại'));
					}
				}
				$data['term_names'] = $term_names;
				$data['term_objects'] = $term_objects;
				$data['term_urls'] = $term_urls;

				$args = array(
					'post_type' => 'biquyetcuakhoang',
					'posts_per_page' => -1,
					'post_status' => 'publish',
				);
				$biquyetcuakhoang_posts = new WP_Query($args);

				$posts_data = [];
				if ($biquyetcuakhoang_posts->have_posts()) {
					while ($biquyetcuakhoang_posts->have_posts()) {
						$biquyetcuakhoang_posts->the_post();
						$posts_data[] = array(
							'id' => get_the_ID(),
							'title' => get_the_title(),
							// 'permalink' => get_permalink(),
							'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'), // Lấy URL của ảnh thumbnail
							// 'excerpt' => get_the_excerpt(),
						);
					}
					wp_reset_postdata();
				}
				$data['biquyetcuakhoang_posts'] = $posts_data;
				get_template_part('templates/blocks/category-tips', null, $data);
				break;
			case 'product_by_category':
				$data = gp_petrolimex_get_flexible_content_data([
					'background_color' => 'background_color',
					'category_product' => 'category_product',
					'hidden_letters' => 'hidden_letters'
				]);
				$data['id'] = '';
				$data['class'] = '';
				$term_ids = isset($data['category_product']) && is_array($data['category_product'])
					? $data['category_product']
					: [];
				$term_names = [];
				$term_objects = [];
				$term_urls = [];
				foreach ($term_ids as $term_id) {
					$term = get_term($term_id, 'category-product');
					if (!is_wp_error($term) && $term !== null) {
						$term_names[] = $term->name;
						$term_objects[] = $term;
						$term_url = get_term_link($term, 'category-product');
					} else {
						error_log('Lỗi khi lấy term ID ' . $term_id . ': ' . (is_wp_error($term) ? $term->get_error_message() : 'Term không tồn tại'));
					}
				}
				$data['term_names'] = $term_names;
				$data['term_objects'] = $term_objects;
				$data['term_urls'] = $term_urls;
				$args = array(
					'post_type' => 'san-pham',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'tax_query' => array(
						array(
							'taxonomy' => 'category-product',
							'field'    => 'term_id',
							'terms'    => $term_id,
						),
					),
				);
				$prod_data = new WP_Query($args);

				$posts_data = [];
				if ($prod_data->have_posts()) {
					while ($prod_data->have_posts()) {
						$prod_data->the_post();
						$posts_data[] = array(
							'id' => get_the_ID(),
							'title' => get_the_title(),
							// 'permalink' => get_permalink(),
							'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
							// 'excerpt' => get_the_excerpt(),
							'description' => get_the_content(),
							'water_volume' => get_field('water_volume')
						);
					}
					wp_reset_postdata();
				}
				$data['prod_data'] = $posts_data;
				get_template_part('templates/blocks/category-prod', null, $data);
				break;
			case 'gallery_benefits':
				$data = gp_petrolimex_get_flexible_content_data([
					'caption_box' => 'caption_box',
					'list_choose_benefits' => 'list_choose_benefits',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/gallery-benefits', null, $data);
				break;
			case 'choose_show_product':
				$args = array(
					'post_type' => 'san-pham',
					'posts_per_page' => -1,
					'post_status' => 'publish',
				);
				$prod_data = new WP_Query($args);
				$posts_data = [];
				if ($prod_data->have_posts()) {
					while ($prod_data->have_posts()) {
						$prod_data->the_post();
						$posts_data[] = array(
							'id' => get_the_ID(),
							'title' => get_the_title(),
							'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
							'description' => get_the_content(),
							'water_volume' => get_field('water_volume')
						);
					}
					wp_reset_postdata();
				}

				$data = gp_petrolimex_get_flexible_content_data([
					'choose_product' => 'choose_product',
					'text_redirect' => 'text_redirect',
					'link_redirect' => 'link_redirect',
					'text_see_more' => 'text_see_more',
					'hidden_letters' => 'hidden_letters'
				]);

				$selected_products = [];
				$choose_product = $data['choose_product'];

				if (!empty($choose_product)) {
					if (is_array($choose_product)) {
						foreach ($posts_data as $product) {
							if (in_array($product['id'], $choose_product)) {
								$selected_products[] = $product;
							}
						}
					} else {
						foreach ($posts_data as $product) {
							if ($product['id'] == $choose_product) {
								$selected_products[] = $product;
								break;
							}
						}
					}
				}

				$data['prod_data'] = $posts_data;
				$data['selected_products'] = $selected_products;
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/choose-show-product', null, $data);
				break;
			case 'list_agency':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'items' => 'items',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/list-agency', null, $data);
				break;
			case 'achievements_about':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'description' => 'description',
					'items' => 'items',
					'note' => 'note',
					'text_redirect' => 'text_redirect',
					'link_redirect' => 'link_redirect',
					'background' => 'background',
					'background_award' => 'background_award'
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/achievements-about', null, $data);
				break;
			case 'maps':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'sub_title' => 'sub_title',
					'phone' => 'phone',
					'map_url' => 'map_url',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/maps', null, $data);
				break;
			case 'last_news':
				$data = gp_petrolimex_get_flexible_content_data([
					'title' => 'title',
					'news_items' => 'news_items',
				]);
				$data['id'] = '';
				$data['class'] = '';
				get_template_part('templates/blocks/last-news', null, $data);
				break;

		endswitch;
	endwhile;
}
