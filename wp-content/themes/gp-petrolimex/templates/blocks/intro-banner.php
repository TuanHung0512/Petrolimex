<?php

/**
 * Block: Intro Banner
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'logo' => '',
	'background' => '',
	'title' => '',
	'description' => '',
	'text_button' => '',
	'link_button' => '',
]);
$_class = 'intro-banner';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> w-100 position-relative">
	<?php
	get_template_part('templates/core-blocks/image', null, [
		'image_id' => $data['background'],
		'image_size' => 'large',
		'lazyload' => true,
		'class' => 'intro-banner__background h-100',
		'image_class' => 'object-fit-cover w-100 h-100',
	]);
	?>
	<div class="intro-banner__content w-100 px-1 mt-5 mt-md-0 position-absolute top-50 start-50 translate-middle text-center text-white mx-auto ">
		<?php
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $data['logo'],
			'image_size' => 'large',
			'lazyload' => true,
			'class' => 'intro-banner__logo',
			'image_class' => 'object-fit-contain w-100 h-auto',
		]);
		?>
		<h1 class="intro-banner__title fw-bold mt-1 text-uppercase mb-0">
			<?php echo esc_html($data['title']) ?>
		</h1>
		<article class="intro-banner__description fw-bold m-0 text-white mx-auto mw-100 lh-base">
			<?php echo wp_kses_post($data['description']) ?>
		</article>
		<a href="<?php echo esc_url($data['link_button']) ?>" class="text-decoration-none px-3 py-1 fw-bold fs-18 btn__primary bg-blue text-white m-auto mb-1 d-block intro-banner__button ">
			<span><?php echo esc_html($data['text_button']) ?></span>
		</a>
	</div>
</div>
