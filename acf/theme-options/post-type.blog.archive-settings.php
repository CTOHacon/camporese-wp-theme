<?php
/**
 * Blog Archive Page Settings
 *
 * Creates an ACF options subpage and local field group for the blog archive page settings.
 * The configuration includes fields for the hero title and text of the blog archive page.
 *
 * @package WP_Theme
 */

acf_add_options_sub_page([
    'page_title'  => 'Archive Page Settings',
    'menu_title'  => 'Archive Page Settings',
    'parent_slug' => 'edit.php?post_type=blog',
    'menu_slug'   => 'blog-archive-page-settings',
]);

acf_add_local_field_group([
    'key'      => 'group_blog_archive_settings',
    'title'    => 'Blog Archive Settings',
    'fields'   => [
        [
            'key'           => 'field_blog_archive_hero_pretitle',
            'label'         => 'Hero Pretitle',
            'name'          => 'field_blog_archive_hero_pretitle',
            'type'          => 'text',
            'default_value' => 'Our Blog',
        ],
        [
            'key'           => 'field_blog_archive_hero_title',
            'label'         => 'Hero Title',
            'name'          => 'field_blog_archive_hero_title',
            'type'          => 'text',
            'default_value' => 'Expert Humane Wildlife Removal & Prevention Tips',
        ],
        [
            'key'   => 'field_blog_archive_hero_text',
            'label' => 'Hero Text',
            'name'  => 'field_blog_archive_hero_text',
            'type'  => 'textarea',
        ],
        [
            'key'           => 'field_blog_archive_hero_image',
            'label'         => 'Hero Image',
            'name'          => 'field_blog_archive_hero_image',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
            'library'       => 'all',
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'blog-archive-page-settings'
        ]],
    ],
]);
