<?php

add_action('admin_menu', function () {
    add_menu_page(
        'Block Defaults',
        'Block Defaults',
        'edit_theme_options',
        'block-defaults',
        'block_defaults_render_overview',
        'dashicons-layout',
        30
    );
});

requireAll(path_join(getThemeСonfig('components.base'), '**/*.acf.theme-option.php'));

function block_defaults_render_overview()
{
    $components_base = path_join(get_template_directory(), getThemeСonfig('components.base'));

    $option_files = [];
    $iterator     = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($components_base));
    foreach ($iterator as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), '.acf.theme-option.php')) {
            $option_files[] = $file->getPathname();
        }
    }

    $blocks = [];

    foreach ($option_files as $file) {
        $component_dir = dirname($file);
        $content       = file_get_contents($file);

        preg_match("/'page_title'\s*=>\s*'([^']+)'/", $content, $title_match);
        preg_match("/'menu_slug'\s*=>\s*'(block-defaults-[^']+)'/", $content, $slug_match);

        if (empty($slug_match[1])) {
            continue;
        }

        $image_url   = null;
        $image_files = glob($component_dir . '/*.png') ?: [];

        if (!empty($image_files)) {
            $rel       = str_replace(get_template_directory(), '', $image_files[0]);
            $image_url = get_template_directory_uri() . $rel;
        }

        $blocks[] = [
            'title'    => $title_match[1] ?? basename($component_dir),
            'slug'     => $slug_match[1],
            'image'    => $image_url,
            'edit_url' => admin_url('admin.php?page=' . $slug_match[1]),
        ];
    }

    usort($blocks, fn($a, $b) => strcmp($a['title'], $b['title']));

    ?>
    <div class="wrap block-defaults-overview">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <p class="block-defaults-overview__subtitle">Click a block to edit its default settings.</p>

        <div class="block-defaults-overview__grid">
            <?php foreach ($blocks as $block) : ?>
                <a href="<?= esc_url($block['edit_url']); ?>" class="block-defaults-overview__card">
                    <div class="block-defaults-overview__thumbnail">
                        <?php if ($block['image']) : ?>
                            <img src="<?= esc_url($block['image']); ?>" alt="<?= esc_attr($block['title']); ?>" />
                        <?php else : ?>
                            <span class="dashicons dashicons-layout block-defaults-overview__placeholder-icon"></span>
                        <?php endif; ?>
                    </div>
                    <div class="block-defaults-overview__label">
                        <?= esc_html($block['title']); ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .block-defaults-overview__subtitle {
            color: #666;
            margin-bottom: 24px;
        }
        .block-defaults-overview__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1200px;
        }
        .block-defaults-overview__card {
            text-decoration: none;
            color: inherit;
            background: #fff;
            border: 1px solid #dcdcde;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow .15s, border-color .15s;
        }
        .block-defaults-overview__card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
            border-color: #aaa;
        }
        .block-defaults-overview__thumbnail {
            background: #f0f0f1;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .block-defaults-overview__thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .block-defaults-overview__placeholder-icon {
            font-size: 48px !important;
            width: 48px !important;
            height: 48px !important;
            color: #aaa;
        }
        .block-defaults-overview__label {
            padding: 14px 16px;
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
        }
        @media (max-width: 1100px) {
            .block-defaults-overview__grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 782px) {
            .block-defaults-overview__grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    <?php
}
