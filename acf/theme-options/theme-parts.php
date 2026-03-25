<?php
acf_add_options_page([
    'page_title' => 'Theme Parts',
    'menu_title' => 'Theme Parts',
    'menu_slug'  => 'theme-parts',
    'capability' => 'edit_theme_options',
    'icon_url'   => 'dashicons-align-pull-right',
    'redirect'   => true
]);