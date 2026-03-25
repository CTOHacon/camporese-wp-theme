<?php
/**
 * Single Blog Post Template
 */

get_header();

component_head_spacer(['class' => 'mb-1']);

component_breadcrumbs(['class' => 'lib-container pt-1 mb-2']);

component_blog_page_typography_content([], [
    'pre_title' => get_field('blog_hero_pretitle') ?: null,
    'title'     => get_field('blog_hero_title') ?: get_the_title(),
    'image'     => get_field('blog_hero_image') ?: get_post_thumbnail_id() ?: null,
    'slot'      => function () {
        the_content();
    },
]);

get_footer();
