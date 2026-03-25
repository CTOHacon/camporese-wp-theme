<?php
/**
 * Header
 */
?>

<div <?= $htmlAttributesString([
    'class' => 'header',
    'id'    => 'header'
]) ?>>
    <div class="header__inner lib-container">
        <?php if ($logo) : ?>
            <a <?= assembleHtmlAttributes([
                'class' => 'header__logo',
                'href'  => home_url('/')
            ]) ?>>
                <?php component_image([
                    'class' => 'header__logo-image',
                    'alt'   => 'Logo'
                ], ['reference' => $logo['id'] ?? $logo]); ?>
            </a>
        <?php endif; ?>

        <span class="header__separator"></span>

        <nav class="header__navigation">
            <?php if (!empty($nav_items) && is_array($nav_items)) : ?>
                <ul class="header__menu-list">
                    <li class="header__menu-item">
                        <a <?= assembleHtmlAttributes([
                            'class' => 'header__menu-link',
                            'href'  => '#practice-areas-menu-modal',
                        ]) ?>>
                            Practice Areas
                        </a>
                    </li>
                    <?php foreach ($nav_items as $index => $item) : ?>
                        <?php
                        $link        = $item['link'] ?? [];
                        $link_url    = $link['url'] ?? '#';
                        $link_title  = $link['title'] ?? '';
                        $link_target = $link['target'] ?? null;
                        $submenu     = $item['submenu'] ?? [];
                        $has_submenu = !empty($submenu) && is_array($submenu);

                        if ($has_submenu) {
                            $submenu_id  = lcfirst(str_replace(' ', '', ucwords($link_title)));
                            $link_url    = '#' . $submenu_id;
                            $link_target = null;
                        }
                        ?>
                        <li class="header__menu-item">
                            <a <?= assembleHtmlAttributes([
                                'class'  => 'header__menu-link' . ($has_submenu ? ' header__menu-link--has-submenu' : ''),
                                'href'   => $link_url,
                                'target' => $link_target ?: null,
                            ]) ?>>
                                <?= $link_title ?>
                            </a>

                            <?php if ($has_submenu) : ?>
                                <div <?= assembleHtmlAttributes([
                                    'class'       => 'header__submenu',
                                    'id'          => $submenu_id ?? '',
                                    'role'        => 'dialog',
                                    'aria-label'  => $link_title . ' submenu',
                                    'aria-hidden' => 'true',
                                ]) ?>>
                                    <div class="header__submenu-body">
                                        <ul class="header__submenu-list">
                                            <?php foreach ($submenu as $sub_item) :
                                                $sub_link        = $sub_item['link'] ?? [];
                                                $sub_link_url    = $sub_link['url'] ?? '#';
                                                $sub_link_title  = $sub_link['title'] ?? '';
                                                $sub_link_target = $sub_link['target'] ?? null;
                                            ?>
                                                <li>
                                                    <a <?= assembleHtmlAttributes([
                                                        'class'  => 'header__submenu-link',
                                                        'href'   => $sub_link_url,
                                                        'target' => $sub_link_target ?: null,
                                                    ]) ?>>
                                                        <?= esc_html($sub_link_title) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </nav>

        <div class="header__contacts">
            <?php if ($phone) : ?>
                <a <?= assembleHtmlAttributes([
                    'class' => 'header__contact-link',
                    'href'  => 'tel:' . preg_replace('/[^+\\d]/', '', $phone),
                ]) ?>>
                    <span class="header__contact-link-text"><?= $phone ?></span>
                    <?php component_svg_icon(['class' => 'header__contact-link-icon'], ['name' => 'phone-outline']); ?>
                </a>
            <?php endif; ?>

            <span class="header__contacts-separator"></span>

            <a <?= assembleHtmlAttributes([
                'class' => 'header__contact-link header__contact-link--cta',
                'href'  => '#contact-modal',
            ]) ?>>
                <span class="header__contact-link-text">Ask A Question</span>
                <?php component_svg_icon(['class' => 'header__contact-link-icon'], ['name' => 'mail']); ?>
            </a>
        </div>

        <button class="header__mobile-menu-toggle" type="button" aria-label="Toggle mobile menu"
            id="mobile-menu-toggle-button">
            <span class="header__mobile-menu-toggle-line"></span>
            <span class="header__mobile-menu-toggle-line"></span>
            <span class="header__mobile-menu-toggle-line"></span>
        </button>
    </div>
</div>
