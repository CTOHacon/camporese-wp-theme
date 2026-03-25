<?php /** FaqList */ ?>

<ul <?= $htmlAttributesString(['class' => 'faq-list']) ?>>
    <?php foreach ($items as $index => $item) : ?>
        <li <?= assembleHtmlAttributes([
            'class' => [
                'faq-list__item',
                '_opened' => $index === 0
            ],
        ]) ?>>

            <div class="faq-list__item-head">
                <?php if (!empty($item['title'])) : ?>
                    <h3 class="faq-list__item-title"><?= $item['title'] ?></h3>
                <?php endif; ?>
                <?php component_svg_icon(['class' => 'faq-list__item-icon'], ['name' => 'faq-angle']); ?>
            </div>

            <?php if (!empty($item['answer'])) : ?>
                <div class="faq-list__item-answer"><?= $item['answer'] ?></div>
            <?php endif; ?>

        </li>
    <?php endforeach; ?>
</ul>
