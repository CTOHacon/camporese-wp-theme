<?php /** ContentWithCitationAside */ ?>

<div <?= $htmlAttributesString(['class' => 'content-with-citation-aside lib-container']) ?>>
    <aside class="content-with-citation-aside__aside">
        <?php component_citation_sidebar_widget([], [
            'image' => $citation_image,
            'quote' => $citation_quote,
        ]); ?>
    </aside>

    <main class="content-with-citation-aside__main lib-typography-wrapper">
        <?= $slot ?>
    </main>
</div>