<?php /** SortByDropdown */ ?>

<div <?= $htmlAttributesString(['class' => 'sort-by-dropdown']) ?>>
    <button
        class="sort-by-dropdown__trigger"
        type="button"
        aria-haspopup="listbox"
        aria-expanded="false"
    >
        <span class="sort-by-dropdown__trigger-label"><?= $trigger_label ?></span>
        <?= component_svg_icon(['class' => 'sort-by-dropdown__trigger-icon'], ['name' => 'category-select-chevron']) ?>
    </button>

    <?php if (!empty($options) && is_array($options)): ?>
        <ul class="sort-by-dropdown__dropdown" role="listbox">
            <?php foreach ($options as $option): ?>
                <?php $is_active = $current_sort === $option['value']; ?>
                <li
                    class="sort-by-dropdown__option"
                    role="option"
                    aria-selected="<?= $is_active ? 'true' : 'false' ?>"
                >
                    <a <?= assembleHtmlAttributes([
                        'class' => ['sort-by-dropdown__option-link', '_active' => $is_active],
                        'href'  => $option['link'] ?? '#',
                    ]) ?>>
                        <?= $option['title'] ?? '' ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
