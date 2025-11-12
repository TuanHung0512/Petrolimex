<?php
/**
 * Block: Subnav
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

$data = wp_parse_args($args, [
	'class' => '',
	'items' => []
]);

$_class = 'subnav';
$_class .= !empty($data['class']) ? ' ' . $data['class'] : '';

if ( !empty( $data['items'] ) ) :

?>
<div class="<?php echo esc_attr( $_class ); ?>">
	<div class="container">
		<ul class="list-unstyled m-0 pt-1 subnav__list d-flex gap-1 position-relative z-2">
			<?php foreach ( $data['items'] as $item ) : ?>
				<li class="subnav__item position-relative<?php echo $item['is_active'] ? ' subnav__item--active' : ' '; ?>">
					<a class="h5 d-block text-decoration-none fw-bold subnav__link" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php endif;
