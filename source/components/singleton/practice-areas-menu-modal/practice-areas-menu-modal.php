<?php /** PracticeAreasMenuModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'practice-areas-menu-modal',
    'id'          => 'practice-areas-menu-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Practice Areas Menu',
    'aria-hidden' => 'true',
]) ?>>
    <nav class="practice-areas-menu-modal__body lib-container" aria-label="Practice areas menu">
        <?php if (!empty($columns) && is_array($columns)) : ?>
            <ul class="practice-areas-menu-modal__columns">
                <?php foreach ($columns as $index => $column) :
                    $title  = $column['title'] ?? '';
                    $image  = $column['image'] ?? null;
                    $links  = $column['links'] ?? [];
                ?>
                    <li class="practice-areas-menu-modal__column">
                        <?php if ($title) : ?>
                            <h3 class="practice-areas-menu-modal__column-title"><?= esc_html($title) ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($links) && is_array($links)) : ?>
                            <ul class="practice-areas-menu-modal__column-list">
                                <?php foreach ($links as $link_item) :
                                    $link = $link_item['link'] ?? [];
                                    $link_url    = $link['url'] ?? '#';
                                    $link_title  = $link['title'] ?? '';
                                    $link_target = $link['target'] ?? null;
                                ?>
                                    <li>
                                        <a <?= assembleHtmlAttributes([
                                            'class'  => 'practice-areas-menu-modal__link',
                                            'href'   => $link_url,
                                            'target' => $link_target ?: null,
                                        ]) ?>>
                                            <?= esc_html($link_title) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($image) : ?>
                            <div class="practice-areas-menu-modal__column-image-wrapper">
                                <?php component_image([
                                    'class' => 'practice-areas-menu-modal__column-image',
                                ], ['reference' => $image]); ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </nav>
</div>
