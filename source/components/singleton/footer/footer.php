<?php /** Footer */ ?>

<section <?= $htmlAttributesString(['class' => 'footer']) ?>>
    <div class="footer__inner lib-container">

        <div class="footer__head">
            <?php if ($logo) : ?>
                <a class="footer__head-logo" href="/">
                    <img <?= assembleHtmlAttributes([
                        'class'  => 'footer__logo',
                        'src'    => esc_url($logo['url'] ?? ''),
                        'alt'    => $logo['alt'] ?? '',
                        'width'  => $logo['width'] ?? null,
                        'height' => $logo['height'] ?? null,
                    ]) ?> />
                </a>
            <?php endif; ?>

            <a class="footer__to-top" href="#">
                <span class="footer__to-top-text">To the top</span>
                <svg class="footer__to-top-arrow" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 13V1" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                    <path d="M1 7L7 1L13 7" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="footer__main">
            <div class="footer__about">
                <?php if ($about_text) : ?>
                    <p class="footer__about-text"><?= $about_text ?></p>
                <?php endif; ?>

                <div class="footer__contacts">
                    <?php if ($address) : ?>
                        <div class="footer__contact-item">
                            <p class="footer__contact-label">Adress</p>
                            <a <?= assembleHtmlAttributes([
                                'class'  => 'footer__contact-value',
                                'href'   => $maps_link ? esc_url($maps_link) : null,
                                'target' => $maps_link ? '_blank' : null,
                                'rel'    => $maps_link ? 'noopener noreferrer' : null,
                            ]) ?>><?= $address ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                        <div class="footer__contact-item">
                            <p class="footer__contact-label">Phone</p>
                            <a <?= assembleHtmlAttributes([
                                'class' => 'footer__contact-link',
                                'href'  => 'tel:' . preg_replace('/[^+\\d]/', '', $phone),
                            ]) ?>>
                                <?= component_svg_icon(['class' => 'footer__contact-icon'], ['name' => 'phone-outline']) ?>
                                <span class="footer__contact-value"><?= $phone ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($email) : ?>
                        <div class="footer__contact-item">
                            <p class="footer__contact-label">Phone</p>
                            <a <?= assembleHtmlAttributes([
                                'class' => 'footer__contact-link',
                                'href'  => 'mailto:' . $email,
                            ]) ?>>
                                <?= component_svg_icon(['class' => 'footer__contact-icon'], ['name' => 'mail']) ?>
                                <span class="footer__contact-value"><?= $email ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer__menus">
                <?php if (!empty($company_menu) && is_array($company_menu)) : ?>
                    <div class="footer__menu-column _company-column">
                        <p class="footer__menu-column-title">Company</p>
                        <ul class="footer__menu-list">
                            <?php foreach ($company_menu as $item) : ?>
                                <?php if (!empty($item['url'])) : ?>
                                    <li class="footer__menu-item">
                                        <a <?= assembleHtmlAttributes([
                                            'class'  => 'footer__menu-link',
                                            'href'   => esc_url($item['url']),
                                            'target' => $item['target'] ?? null,
                                        ]) ?>><?= $item['title'] ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($practice_areas_columns)) : ?>
                    <div class="footer__menu-column _practice-areas-column">
                        <p class="footer__menu-column-title"><?= $practice_areas_title ?></p>
                        <div class="footer__practice-areas-grid">
                            <?php foreach ($practice_areas_columns as $column) : ?>
                                <ul class="footer__menu-list">
                                    <?php foreach ($column as $item) : ?>
                                        <?php if (!empty($item['url'])) : ?>
                                            <li class="footer__menu-item">
                                                <a <?= assembleHtmlAttributes([
                                                    'class'  => 'footer__menu-link',
                                                    'href'   => esc_url($item['url']),
                                                    'target' => $item['target'] ?? null,
                                                ]) ?>><?= $item['title'] ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="footer__bottom">
            <?php if (!empty($socials) && is_array($socials)) : ?>
                <div class="footer__socials">
                    <?php foreach ($socials as $social) : ?>
                        <?php if (!empty($social['url']) && !empty($social['icon'])) : ?>
                            <a <?= assembleHtmlAttributes([
                                'class'      => 'footer__social-link',
                                'href'       => esc_url($social['url']),
                                'target'     => '_blank',
                                'rel'        => 'noopener noreferrer',
                                'aria-label' => ucfirst($social['icon']),
                            ]) ?>>
                                <?= component_svg_icon([], ['name' => $social['icon']]) ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <p class="footer__legal">
                <?php if ($privacy_link && !empty($privacy_link['url'])) : ?>
                    <a <?= assembleHtmlAttributes([
                        'class'  => 'footer__privacy-link',
                        'href'   => esc_url($privacy_link['url']),
                        'target' => $privacy_link['target'] ?? null,
                    ]) ?>><?= $privacy_link['title'] ?></a>
                    <span class="footer__legal-separator">|</span>
                <?php endif; ?>
                <span class="footer__copyright"><?= $copyright_text ?></span>
            </p>
        </div>

    </div>
</section>
