<?php
/**
 * Block: Slideout Menu
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.1.1
 */

$hotline_text = get_field('hotline_text', 'option');
$hotline_url = get_field('hotline_url', 'option');

?>

<div class="slideout-menu position-fixed start-0 d-flex d-md-none flex-column" data-block="slideout-menu">
	<div class="position-fixed left-0 w-100 h-100 z-1 opacity-0 slideout-menu__overlay js-toggle-slideout-menu"></div>
	<div class="bg-white position-relative top-0 z-3 slideout-menu__wrapper">
		<div class="position-relative flex-grow-1 d-flex flex-column slideout-menu__inner">
			<?php
			wp_nav_menu([
				'theme_location' => 'primary-menu',
				'container'      => false,
				'menu_class'     => 'slideout-menu__menu list-unstyled m-0 p-0',
			]);
			?>
			<?php if ( !empty( $hotline_text ) && !empty( $hotline_url ) ) : ?>
				<div class="slideout-menu__footer p-1">
					<?php get_template_part('templates/core-blocks/button', null, [
						'button_text' =>  __('Hotline', 'gp-petrolimex') . ' ' . $hotline_text,
						'button_url' => $hotline_url,
						'type' => 'primary',
						'class' => 'w-100 text-uppercase fs-14 rounded-0 slideout-menu__button'
					]); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
