<?php

function component_breadcrumbs($htmlAttributes = [], $props = [])
{
    $defaults = [
        'theme' => '',
    ];

    $props = array_merge($defaults, $props);

    component(
        'breadcrumbs',
        $htmlAttributes,
        $props,
    );
}