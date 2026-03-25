<?php
acf_add_options_sub_page([
    'page_title'  => 'Social Media Links',
    'menu_title'  => 'Social Media Links',
    'parent_slug' => 'contacts',
    'menu_slug'   => 'contacts-social-media-links',
]);
acf_add_local_field_group([
    'key'      => 'group_contacts_socials',
    'title'    => 'Contacts - Social Media Links',
    'fields'   => [
        [
            'key'           => 'field_instagram_link',
            'label'         => 'Instagram Link',
            'name'          => 'field_instagram_link',
            'type'          => 'text',
            'default_value' => '',
        ],
        [
            'key'           => 'field_facebook_link',
            'label'         => 'Facebook Link',
            'name'          => 'field_facebook_link',
            'type'          => 'text',
            'default_value' => '',
        ],
        [
            'key'           => 'field_youtube_link',
            'label'         => 'YouTube Link',
            'name'          => 'field_youtube_link',
            'type'          => 'text',
            'default_value' => '',
        ],
        [
            'key'           => 'field_linkedin_link',
            'label'         => 'LinkedIn Link',
            'name'          => 'field_linkedin_link',
            'type'          => 'text',
            'default_value' => '',
        ],
    ],
    'location' => [
        [[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'contacts-social-media-links'
        ]],
    ],
]);
