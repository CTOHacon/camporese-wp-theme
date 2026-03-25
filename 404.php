<?php
/**
 * 404 Page Template
 */

get_header();

$button = get_field('technical_page_hero_button', 'option') ?: [];

component_technical_page_hero([], [
    'title'           => get_field('technical_page_hero_title', 'option'),
    'image'           => get_field('technical_page_hero_image', 'option'),
    'secondary_title' => get_field('technical_page_hero_secondary_title', 'option'),
    'text'            => get_field('technical_page_hero_text', 'option'),
    'button_url'      => $button['url'] ?? null,
    'button_text'     => $button['title'] ?? null,
]);

get_footer();