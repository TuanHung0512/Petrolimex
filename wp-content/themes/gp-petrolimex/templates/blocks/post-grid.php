<?php
/**
 * Block: Post Grid
 *
 * @package gp-petrolimex
 * @since 1.9.0
 */

$data = wp_parse_args($args, [
	'class'      => '',
	'column_class' => 'col-12 col-lg-4 mb-2 d-flex flex-column',
	'post_ids' => [],
]);

$_class = 'post-grid';
$_class .= !empty($data['class']) ? ' ' . $data['class'] : '';

$_column_class = 'd-flex flex-column post-grid__col';
$_column_class .= !empty($data['column_class']) ? ' ' . $data['column_class'] : '';

?>
<div class="<?php echo esc_attr($_class); ?>">
	<div class="container">
		<?php if ( !empty( $data['post_ids'] ) ) : ?>
			<div class="row">
				<?php foreach( $data['post_ids'] as $post_id ) : ?>
					<div class="<?php echo esc_attr( $_column_class ); ?>">
						<?php get_template_part('templates/blocks/post-card', null, [
							'class' => 'flex-grow-1 d-flex flex-column',
							'post_id' => $post_id
						]); ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="mb-2"><?php esc_html_e('No posts found.', 'gp-petrolimex'); ?></p>
		<?php endif; ?>
	</div>
</div>

