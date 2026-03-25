<?php
declare(strict_types=1);

function create_blog_post_type(): void
{
    register_post_type(
        'blog',
        [
            'labels'       => [
                'name'               => 'Blog',
                'singular_name'      => 'Blog',
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Blog',
                'edit'               => 'Edit',
                'edit_item'          => 'Edit Blog',
                'new_item'           => 'New Blog',
                'view'               => 'View Blog',
                'view_item'          => 'View Blog',
                'search_items'       => 'Search Blog',
                'not_found'          => 'No Blog found',
                'not_found_in_trash' => 'No Blog found in Trash',
                'parent'             => 'Parent Blog',
            ],
            'public'       => true,
            'supports'     => [
                'title',
                'editor',
                'excerpt',
                'author',
                'thumbnail',
            ],
            'menu_icon'    => 'dashicons-format-aside',
            'has_archive'  => true,
            'rewrite'      => ['slug' => 'blog'],
            'show_in_rest' => true,
            'hierarchical' => false,
            'taxonomies'   => ['blog-category'],
        ]
    );
}

add_action('init', 'create_blog_post_type');

// Create blog-category taxonomy
function create_blog_category_taxonomy(): void
{
    register_taxonomy(
        'blog-category',
        'blog',
        [
            'labels'       => [
                'name'              => 'Blog Categories',
                'singular_name'     => 'Blog Category',
                'search_items'      => 'Search Blog Categories',
                'all_items'         => 'All Blog Categories',
                'parent_item'       => 'Parent Blog Category',
                'parent_item_colon' => 'Parent Blog Category:',
                'edit_item'         => 'Edit Blog Category',
                'update_item'       => 'Update Blog Category',
                'add_new_item'      => 'Add New Blog Category',
                'new_item_name'     => 'New Blog Category Name',
                'menu_name'         => 'Blog Categories',
            ],
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite'      => ['slug' => 'blog-category'],
        ]
    );
}

add_action('init', 'create_blog_category_taxonomy');

function set_blog_posts_per_page($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('blog')) {
        $query->set('posts_per_page', 16);
    }
}

add_action('pre_get_posts', 'set_blog_posts_per_page');