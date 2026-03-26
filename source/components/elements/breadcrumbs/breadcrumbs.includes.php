<?php

function component_breadcrumbs($htmlAttributes = [], $props = [])
{
    $defaults = [
        'theme' => '',
        'use_fancy_style' => false,
    ];

    $props = array_merge($defaults, $props);

    component(
        'breadcrumbs',
        $htmlAttributes,
        $props,
    );
}