<?php /** Pagination */ ?>

<nav <?= $htmlAttributesString(['class' => 'pagination']) ?> aria-label="Page navigation">

    <?php if ($prev_url): ?>
        <a <?= assembleHtmlAttributes(['class' => 'pagination__arrow pagination__arrow--prev', 'href' => esc_url($prev_url), 'aria-label' => 'Previous page']) ?>>
            <?= component_svg_icon(['class' => 'pagination__arrow-icon'], ['name' => 'arrow-left']) ?>
        </a>
    <?php else: ?>
        <span <?= assembleHtmlAttributes(['class' => 'pagination__arrow pagination__arrow--prev _disabled', 'aria-disabled' => 'true', 'aria-label' => 'Previous page']) ?>>
            <?= component_svg_icon(['class' => 'pagination__arrow-icon'], ['name' => 'arrow-left']) ?>
        </span>
    <?php endif; ?>

    <?php if (!empty($pages) && is_array($pages)): ?>
        <ul class="pagination__pages">
            <?php foreach ($pages as $page): ?>
                <li class="pagination__page-item">
                    <a <?= assembleHtmlAttributes([
                        'class'        => ['pagination__page', '_active' => $page['is_active']],
                        'href'         => esc_url($page['url']),
                        'aria-label'   => 'Page ' . $page['number'],
                        'aria-current' => $page['is_active'] ? 'page' : null,
                    ]) ?>>
                        <?= $page['number'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($next_url): ?>
        <a <?= assembleHtmlAttributes(['class' => 'pagination__arrow pagination__arrow--next', 'href' => esc_url($next_url), 'aria-label' => 'Next page']) ?>>
            <?= component_svg_icon(['class' => 'pagination__arrow-icon'], ['name' => 'arrow-right']) ?>
        </a>
    <?php else: ?>
        <span <?= assembleHtmlAttributes(['class' => 'pagination__arrow pagination__arrow--next _disabled', 'aria-disabled' => 'true', 'aria-label' => 'Next page']) ?>>
            <?= component_svg_icon(['class' => 'pagination__arrow-icon'], ['name' => 'arrow-right']) ?>
        </span>
    <?php endif; ?>

</nav>
