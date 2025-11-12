<?php

/**
 * Block: Secrets Grid
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
global $wp_query;
$data = wp_parse_args($args, [
	'items' => '',
]);

$_class = 'secrets-grid';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
?>
<div class="<?php echo esc_attr($_class); ?> pb-4">
	<div class="container">
		<div class="row">
			<?php while ($data['items']->have_posts()) : $data['items']->the_post(); ?>
				<div class="col-md-4 mb-1 mb-md-2">
					<?php get_template_part('templates/blocks/secrets-item'); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>
