<?php

/**
 * Single: Post
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 1.9.0
 */
get_header();

$_class = 'single-post';
$_class .= !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';
$post_thumbnail_id = get_post_thumbnail_id();
$file_id  = get_post_meta(get_the_ID(), 'document_file', true);
$file_url = wp_get_attachment_url($file_id);

$post_ids = [];
$category_ids = wp_get_post_categories(get_the_ID());
$post_ids = get_posts([
	'category__in' => $category_ids,
	'post__not_in' => [get_the_ID()],
	'posts_per_page' => 3,
	'fields' => 'ids',
]);
?>
<div class="<?php echo esc_attr($_class); ?> position-relative">
	<figure>
		<img class="image__img position-absolute top-0 w-100" src="<?php echo get_theme_file_uri('static-assets/images/bgsec1_prolist.png'); ?>" alt="" width="1600" height="280" loading="lazy">
	</figure>
	<div class="container position-relative z-1">
		<h1 class="h2 lh-sm text-center m-auto single-post__title pt-4"><?php the_title(); ?></h1>
		<div class="single-post__date text-center fs-16 fw-semibold text-black-50 mt-1 mb-2"><?php echo get_the_time('d/m/Y'); ?></div>
		<?php
		get_template_part('templates/core-blocks/image', null, [
			'image_id' => $post_thumbnail_id,
			'image_size' => 'large',
			'lazyload' => true,
			'class' => 'image--cover ratio ratio-16x9 post-card__background-image z-1',
		]);
		?>
		<div class="single-post__detail mt-2">
			<div class="row flex-column-reverse flex-md-row">
				<div class="col-md-2">
					<div class="single-post__share">
						<span class="fs-14 d-block"><?php echo __('Share this post:', 'gp-petrolimex'); ?></span>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
							<figure>
								<img class="image__img" src="<?php echo get_theme_file_uri('static-assets/images/share-fb.png'); ?>" alt="" width="109" height="36" loading="lazy">
							</figure>
						</a>
					</div>
				</div>
				<div class="col-md-10">
					<?php if(!empty($file_url)) : ?>
					<a href="<?php echo esc_url($file_url); ?>" class="text-decoration-none" target="_blank">
						<?php echo get_the_title(); ?>
					</a>
					<?php else: ?>
					<div class="single-post__content fs-16 mb-2 mb-md-0">
						<?php the_content(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		get_template_part('templates/blocks/topic-post', null, [
			'items' => $post_ids
		]);
		?>

	</div>

</div>
<?php get_footer();
