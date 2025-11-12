<?php

/**
 * Setup environments
 *
 * @package gp-petrolimex
 * @author TUAN HUNG
 * @since 0.0.1
 */


function gp_petrolimex_is_localhost()
{
	return ! empty($_SERVER['HTTP_X_GPpetrolimex_THEME_ENV']) && 'development' === $_SERVER['HTTP_X_GPpetrolimex_THEME_ENV'];
}
