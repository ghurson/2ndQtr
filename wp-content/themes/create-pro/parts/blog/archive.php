<?php

$blog_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => '4',
    'paged' => get_query_var("paged")
]);


if($blog_query->found_posts == 0) return false;

foreach($blog_query->posts as $post)
    get_template_part("parts/blog/excerpt");

wp_pagenavi( array( 'query' => $blog_query ) );