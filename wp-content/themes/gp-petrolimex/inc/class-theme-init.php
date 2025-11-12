<?php

/**
 * Theme Init Class
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

namespace GPpetrolimex;

include_once get_theme_file_path('inc/helpers/env.php');
include_once get_theme_file_path('inc/helpers/cdn.php');
include_once get_theme_file_path('inc/helpers/queries.php');
include_once get_theme_file_path('inc/helpers/formatting.php');
include_once get_theme_file_path('inc/helpers/template-tags.php');
include_once get_theme_file_path('inc/helpers/debug.php');

class Theme_Init
{
	var $theme_version;
	var $theme_env;

	public function __construct()
	{
		$this->theme_version = WP_DEBUG ? time() : wp_get_theme()->Get('Version');
		$this->theme_env = ! gp_petrolimex_is_localhost() ? '.min' : '';

		add_action('wp_head', [$this, 'preconnect_google_fonts'], 1);

		add_action('wp_enqueue_scripts', [$this, 'critical_frontend_assets'], 1);
		add_action('wp_enqueue_scripts', [$this, 'register_frontend_assets'], 60);

		$this->register_layout_hooks();

		add_action('after_setup_theme', [$this, 'theme_supports']);

		// Remove ?ver from all assets
		add_filter('style_loader_src', [$this, 'remove_ver_from_assets'], 9999);
		add_filter('script_loader_src', [$this, 'remove_ver_from_assets'], 9999);

		// Disable gravity forms css
		add_filter('gform_disable_css', '__return_true');

		// Disable xmlrpc
		add_filter('xmlrpc_enabled', '__return_false');

		// Disable generate wp version
		add_filter('the_generator', '__return_empty_string');

		// Disable emoji
		add_action('init', [$this, 'disable_emojis']);

		add_filter('wp_nav_menu_args', [$this, 'filter_nav_menu_args']);
		add_filter('wp_nav_menu_objects', [$this, 'log_nav_menu_objects'], 10, 2);
		add_filter('wp_nav_menu_items', [$this, 'insert_logo_into_menu'], 10, 2);

		// Custom rewrites and links
		add_action('init', [$this, 'add_custom_rewrites']);
		add_filter('post_link', [$this, 'filter_post_permalink'], 10, 3);
	}

	function preconnect_google_fonts()
	{
?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Hurricane&display=swap" rel="stylesheet">
		<?php
	}

	/**
	 * Register critical frontend assets
	 */
	function critical_frontend_assets()
	{
		$variables_css_context = file_get_contents(get_theme_file_path('variables.css'));

		if (!empty($variables_css_context)) {
			wp_register_style('gp-petrolimex-variables', false);
			wp_enqueue_style('gp-petrolimex-variables', false);
			wp_add_inline_style('gp-petrolimex-variables', gp_petrolimex_format_css_variables($variables_css_context));
		}
	}

	function register_frontend_assets()
	{
		if (!gp_petrolimex_is_localhost()) {
			wp_enqueue_style('gp-petrolimex-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', [], $this->theme_version);
			wp_enqueue_style('gp-petrolimex-frontend', get_stylesheet_directory_uri() . '/assets/css/frontend.min.css', [], $this->theme_version);
		}

		wp_enqueue_script('gp-petrolimex-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap' . $this->theme_env . '.js', [], $this->theme_version);
		wp_enqueue_script('gp-petrolimex-frontend', get_stylesheet_directory_uri() . '/assets/js/frontend' . $this->theme_env . '.js', [], $this->theme_version);
	}

	function register_layout_hooks()
	{
		require_once get_theme_file_path('inc/layouts/archive.php');
		require_once get_theme_file_path('inc/layouts/singular.php');
	}

	function theme_supports()
	{
		load_theme_textdomain('gp-petrolimex', get_theme_file_path('languages'));

		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-logo');

		add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]);

		add_theme_support('automatic-feed-links');
		register_nav_menus([
			'primary-menu' => __('Primary Menu', 'gp-petrolimex'),
			'footer-menu'  => __('Footer Menu', 'gp-petrolimex'),
		]);

		add_filter('use_block_editor_for_post', '__return_false');
	}

	function remove_ver_from_assets($src)
	{
		if (WP_DEBUG) return $src;

		if (strpos($src, 'ver=') !== false) {
			$src = remove_query_arg('ver', $src);
		}

		return $src;
	}

	function disable_emojis()
	{
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

		add_filter('emoji_svg_url', '__return_false');
	}

	public function filter_nav_menu_args($args)
	{
		if (!empty($args['theme_location']) && $args['theme_location'] === 'primary-menu') {
			$args['post_type'] = '';
		}
		return $args;
	}

	public function log_nav_menu_objects($items, $args)
	{
		if (!empty($args->theme_location) && $args->theme_location === 'primary-menu') {
			error_log('Menu Items: ' . print_r($items, true));
		}
		return $items;
	}
	public function insert_logo_into_menu($items, $args)
	{
		if (empty($args->theme_location) || $args->theme_location !== 'primary-menu') {
			return $items;
		}

		$menu_items = explode('</li>', $items);
		$middle = floor((count($menu_items) - 1) / 2);

		$logo_id = get_field('logo_header', 'option');
		if ($logo_id) {
			ob_start();
		?>
			<li class="menu-item header__logo-item d-none d-lg-block d-flex align-items-center pe-none">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php get_template_part('templates/core-blocks/image', null, [
						'image_id'   => $logo_id,
						'image_size' => 'large',
						'lazyload'   => false,
						'class'      => 'header__logo-image',
					]); ?>
				</a>
			</li>
<?php
			$logo_html = ob_get_clean();
			array_splice($menu_items, $middle, 0, $logo_html);
		}

		return implode('</li>', $menu_items);
	}

	public function add_custom_rewrites()
	{
		// Pretty link for single posts: /tintuc-sukien/detail/slug
		add_rewrite_rule('^tintuc-sukien/detail/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
	}

	public function filter_post_permalink($permalink, $post, $leavename)
	{
		if (!is_object($post)) return $permalink;
		if ($post->post_type !== 'post') return $permalink;

		$postname = $leavename ? '%postname%' : $post->post_name;
		return home_url('/tintuc-sukien/detail/' . $postname . '/');
	}
}

new Theme_Init();
