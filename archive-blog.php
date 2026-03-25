<?php
/**
 * Blog Archive Template
 */

get_header();

component_head_spacer();

component_archive_hero([], [
    'pretitle' => get_field('field_blog_archive_hero_pretitle', 'option'),
    'title'    => get_field('field_blog_archive_hero_title', 'option'),
    'text'     => get_field('field_blog_archive_hero_text', 'option'),
]);

global $wp_query;
component_blog_archive_list(['class' => 'mb-2'], [
    'query' => $wp_query,
]);

get_footer();
