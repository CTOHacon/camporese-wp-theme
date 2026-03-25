<?php
/**
 * Blog Post Meta
 *
 * Per-post overrides for the archive card thumbnail/title and the single post hero image/title.
 * Leave fields empty to fall back to the post's featured image and post title.
 */

acf_add_local_field_group([
    'key'      => 'group_blog_post_meta',
    'title'    => 'Post Settings',
    'fields'   => [
        // ── Archive Card ────────────────────────────────────────────────────
        [
            'key'   => 'field_blog_post_meta_tab_card',
            'label' => 'Archive Card',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_blog_post_card_image',
            'label'         => 'Card Image',
            'name'          => 'blog_card_image',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
            'instructions'  => 'Leave empty to use the featured image.',
        ],
        [
            'key'          => 'field_blog_post_card_title',
            'label'        => 'Card Title',
            'name'         => 'blog_card_title',
            'type'         => 'text',
            'instructions' => 'Leave empty to use the post title.',
        ],

        // ── Hero ────────────────────────────────────────────────────────────
        [
            'key'   => 'field_blog_post_meta_tab_hero',
            'label' => 'Hero',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'          => 'field_blog_post_hero_pretitle',
            'label'        => 'Hero Pretitle',
            'name'         => 'blog_hero_pretitle',
            'type'         => 'text',
            'instructions' => 'Small label above the title (e.g. category name).',
        ],
        [
            'key'           => 'field_blog_post_hero_image',
            'label'         => 'Hero Image',
            'name'          => 'blog_hero_image',
            'type'          => 'image',
            'return_format' => 'id',
            'preview_size'  => 'medium',
            'instructions'  => 'Leave empty to use the featured image.',
        ],
        [
            'key'          => 'field_blog_post_hero_title',
            'label'        => 'Hero Title',
            'name'         => 'blog_hero_title',
            'type'         => 'text',
            'instructions' => 'Leave empty to use the post title.',
        ],
    ],
    'location' => [
        [[
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'blog',
        ]],
    ],
    'position' => 'side',
]);
