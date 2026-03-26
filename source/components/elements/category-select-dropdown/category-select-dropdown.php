<?php /** CategorySelectDropdown */ ?>

<div <?= $htmlAttributesString(['class' => 'category-select-dropdown']) ?>>
    <button
        class="category-select-dropdown__trigger"
        type="button"
        aria-haspopup="listbox"
        aria-expanded="false"
    >
        <span class="category-select-dropdown__trigger-label"><?= $trigger_label ?></span>
        <?= component_svg_icon(['class' => 'category-select-dropdown__trigger-icon'], ['name' => 'category-select-chevron']) ?>
    </button>

    <?php if (!empty($categories) && is_array($categories)): ?>
        <ul class="category-select-dropdown__dropdown" role="listbox">
            <?php $loop_index = 0; ?>
            <?php foreach ($categories as $category): ?>
                <?php
                $is_active = $current_category
                    ? $current_category === ($category['title'] ?? '')
                    : $loop_index === 0;
                $loop_index++;
                ?>
                <li
                    class="category-select-dropdown__option"
                    role="option"
                    aria-selected="<?= $is_active ? 'true' : 'false' ?>"
                >
                    <a <?= assembleHtmlAttributes([
                        'class' => ['category-select-dropdown__option-link', '_active' => $is_active],
                        'href'  => $category['link'] ?? '#',
                    ]) ?>>
                        <?= $category['title'] ?? '' ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
