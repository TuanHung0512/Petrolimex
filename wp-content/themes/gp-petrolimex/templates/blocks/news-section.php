<?php
/**
 * Block: Last News
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'news_items' => []
]);

$_class = 'last-news py-5';
$_class .= !empty($data['class']) ? ' ' . esc_attr($data['class']) : '';
$news_items = [];
if (!empty($data['news_items'])) {
	foreach ($data['news_items'] as $post_id) {
		$news_item = get_post($post_id);
		if ($news_item) {
			$news_items[] = [
				'title' => get_the_title($post_id),
				'image' => get_post_thumbnail_id($post_id),
				'link' => get_permalink($post_id),
				'date' => get_the_date('d/m/Y', $post_id)
			];
		}
	}
}
?>
<?php if (!empty($news_items)): ?>
	<div class="<?php echo esc_attr($_class); ?>">
		<div class="container">
			<h2 class="last-news__title mb-1 fw-bold fs-4"><?php echo esc_html($data['title']); ?></h2>
			<div class="row g-0">
				<?php foreach ($news_items as $item): ?>
					<div class="col-md-6">
						<a href="<?php echo esc_url($item['link']); ?>" class="last-news__link text-decoration-none text-reset d-block w-100 h-100">
							<div class="last-news__card position-relative w-100 overflow-hidden mb-3">
								<?php
								get_template_part('templates/core-blocks/image', null, [
									'image_id' => $item['image'],
									'image_size' => 'large',
									'lazyload' => true,
									'class' => 'last-news__thumbnail position-absolute top-0 start-0 w-100 h-100 z-1',
									'image_class' => 'w-100 h-100 object-fit-cover',
								]);
								?>
								<div class="last-news__content position-absolute bottom-0 start-0 w-100 p-4 z-2 text-white">
									<span class="last-news__date fw-bold d-block fs-6 mb-2 opacity-75"><?php echo esc_html($item['date']); ?></span>
									<h2 class="last-news__content-title fw-bold fs-4 m-0 lh-sm"><?php echo esc_html($item['title']); ?></h2>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
