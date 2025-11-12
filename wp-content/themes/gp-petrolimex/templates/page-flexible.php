<?php

/**
 * Template Name: Flexible
 * Template Post Type: page
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

get_header();
?>

<?php
	// get_template_part('templates/blocks/loading-screen');
?>
<div class="w-100 flexible-content">
    <?php

	get_template_part('templates/content/flexible');

	?>
</div>

<?php
get_footer();
