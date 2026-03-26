<?php
/**
 * Blog Category Term Meta
 *
 * ACF fields for blog-category taxonomy hero settings.
 */

acf_add_local_field_group([
    'key'      => 'group_blog_category_hero',
    'title'    => 'Hero Settings',
    'fields'   => [
        [
            'key'          => 'field_blog_category_hero_title',
            'label'        => 'Hero Title',
            'name'         => 'blog_category_hero_title',
            'type'         => 'text',
            'instructions' => 'Leave empty to use category name',
        ],
        [
            'key'          => 'field_blog_category_hero_text',
            'label'        => 'Hero Text',
            'name'         => 'blog_category_hero_text',
            'type'         => 'textarea',
            'rows'         => 3,
            'instructions' => 'Leave empty to use category description',
        ],
        [
            'key'           => 'field_blog_category_hero_image',
            'label'         => 'Hero Image',
            'name'          => 'blog_category_hero_image',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
            'library'       => 'all',
            'instructions'  => 'Leave empty to use the global blog archive hero image',
        ],
    ],
    'location' => [
        [[
            'param'    => 'taxonomy',
            'operator' => '==',
            'value'    => 'blog-category',
        ]],
    ],
]);
