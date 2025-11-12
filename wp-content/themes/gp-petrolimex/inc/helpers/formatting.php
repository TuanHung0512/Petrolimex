<?php

/**
 * Formatter
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */

function gp_petrolimex_format_css_variables($css)
{
	// Remove unused css
	$css = preg_replace('/@custom-media --(.*)\;/i', '', $css);

	// Remove empty whitespace
	$css = preg_replace('/\s+/', '', $css);

	return $css;
}
