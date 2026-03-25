<?php /** MobileMenuModal */ ?>

<div <?= $htmlAttributesString([
    'class'       => 'mobile-menu-modal',
    'id'          => 'mobile-menu-modal',
    'role'        => 'dialog',
    'aria-modal'  => 'true',
    'aria-label'  => 'Mobile Menu',
    'aria-hidden' => 'true',
]) ?>>
    <div class="mobile-menu-modal__body">
        <nav class="mobile-menu-modal__nav" aria-label="Mobile navigation">
            <ul class="mobile-menu-modal__nav-list">
                <?php if (!empty($practice_areas_columns) && is_array($practice_areas_columns)) : ?>
                    <li class="mobile-menu-modal__nav-item mobile-menu-modal__nav-item--expandable">
                        <button <?= assembleHtmlAttributes([
                            'class'         => 'mobile-menu-modal__nav-link mobile-menu-modal__nav-link--toggle',
                            'type'          => 'button',
                            'aria-expanded' => 'false',
                        ]) ?>>
                            Practice Areas
                            <?php component_svg_icon(['class' => 'mobile-menu-modal__nav-icon'], ['name' => 'faq-angle']); ?>
                        </button>
                        <ul class="mobile-menu-modal__submenu">
                            <?php foreach ($practice_areas_columns as $column) :
                                $col_title = $column['title'] ?? '';
                                $col_links = $column['links'] ?? [];
                            ?>
                                <?php if ($col_title) : ?>
                                    <li class="mobile-menu-modal__submenu-heading"><?= esc_html($col_title) ?></li>
                                <?php endif; ?>
                                <?php if (!empty($col_links) && is_array($col_links)) : ?>
                                    <?php foreach ($col_links as $link_item) :
                                        $pa_link        = $link_item['link'] ?? [];
                                        $pa_link_url    = $pa_link['url'] ?? '#';
                                        $pa_link_title  = $pa_link['title'] ?? '';
                                        $pa_link_target = $pa_link['target'] ?? null;
                                    ?>
                                        <li>
                                            <a <?= assembleHtmlAttributes([
                                                'class'  => 'mobile-menu-modal__submenu-link',
                                                'href'   => $pa_link_url,
                                                'target' => $pa_link_target ?: null,
                                            ]) ?>>
                                                <?= esc_html($pa_link_title) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (!empty($nav_items) && is_array($nav_items)) : ?>
                    <?php foreach ($nav_items as $item) : ?>
                        <?php
                        $link        = $item['link'] ?? [];
                        $link_url    = $link['url'] ?? '#';
                        $link_title  = $link['title'] ?? '';
                        $link_target = $link['target'] ?? null;
                        $submenu     = $item['submenu'] ?? [];
                        $has_submenu = !empty($submenu) && is_array($submenu);
                        ?>

                        <?php if ($has_submenu) : ?>
                            <li class="mobile-menu-modal__nav-item mobile-menu-modal__nav-item--expandable">
                                <button <?= assembleHtmlAttributes([
                                    'class'         => 'mobile-menu-modal__nav-link mobile-menu-modal__nav-link--toggle',
                                    'type'          => 'button',
                                    'aria-expanded' => 'false',
                                ]) ?>>
                                    <?= esc_html($link_title) ?>
                                    <?php component_svg_icon(['class' => 'mobile-menu-modal__nav-icon'], ['name' => 'faq-angle']); ?>
                                </button>
                                <ul class="mobile-menu-modal__submenu">
                                    <?php foreach ($submenu as $sub_item) :
                                        $sub_link        = $sub_item['link'] ?? [];
                                        $sub_link_url    = $sub_link['url'] ?? '#';
                                        $sub_link_title  = $sub_link['title'] ?? '';
                                        $sub_link_target = $sub_link['target'] ?? null;
                                    ?>
                                        <li>
                                            <a <?= assembleHtmlAttributes([
                                                'class'  => 'mobile-menu-modal__submenu-link',
                                                'href'   => $sub_link_url,
                                                'target' => $sub_link_target ?: null,
                                            ]) ?>>
                                                <?= esc_html($sub_link_title) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="mobile-menu-modal__nav-item">
                                <a <?= assembleHtmlAttributes([
                                    'class'  => 'mobile-menu-modal__nav-link',
                                    'href'   => $link_url,
                                    'target' => $link_target ?: null,
                                ]) ?>>
                                    <?= esc_html($link_title) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </nav>

        <?php if ($phone) : ?>
            <div class="mobile-menu-modal__footer">
                <a <?= assembleHtmlAttributes([
                    'class' => 'mobile-menu-modal__phone',
                    'href'  => 'tel:' . preg_replace('/[^+\\d]/', '', $phone),
                ]) ?>>
                    <?php component_svg_icon(['class' => 'mobile-menu-modal__phone-icon'], ['name' => 'phone-outline']); ?>
                    <?= esc_html($phone) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
