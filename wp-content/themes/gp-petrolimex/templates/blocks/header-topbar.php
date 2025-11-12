<?php
/**
 * Block: Header Topbar
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.1.1
 */


$contact_text = get_field('contact_text', 'option');
$contact_url = get_field('contact_url', 'option');
$hotline_text = get_field('hotline_text', 'option');
$hotline_url = get_field('hotline_url', 'option');
$button_text = get_field('button_text', 'option');
$button_url = get_field('button_url', 'option');
$button_image = get_field('button_image', 'option');
?>

<div class="bg-blue text-white small overflow-hidden header-topbar">
	<div class="header-topbar__container">
		<div class="d-flex">
			<div class="col-auto d-flex align-items-center d-lg-none header-topbar__col header-topbar__col--left">
			<button class="header-topbar__menu-button d-flex d-lg-none py-0 bg-transparent border-0 radius-0 align-items-center justify-content-center js-toggle-slideout-menu">
				<span class="icon d-flex align-items-center justify-content-center text-white pe-none">
					<?php echo gp_petrolimex_get_svg_icon('menu'); ?>
				</span>
				<span class="icon icon--hidden d-none align-items-center justify-content-center text-white pe-none">
					<?php echo gp_petrolimex_get_svg_icon('menu-close'); ?>
				</span>
			</button>
			<button class="header-topbar__close--button d-flex d-lg-none py-0 px-2 bg-transparent border-0 radius-0 align-items-center justify-content-center js-close-mobile-menu" style="display:none;">
				<span class="position-relative">
					<span class="header-topbar__close-line bg-white position-absolute top-50 start-50 translate-middle"></span>
					<span class="header-topbar__close-line bg-white position-absolute top-50 start-50 translate-middle"></span>
				</span>
			</button>
			</div>
			<div class="col d-flex justify-content-end header-topbar__col header-topbar__col--right">
				<div class="d-inline-flex align-items-center gap-1 header-topbar__inner fs-14">
				<?php if (!empty( $contact_text ) && !empty( $contact_url ) ) : ?>
					<a class="header-topbar__link text-white position-relative pe-1 fw-bold text-decoration-none" href="<?php echo esc_url($contact_url); ?>"><?php echo esc_html($contact_text); ?></a>
				<?php endif; ?>
				<?php if (!empty( $hotline_text) && !empty( $hotline_url) ) : ?>
					<a class="header-topbar__link d-none d-lg-block fw-bold text-decoration-none text-uppercase" href="<?php echo esc_url($hotline_url); ?>">
						<span class="text-white pe-none"><?php esc_html_e('Hotline', 'gp-petrolimex'); ?></span>
						<span class="text-success fw-bold text-link"><?php echo esc_html($hotline_text); ?></span>
					</a>
				<?php endif; ?>
				<?php if (!empty($button_text)): ?>
					<div class="ms-1 position-relative header-topbar__call-block d-flex align-items-center">
						<button class="position-relative btn btn-danger btn-sm py-1 px-2 border-0 rounded-0 text-white fw-bold header-topbar__call-button fs-12 js-open-hotline-modal" type="button" aria-haspopup="dialog" aria-controls="vh-call-modal"">
							<span class="text"><?php echo esc_html($button_text); ?></span>
							<span class="icon position-absolute d-flex align-items-center justify-content-center pe-none"><?php echo gp_petrolimex_get_svg_icon('caret-right'); ?></span>
						</button>
						<?php
						get_template_part('templates/core-blocks/image', null, [
							'image_id' => $button_image,
							'image_size' => 'large',
							'lazyload' => false,
							'class' => 'header-topbar__button-background-image',
						]);
						?>
					</div>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
