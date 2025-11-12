<?php

/**
 * Block: Investment Contact
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'title' => '',
	'description' => '',
	'items' => [],
]);

$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

if (!empty($data['title']) || !empty($data['description']) || !empty($data['items'])) :
?>
	<div class="<?php echo esc_attr($_class); ?> mt-0 mt-md-3 mb-3 mb-md-4">
		<div class="container">
			<div class="investment-cta__wrapper position-relative mx-auto w-100 w-md-90">
				<div class="position-absolute pe-none top-0 left-0 w-100 h-100 investment-cta__background-image pe-none">
					<figure class="position-absolute top-0 left-0 w-100 h-100">
						<img class="object-fit-cover w-100 h-100" src="<?php echo get_theme_file_uri('static-assets/images/bg-investment-cta.png'); ?>" alt="" width="1060" height="330">
					</figure>
				</div>
				<div class="investment-cta__content text-white position-relative z-1 m-auto">
					<?php if (!empty($data['title'])) : ?>
						<h3 class="investment-cta__title fs-35 text-center pt-1 fw-semibold"><?php echo esc_html($data['title']) ?></h3>
					<?php endif; ?>
					<?php if (!empty($data['description'])) : ?>
						<div class="investment-cta__description fs-18 mb-1 text-center fw-medium"><?php echo wp_kses_post($data['description']); ?></div>
					<?php endif; ?>
					<?php if (!empty($data['items'])) : ?>
						<div class="investment-cta__info d-flex flex-column flex-md-row align-items-center justify-content-around gap-1 p-1">
							<?php foreach ($data['items'] as $item): ?>
								<div class="investment-cta__item d-flex align-items-center gap-1">
									<?php
									$static_image_filename = $item['type'] === 'Email' ? 'cta-email.png' : 'cta-phone.png';
									?>
									<figure class="investment-cta__icon h-100">
										<img class="object-fit-contain pe-none" src="<?php echo esc_url_raw(get_theme_file_uri('static-assets/images/' . $static_image_filename)); ?>" alt="" width="50" height="50">
									</figure>
									<div class="fs-6 d-inline-flex align-items-center text-nowrap text-decoration-none">
										<?php
										$desc = $item['description'];
										$desc = preg_replace('/<a\b([^>]*)\bclass=([\'"])([^\'"]*)\2/i', '<a $1class=$2$3 text-decoration-none$2', $desc);
										$desc = preg_replace('/<a\b((?:(?!class=)[^>])*)>/i', '<a class="text-decoration-none" $1>', $desc);
										echo wp_kses_post($desc);
										?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
	</div>
<?php endif;
