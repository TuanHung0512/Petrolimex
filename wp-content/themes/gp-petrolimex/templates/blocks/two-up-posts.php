<?php
/**
 * Block: Two Up Posts
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'post_ids' => []
]);

$_class = 'two-up-posts';
$_class .= !empty($data['class']) ? ' ' . $data['class'] : '';

if ( !empty( $data['post_ids'] ) ) :

?>
	<div class="<?php echo esc_attr( $_class ); ?>">
		<?php if ( !empty( $data['title'] ) ) : ?>
			<div class="mb-2 two-up-post__header">
				<div class="container">
					<h2 class="h5 fw-bold m-0 two-up-posts__title"><?php echo esc_html( $data['title'] ); ?></h2>
				</div>
			</div>
		<?php endif; ?>
		<div class="two-up-posts__main">
			<div class="container">
				<div class="row">
					<?php foreach ($data['post_ids'] as $post_id): ?>
						<div class="col-12 mb-2 col-lg-6 mb-0 d-lg-flex two-up-posts__col">
							<?php get_template_part('templates/blocks/post-card-overlay', null, [
								'class' => 'd-lg-flex flex-grow-1 ratio ratio-4x3 post-card-overlay--two-up-posts',
								'post_id' => $post_id
							]); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;
