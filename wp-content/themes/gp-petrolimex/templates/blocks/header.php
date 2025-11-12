<?php

/**
 * Block: Header
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'logo_header' => get_field('logo_header', 'option'),
	'contact_text' => get_field('contact_text', 'option'),
	'contact_url' => get_field('contact_url', 'option'),
	'hotline_text' => get_field('hotline_text', 'option'),
	'hotline_url' => get_field('hotline_url', 'option'),
	'button_text' => get_field('button_text', 'option'),
	'button_image' => get_field('button_image', 'option'),
]);
$_class = 'position-fixed header';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

if (
	is_page_template('templates/page-contact.php') ||
	is_page_template('templates/page-news.php') ||
	is_page_template('templates/page-legendary.php') ||
	is_page_template('templates/page-history.php') ||
	is_page_template('templates/page-secret.php') ||
	is_page_template('templates/page-about.php') ||
	is_tax('biquyet') ||
	is_post_type_archive('shareholder') ||
	is_tax('codong')
) {
	$_class .= ' header--light-theme';
}

?>

<header class="<?php echo esc_attr($_class); ?> top-0 w-100" data-block="header">
	<?php
	get_template_part('templates/blocks/loading-screen');
	get_template_part('templates/blocks/header-topbar');
	?>
	<div class="header__content">
		<div class="header__logo d-block d-lg-none text-center">
			<?php if (!empty($data['logo_header'])): ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php
					get_template_part('templates/core-blocks/image', null, [
						'image_id' => $data['logo_header'],
						'image_size' => 'large',
						'lazyload' => true,
						'class' => 'header__logo-image',
						'image_class' => 'h-auto'
					]);
					?>
				</a>
			<?php endif; ?>
		</div>
		<div class="header__bottom d-none d-lg-flex justify-content-between align-items-center">
			<div class="container">
				<div class="header__bottom-menu pt-1 pt-lg-0 flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center d-flex">
					<div class="header__bottom-primary">
						<?php wp_nav_menu([
							'theme_location' => 'primary-menu',
							'container' => false,
							'menu_class' => 'list-unstyled m-0 p-0 d-flex align-items-center header__menu fw-bold fs-14 justify-content-center'
						]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
