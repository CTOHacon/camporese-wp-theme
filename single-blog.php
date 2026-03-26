<?php
/**
 * Single Blog Post Template
 */

get_header();

$content_layout = get_field('blog_content_layout') ?: 'blog';
$content_props  = [
    'pre_title' => get_field('blog_hero_pretitle') ?: null,
    'title'     => get_field('blog_hero_title') ?: get_the_title(),
    'image'     => get_field('blog_hero_image') ?: get_post_thumbnail_id() ?: null,
    'slot'      => function () {
        the_content();
    },
];

if ($content_layout === 'page') {
    component_page_typography_content(['class' => 'mb-5'], $content_props);
} else {
    component_blog_page_typography_content(['class' => 'mb-5'], $content_props);
}

component_blog_posts_slider(['class' => 'mb-6'], []);

get_footer();
