<?php
/**
 * Blog Category Taxonomy Archive Template
 */

get_header();

$term = get_queried_object();

component_archive_hero([], [
    'pretitle' => get_field('field_blog_archive_hero_pretitle', 'option'),
    'title'    => $term->name ?: get_field('blog_category_hero_title', $term),
    'text'     => term_description() ?: get_field('blog_category_hero_text', $term),
]);

global $wp_query;
component_blog_archive_list([], [
    'query' => $wp_query,
]);

component_advantages_list();

get_footer();
