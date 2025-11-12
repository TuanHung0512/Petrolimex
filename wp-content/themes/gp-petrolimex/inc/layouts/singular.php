<?php

/**
 * GeneratePres Archive Layout Hooks
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

namespace GPpetrolimex;

class Singular_Layout
{
	public function __construct()
	{
		add_filter('template_include', [$this, 'template_include']);

		add_filter('post_type_link', [$this, 'custom_rewrite_post_type_link'], 10, 4);
		add_action('init', [$this, 'add_custom_rewrite_rules']);
	}

	public function template_include($template)
	{
		if (is_singular('quan-he-co-dong')) {
			return get_theme_file_path('templates/single-shareholder.php');
		}

		if (is_singular('post')) {
			return get_theme_file_path('templates/single-post.php');
		}
		return $template;
	}

	public function custom_rewrite_post_type_link($post_link, $post)
	{
		if ('post' === $post->post_type) {
			$terms = get_the_terms($post->ID, 'category');

			if (!empty($terms) && !is_wp_error($terms)) {
				$term = array_shift($terms);

				$post_link = str_replace('%postname%', $post->post_name, $post_link);
				$post_link = str_replace('post', 'tintuc-sukien/detail/' . $term->slug, $post_link);
			}
		}
		return $post_link;
	}

	public function add_custom_rewrite_rules()
	{
		add_rewrite_rule(
			'^tintuc-sukien/detail/([^/]+)/([^/]+)/?$',
			'index.php?post=$matches[2]',
			'top'
		);
	}
}
new Singular_Layout();
