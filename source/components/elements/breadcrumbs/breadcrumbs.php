<?php
/**
 * Breadcrumbs
 */
?>

<div <?= $htmlAttributesString(['class' => [
    'breadcrumbs',
    !empty($theme) ? "breadcrumbs--{$theme}" : null,
]]) ?>>
    <div class="breadcrumbs__inner">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <?php
            add_filter('wpseo_breadcrumb_separator', function () {
                return '<span class="breadcrumbs__separator">/</span>';
            });
            yoast_breadcrumb('<nav aria-label="Breadcrumb" class="breadcrumbs__navigation">', '</nav>');
            remove_filter('wpseo_breadcrumb_separator', function () {
                return '<span class="breadcrumbs__separator">/</span>';
            });
            ?>
        <?php endif; ?>
    </div>
</div>
