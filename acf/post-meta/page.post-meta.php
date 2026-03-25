<?php
add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'      => 'group_page_data',
        'title'    => 'Page Data',
        'fields'   => [
            // Add fields here
        ],
        'location' => [
            [[
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page'
            ]],
        ],
        'position' => 'side',
    ]);
});
