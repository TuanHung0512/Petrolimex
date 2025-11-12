<?php

/**
 * Block: Shareholder Grid
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
global $wp_query;
$data = wp_parse_args($args, [
	'post_query' => '',
]);

$_class = 'shareholder-grid';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$post_query = $data['post_query'];
?>
<div class="<?php echo esc_attr($_class); ?>">
	<div class="container">
		<?php if ($post_query->have_posts()) : ?>
			<div class="row">
				<?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
					<div class="col-12 mb-2 col-md-4 shareholder-grid__col">
						<?php get_template_part('templates/blocks/shareholder-item'); ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		<?php else: ?>
			<p class="mt-2 mb-0"><?php esc_html_e('Data is updating...', 'gp-petrolimex'); ?></p>
		<?php endif; ?>
		<?php
		if ($wp_query->max_num_pages > 1) :

			get_template_part('templates/blocks/pagination', null, [
				'class' => 'mt-1',
				'post_query' => $post_query
			]);
		endif;
		?>
	</div>
</div>
