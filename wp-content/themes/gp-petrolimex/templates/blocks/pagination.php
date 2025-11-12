<?php
/**
 * Block: Pagination
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	'post_query' => null,
	'base' => '',
	'format' => ''
]);

$big = 999999999;

$_class = 'pagination';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

if ($data['post_query']->have_posts() && $data['post_query']->max_num_pages > 1): ?>
	<div class="<?php echo esc_attr($_class); ?>">
		<div class="container">
			<div class="d-flex align-items-center justify-content-center pagination__block">
				<?php
				echo paginate_links([
					'base' => !empty($data['base']) ? $data['base'] : str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => !empty($data['format']) ? $data['format'] : 'page/%#%/',
					'current' => max(1, $data['paged']),
					'total' => $data['post_query']->max_num_pages,
					'prev_text' => __('Previous page', 'gp-petrolimex'),
					'next_text' => __('Next page', 'gp-petrolimex')
				]);
				?>
			</div>
		</div>
	</div>
<?php endif;
