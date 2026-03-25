<?php
/**
 * Footer
 * @param array $htmlAttributes Root attributes
 * @param array $props {
 *     @type array  $logo                    Footer logo array (url, alt, width, height)
 *     @type string $about_text              About company text
 *     @type array  $socials                 Social links [{icon, url}]
 *     @type string $phone                   Phone number
 *     @type string $email                   Email address
 *     @type string $address                 Physical address
 *     @type string $maps_link               Google Maps URL for address link
 *     @type array  $company_menu            Company nav items [{url, title, target}]
 *     @type string $practice_areas_title    Practice areas section title
 *     @type array  $practice_areas_columns  Columns of links [[{url, title, target}]]
 *     @type array  $privacy_link            Privacy policy link {url, title, target}
 *     @type string $copyright_text          Copyright text
 * }
 */
function component_footer($htmlAttributes = [], $props = [])
{
    // Logo
    $logo = get_field('field_footer_logo', 'option') ?: [];

    // About text
    $about_text = get_field('field_footer_about_text', 'option');

    // Social links — from contacts options
    $socials       = [];
    $social_fields = [
        'instagram' => get_field('field_instagram_link', 'option'),
        'facebook'  => get_field('field_facebook_link', 'option'),
        'youtube'   => get_field('field_youtube_link', 'option'),
        'linkedin'  => get_field('field_linkedin_link', 'option'),
    ];
    foreach ($social_fields as $icon => $url) {
        if ($url) {
            $socials[] = [
                'icon' => $icon,
                'url'  => $url
            ];
        }
    }

    // Contact info — from contacts options
    $phone     = get_field('field_phone', 'option');
    $email     = get_field('field_email', 'option');
    $address   = get_field('field_address', 'option');
    $maps_link = get_field('field_maps_link', 'option');

    // Company menu
    $company_menu_raw = get_field('field_footer_company_menu', 'option') ?: [];
    $company_menu     = array_map(function ($item) {
        return [
            'url'    => $item['link']['url'] ?? null,
            'title'  => $item['link']['title'] ?? null,
            'target' => $item['link']['target'] ?? null,
        ];
    }, $company_menu_raw);

    // Practice areas
    $practice_areas_title       = get_field('field_footer_practice_areas_title', 'option') ?: 'Practise areas';
    $practice_areas_columns_raw = get_field('field_footer_practice_areas_columns', 'option') ?: [];
    $practice_areas_columns     = [];
    foreach ($practice_areas_columns_raw as $column) {
        $links = [];
        $column_links = $column['links'] ?? [];
        foreach ($column_links as $link_item) {
            $links[] = [
                'url'    => $link_item['link']['url'] ?? null,
                'title'  => $link_item['link']['title'] ?? null,
                'target' => $link_item['link']['target'] ?? null,
            ];
        }
        $practice_areas_columns[] = $links;
    }

    // Legal
    $privacy_link_raw = get_field('field_footer_privacy_link', 'option');
    $privacy_link     = $privacy_link_raw ? [
        'url'    => $privacy_link_raw['url'] ?? null,
        'title'  => $privacy_link_raw['title'] ?? null,
        'target' => $privacy_link_raw['target'] ?? null,
    ] : null;
    $copyright_text = get_field('field_footer_copyright_text', 'option') ?: 'Copyright &copy; 2008';

    $props = [
        'logo'                   => $logo,
        'about_text'             => $about_text,
        'socials'                => $socials,
        'phone'                  => $phone,
        'email'                  => $email,
        'address'                => $address,
        'maps_link'              => $maps_link,
        'company_menu'           => $company_menu,
        'practice_areas_title'   => $practice_areas_title,
        'practice_areas_columns' => $practice_areas_columns,
        'privacy_link'           => $privacy_link,
        'copyright_text'         => $copyright_text,
    ];

    render_component_template('footer', 'source/components/singleton/footer/footer.php', $htmlAttributes, $props);
}
