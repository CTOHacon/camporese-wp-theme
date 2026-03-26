<?php
/**
 * Blog Archive Template
 */

get_header();

component_page_hero([], [
    'slogan'               => get_field('field_blog_archive_hero_pretitle', 'option'),
    'title'                => get_field('field_blog_archive_hero_title', 'option'),
    'text'                 => get_field('field_blog_archive_hero_text', 'option'),
    'background_image'     => get_field('field_blog_archive_hero_image', 'option'),
    'bg_bottom_overlap'    => '16rem',
    'show_contact_buttons' => false,
]);

global $wp_query;
component_blog_archive_list(['class' => 'mb-5'], [
    'query' => $wp_query,
]);

get_footer();
