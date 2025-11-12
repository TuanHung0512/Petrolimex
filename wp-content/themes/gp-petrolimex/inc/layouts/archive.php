<?php

/**
 * GeneratePres Archive Layout Hooks
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

namespace GPpetrolimex;

class Archive_Layout
{
	public function __construct()
	{
		add_filter('template_include', [$this, 'template_include']);
		add_action('pre_get_posts', [$this, 'custom_query_pre_get_posts']);

		add_filter('post_type_link', [$this, 'custom_rewrite_post_type_link'], 10, 4);
		add_action('init', [$this, 'add_custom_rewrite_rules']);

		add_action('init', [$this, 'add_category_rewrite_rules']);
		add_filter('term_link', [$this, 'filter_category_term_link'], 10, 3);
		add_filter('get_pagenum_link', [$this, 'filter_category_pagenum_link'], 10, 2);
		add_filter('redirect_canonical', [$this, 'filter_canonical_for_category'], 10, 2);
	}
	public function template_include($template)
	{
		if (is_tax('codong')) {
			return get_theme_file_path('templates/archive-shareholder.php');
		}
		if (is_tax('biquyet')) {
			return get_theme_file_path('templates/archive-secrets.php');
		}
		if (is_category()) {
			return get_theme_file_path('templates/archive-post.php');
		}
		return $template;
	}

	function custom_query_pre_get_posts($query)
	{
		if ( is_admin() ) return;

		if ( is_tax('codong') && $query->is_main_query() ) {
			$query->set('posts_per_page', 9);
		}

		if ( is_category() && $query->is_main_query() ) {
			$query->set('posts_per_page', 3);
		}
	}

	public function custom_rewrite_post_type_link($post_link, $post) {
        if ('quan-he-co-dong' === $post->post_type) {
            $terms = get_the_terms($post->ID, 'codong');

            if (!empty($terms) && !is_wp_error($terms)) {
                $term = array_shift($terms);

                $post_link = str_replace('%postname%', $post->post_name, $post_link);
                $post_link = str_replace('quan-he-co-dong', 'codong/chi-tiet/' . $term->slug, $post_link);
            }
        }
        return $post_link;
    }

    public function add_custom_rewrite_rules() {
        add_rewrite_rule(
            '^codong/chi-tiet/([^/]+)/([^/]+)/?$',
            'index.php?quan-he-co-dong=$matches[2]',
            'top'
        );
    }

	public function add_category_rewrite_rules() {
		add_rewrite_rule('^tintuc-sukien\/(?!detail\/)(.+)\/([0-9]+)\/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
		add_rewrite_rule('^tintuc-sukien\/(?!detail\/)(.+)\/page\/([0-9]+)\/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
		add_rewrite_rule('^tintuc-sukien\/(?!detail\/)(.+)\/?$', 'index.php?category_name=$matches[1]', 'top');
	}

	public function filter_category_term_link($termlink, $term, $taxonomy) {
		if ($taxonomy !== 'category') return $termlink;

		$ancestors = array_reverse(get_ancestors($term->term_id, 'category'));
		$slugs = [];
		foreach ($ancestors as $ancestor_id) {
			$ancestor = get_term($ancestor_id, 'category');
			if ($ancestor && !is_wp_error($ancestor)) {
				$slugs[] = $ancestor->slug;
			}
		}
		$slugs[] = $term->slug;
		$path = implode('/', $slugs);

		return home_url('/tintuc-sukien/' . $path . '/');
	}

	public function filter_category_pagenum_link($result, $pagenum) {
		if (!is_category()) return $result;
		if ($pagenum < 2) return $result;
		if (strpos($result, '/tintuc-sukien/') !== false) {
			$result = preg_replace('#/tintuc-sukien/(?!detail/)(.+)/page/([0-9]+)/?$#', '/tintuc-sukien/$1/$2/', $result);
			$result = preg_replace('#/tintuc-sukien/(?!detail/)(.+)/([0-9]+)/([0-9]+)/?$#', '/tintuc-sukien/$1/$3/', $result);
		}
		return $result;
	}

	public function filter_canonical_for_category($redirect_url, $requested_url) {
		if (!is_category()) return $redirect_url;
		if (strpos($requested_url, '/tintuc-sukien/') !== false) {
			if ($redirect_url && preg_match('#/tintuc-sukien/(?!detail/)(.+)/page/([0-9]+)/?$#', $redirect_url)) {
				return false;
			}
			if ($requested_url && preg_match('#/tintuc-sukien/(?!detail/)(.+)/page/([0-9]+)/?$#', $requested_url, $m)) {
				return home_url('/tintuc-sukien/' . $m[1] . '/' . $m[2] . '/');
			}
		}
		return $redirect_url;
	}
}

new Archive_Layout();
