<?php
/**
 * Blog Category Taxonomy Archive Template
 */

get_header();

$term = get_queried_object();

component_page_hero([], [
    'slogan'               => get_field('field_blog_archive_hero_pretitle', 'option'),
    'title'                => $term->name ?: get_field('blog_category_hero_title', $term),
    'text'                 => term_description() ?: get_field('blog_category_hero_text', $term),
    'background_image'     => get_field('blog_category_hero_image', $term) ?: get_field('field_blog_archive_hero_image', 'option'),
    'bg_bottom_overlap'    => '16rem',
    'show_contact_buttons' => false,
]);

global $wp_query;
component_blog_archive_list(['class' => 'mb-5'], [
    'query' => $wp_query,
]);

get_footer();
