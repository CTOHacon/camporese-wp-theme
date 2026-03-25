includes, component, scss

$tagname (span by default)
$theme (green) by default
<?= $tagname ?>.preheader-badge._$theme
    css: {
        display: flex;
        padding: 6px 16px;
        gap: 0.625rem;
        background: var(--c-background-color);
        border-radius: 1rem;
        font-weight: 400;
        font-size: 1rem;
        line-height: 100%;
        &._green {
            background : var(--c-background-color, #DCEEE5);
        }
    }
    <slot>