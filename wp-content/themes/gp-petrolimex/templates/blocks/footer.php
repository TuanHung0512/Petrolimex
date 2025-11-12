<?php

/**
 * Block: Footer
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */
$copyright_text = get_field('footer_copyright_text', 'option');
$follow_text    = get_field('footer_social_follow_text', 'option');
$facebook_url   = get_field('footer_facebook_url', 'option');
?>
<div class="w-100 position-relative footer">
	<figure class="d-none d-lg-block pe-none image--cover w-100 footer__background-image">
		<img class="image__img" src="<?php echo get_theme_file_uri('static-assets/images/bg-footer.jpg'); ?>" alt="" width="1351" height="144" loading="lazy">
	</figure>
	<div class="position-absolute top-0 start-0 w-100 h-100 bg-primary d-lg-none footer__background-color pe-none"></div>
	<div class="position-relative py-2 footer__wrapper">
		<div class="container">
			<div class="row flex-column flex-lg-row justify-content-lg-between align-items-center footer__row">
				<div class="col-12 mb-1 mb-lg-0 col-lg-4 footer__col footer__col--left">
					<p class="small m-0 text-white text-center text-lg-start footer__copyright"><?php echo esc_html($copyright_text); ?></p>
				</div>
				<div class="d-lg-flex text-center text-lg-end justify-content-lg-end col-12 col-lg-4 footer__col footer__col--right">
					<div class="d-inline-flex align-items-center m-0 footer__social-links">
						<span class="text-white small footer__social-links-text pe-1 pe-none"><?php echo esc_html($follow_text); ?></span>
						<span class="d-flex align-items-center footer__social-list">
							<a class="border border-white border-2 rounded-2 d-inline-flex align-items-center justify-content-center text-white footer__social-link"
								href="<?php echo esc_url($facebook_url); ?>"
								target="_blank"
								rel="nofollow">
								<span class="icon"><?php echo gp_petrolimex_get_svg_icon('facebook'); ?></span>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_template_part('templates/blocks/back-to-top');
get_template_part('templates/blocks/sticky-contacts', null, ['facebook_url' => $facebook_url]);
?>
