<?php
/**
 * This file contains the configuration for the post archive page settings in the WordPress theme.
 *
 * Creates an ACF options subpage and local field group for the archive page settings.
 * The configuration includes fields for the hero title and hero content of the post archive page.
 *
 * @package WP_Theme
 */

acf_add_options_sub_page([
    'page_title'  => 'Archive Page Settings',
    'menu_title'  => 'Archive Page Settings',
    'parent_slug' => 'edit.php?post_type=post',
    'menu_slug'   => 'post-archive-page-settings',
]);
acf_add_local_field_group([
    'key'      => 'group_post_archive_settings',
    'title'    => 'Archive Page Settings',
    'fields'   => [
        [
            'key'   => 'field_post_archive_hero_title',
            'label' => 'Hero Title',
            'name'  => 'field_post_archive_hero_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_post_archive_hero_content',
            'label' => 'Hero Content',
            'name'  => 'field_post_archive_hero_content',
            'type'  => 'wysiwyg',
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'post-archive-page-settings'
        ]],
    ],
]);