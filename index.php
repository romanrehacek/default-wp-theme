<?php
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_posts();
		the_content();
	}
}

get_footer();
