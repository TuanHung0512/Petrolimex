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

$_class = 'd-flex flex-column position-relative post-card-overlay';
$_class .= !empty($data['class']) ? ' ' . $data['class'] : '';

$post_thumbnail_id = get_post_thumbnail_id($data['post_id']);

$_class .= !empty( $post_thumbnail_id ) ? ' post-card-overlay--has-thumbnail' : ' post-card-overlay--has-placeholder-image';

?>

<article class="<?php echo esc_attr( $_class ); ?>">
	<div class="position-absolute z-1 top-0 left-0 w-100 h-100 post-card-overlay__background-image-wrapper">
		<?php
		if ( !empty( $post_thumbnail_id ) ) :
			get_template_part('templates/core-blocks/image', null, [
				'image_id' => get_post_thumbnail_id($data['post_id']),
				'image_size' => 'large',
				'lazyload' => true,
				'class' => 'position-absolute top-0 start-0 w-100 h-100 image--cover post-card-overlay__background-image'
			]);
		else :
			get_template_part('templates/core-blocks/responsive-static-image', null, [
				'static_mobile_filename' => 'default-post-thumbnail.png',
				'width' => 600,
				'height' => 450,
				'lazyload' => true,
				'class' => 'responsive-static-image--cover position-absolute top-0 start-0 w-100 h-100 post-card-overlay__background-image post-card-overlay__background-image--placeholder'
			]);

		endif;
		?>
	</div>
	<div class="post-card-overlay__overlay position-absolute z-2 top-0 left-0 w-100 h-100"></div>
	<div class="position-absolute top-0 start-0 w-100 h-100 flex-grow-1 z-3 d-flex align-items-end justify-content-start post-card-overlay__wrapper">
		<div class="p-2 post-card-overlay__content">
			<p class="small text-white mb-1 post-card-overlay__date"><?php echo esc_html( get_the_date('d/m/Y', $data['post_id']) ); ?></p>
			<h3 class="m-0 h5 fw-bold text-white post-card-overlay__title"><?php echo esc_html( get_the_title( $data['post_id']) ); ?></h3>
		</div>
	</div>
	<a class="position-absolute top-0 left-0 w-100 h-100 post-card-overlay__overlay-link z-3" href="<?php echo esc_url_raw( get_permalink( $data['post_id'] ) ); ?>" title="<?php echo esc_attr( get_the_title( $data['post_id']) ); ?>"></a>
</article>
