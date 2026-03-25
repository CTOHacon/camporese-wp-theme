<?php
function connect_fonts()
{
    $base = get_template_directory_uri() . '/source/fonts';
    ?>
    <style>
        /* @font-face {
            font-family: 'RegularFont';
            src:
                url('<?= "$base/RegularFont.woff2" ?>') format('woff2'),
                url('<?= "$base/RegularFont.woff" ?>') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        } */

        @font-face {
            font-family: 'Funnel Sans';
            src: url('<?= "$base/FunnelSans-VariableFont_wght.woff2" ?>') format('woff2 supports variations'),
                url('<?= "$base/FunnelSans-VariableFont_wght.woff2" ?>') format('woff2-variations');
            font-weight: 200 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Poltawski Nowy';
            src: url('<?= "$base/PoltawskiNowy-VariableFont_wght.woff2" ?>') format('woff2 supports variations'),
                url('<?= "$base/PoltawskiNowy-VariableFont_wght.woff2" ?>') format('woff2-variations');
            font-weight: 200 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Poltawski Nowy';
            src: url('<?= "$base/PoltawskiNowy-Italic-VariableFont_wght.woff2" ?>') format('woff2 supports variations'),
                url('<?= "$base/PoltawskiNowy-Italic-VariableFont_wght.woff2" ?>') format('woff2-variations');
            font-weight: 200 900;
            font-style: italic;
            font-display: swap;
        }
    </style>

    <!-- preload fonts -->
    <link rel="preload" as="font" type="font/woff2" href="<?= "$base/FunnelSans-VariableFont_wght.woff2" ?>"
        crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="<?= "$base/PoltawskiNowy-VariableFont_wght.woff2" ?>"
        crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="<?= "$base/PoltawskiNowy-Italic-VariableFont_wght.woff2" ?>"
        crossorigin="anonymous">
    <?php
}

add_action('wp_head', 'connect_fonts');
add_action('admin_head', 'connect_fonts');