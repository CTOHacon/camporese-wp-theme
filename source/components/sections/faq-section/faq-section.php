<?php /** FaqSection */ ?>

<section <?= $htmlAttributesString(['class' => 'faq-section lib-container']) ?>>

    <?php if ($head_title || $head_text) : ?>
        <?php component_section_head(['class' => 'faq-section__head'], [
            'title'  => $head_title,
            'text'   => $head_text,
            'styles' => ['align-left']
        ]); ?>
    <?php endif; ?>

    <?php component_faq_list([], ['items' => $items]); ?>

</section>