<?php
/**
 * Block: List agency
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'items' => '',
]);

$_class = 'agency-list';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$mapping_items = [
	'address' => 'map-pin',
	'phone' => 'phone',
	'fax' => 'fax',
];

if ( !empty($data['items'] ) ) : ?>
	<div class="<?php echo esc_attr($_class); ?>">
		<div class="container">
			<?php if (!empty($data['title'])): ?>
				<h2 class="h2 mb-0 agency-list__title text-blue-light text-center fw-bold"><?php echo esc_html($data['title']); ?></h2>
			<?php endif; ?>
			<div class="agency-list__inner pt-0 pt-md-1">
				<?php foreach ($data['items'] as $item): ?>
					<div class="agency-list__item position-relative z-1 p-1 border-bottom border-dark border-2 cursor-pointer">
						<h3 class="h6 mb-1 agency-list__address-title m-0 fw-bold text-uppercase"><?php echo esc_html($item['name']); ?></h3>
						<ul class="list-unstyled m-0 p-0 agency-list__card d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
							<?php foreach ($mapping_items as $key => $icon): ?>
								<li class="agency-list__meta-item d-flex align-items-center">
									<span class="text-blue-light d-flex align-items-center justify-content-center agency-list__icon"><?php echo gp_petrolimex_get_svg_icon($icon); ?></span>
									<span class="agency-list__text"><?php echo esc_html($item[$key]); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if ( !empty( $data['items'][0]['embed_map'] ) ) : ?>
				<div class="mt-1 agency-list__map">
					<div class="w-100 position-relative agency-list__iframe">
						<?php echo $data['items'][0]['embed_map']; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif;
