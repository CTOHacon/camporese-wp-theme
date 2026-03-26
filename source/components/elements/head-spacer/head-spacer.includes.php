<?php

function component_head_spacer($htmlAttributes = [], $props = [])
{
    render_component_template(
        'head-spacer',
        'source/components/elements/head-spacer/head-spacer.php',
        $htmlAttributes,
        $props,
    );
}
