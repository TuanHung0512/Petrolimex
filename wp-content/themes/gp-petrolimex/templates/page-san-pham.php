<?php

/**
 * Template Name: Sản Phẩm
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */

get_header();

/**
 * @var WP_Post_Type
 */
$products = get_field('products');

?>
<div class="product-intro w-100 pt-5">
	<figure class="position-absolute top-0 w-100 h-100">
		<img class="image__img w-100 object-fit-cover" src="<?php echo get_theme_file_uri('static-assets/images/bgsec1_prolist.png'); ?>" alt="" width="1600" height="280" loading="lazy">
	</figure>
	<?php

	$mapping_colors = [
    	0 => 'bg-half-blue-white',
    	1 => 'bg-aqua-light-gradient',
    	2 => 'bg-gray-light-gradient',
    	3 => 'bg-aqua-light-gradient',
	];

	foreach ($products as $index => $product):
		$choose_taxonomy = $product['choose_taxonomy'];
		$term = get_term($choose_taxonomy, 'category-product');
		$taxonomy_name = $term && !is_wp_error($term) ? $term->name : '';

		$product_query = new WP_Query([
			'post_type' => 'san-pham',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'tax_query' => [
				[
					'taxonomy' => 'category-product',
					'field'    => 'term_id',
					'terms'    => $choose_taxonomy,
				],
			],
		]);
		$product_items = [];
		if ($product_query->have_posts()) {
			foreach ($product_query->posts as $item) {
				$item->water_volume = get_field('water_volume', $item->ID);
				$product_items[] = $item;
			}
		}

		$bg_class = $mapping_colors[$index % count($mapping_colors)];

		get_template_part('templates/blocks/product-grid', null, [
			'class' => 'py-5 '. $bg_class,
			'items' => $product_items,
			'taxonomy_name' => $taxonomy_name,
			'show_water_volume' => true,
			'hidden_letter' => $product['hidden_letters'],
			'hotline' => $product['hotline'],
		]);
	endforeach;
	?>
</div>
<?php get_footer();
