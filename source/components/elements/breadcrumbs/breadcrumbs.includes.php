<?php

function component_breadcrumbs($htmlAttributes = [], $props = [])
{
    $defaults = [
        'theme'           => '',
        'use_fancy_style' => false,
    ];

    $props = array_merge($defaults, $props);

    render_component_template(
        'breadcrumbs',
        'source/components/elements/breadcrumbs/breadcrumbs.php',
        $htmlAttributes,
        $props,
    );
}