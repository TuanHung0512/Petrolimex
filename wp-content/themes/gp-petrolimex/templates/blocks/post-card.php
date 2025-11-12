<?php
/**
 * Block: Post Card Overlay
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'post_id' => ''
]);

$_class = 'd-flex flex-column post-card';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$post_thumbnail_id = get_post_thumbnail_id($data['post_id']);

?>

<article class="<?php echo esc_attr( $_class ); ?>">
	<div class="position-relative post-card__wrapper d-flex flex-column flex-grow-1 pb-2 overflow-hidden">
		<?php
		if ( !empty($post_thumbnail_id)) :
			get_template_part('templates/core-blocks/image', null, [
				'image_id' => $post_thumbnail_id,
				'image_size' => 'large',
				'lazyload' => true,
				'class' => 'image--cover ratio ratio-16x9 post-card__background-image z-1',
			]);
		else :
			get_template_part('templates/core-blocks/responsive-static-image', null, [
				'static_mobile_filename' => 'default-post-thumbnail.png',
				'width' => 600,
				'height' => 450,
				'lazyload' => true,
				'class' => 'responsive-static-image--cover ratio ratio-16x9 z-1 post-card__background-image post-card__background-image--placeholder'
			]);
		endif;
		?>
		<div class="w-100 position-relative d-flex flex-column flex-grow-1 z-2 post-card__inner">
			<div class="p-1 bg-white w-100 flex-grow-1 d-flex flex-column shadow post-card__content">
				<h3 class="m-0 fs-18 overflow-hidden post-card__title"><?php echo esc_html( get_the_title( $data['post_id']) ); ?></h3>
				<p class="small mb-0 mt-auto pt-1 post-card__date"><?php echo esc_html( get_the_date('d/m/Y', $data['post_id']) ); ?></p>
			</div>
		</div>
		<a class="post-card__overlay-link position-absolute top-0 start-0 w-100 h-100 z-3" href="<?php echo esc_url_raw( get_permalink( $data['post_id'] ) ); ?>" title="<?php echo esc_attr( get_the_title( $data['post_id']) ); ?>"></a>
	</div>
</article>
