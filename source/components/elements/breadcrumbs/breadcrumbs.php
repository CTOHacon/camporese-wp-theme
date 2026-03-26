<?php
/**
 * Breadcrumbs
 */
?>

<?php $separator = $use_fancy_style ? '/' : '|'; ?>

<div <?= $htmlAttributesString(['class' => [
    'breadcrumbs',
    !empty($theme) ? "breadcrumbs--{$theme}" : null,
    $use_fancy_style ? 'breadcrumbs--fancy' : null,
]]) ?>>
    <div class="breadcrumbs__inner">
        <?php if (function_exists('yoast_breadcrumb')): ?>
            <?php
            add_filter('wpseo_breadcrumb_separator', function () use ($separator) {
                return '<span class="breadcrumbs__separator">' . $separator . '</span>';
            });
            yoast_breadcrumb('<nav aria-label="Breadcrumb" class="breadcrumbs__navigation">', '</nav>');
            remove_filter('wpseo_breadcrumb_separator', function () use ($separator) {
                return '<span class="breadcrumbs__separator">' . $separator . '</span>';
            });
            ?>
        <?php endif; ?>
    </div>
</div>
