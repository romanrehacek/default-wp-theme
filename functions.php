<?php

/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if ( ! isset ( $GLOBALS['content_width']) ) {
	$GLOBALS['content_width'] = 600;
}

require 'includes/defaults.php';
require 'includes/disable-comments.php';
require 'includes/theme_name-functions.php';

require 'includes/class-theme_name.php';
