<?php /** SimpleImagesGallery */ ?>

<?php if (!empty($images) && is_array($images)) : ?>
    <ul <?= $htmlAttributesString(['class' => 'simple-images-gallery']) ?>>
        <?php foreach ($images as $image_id) : ?>
            <li class="simple-images-gallery__item">
                <?= component_image(
                    ['class' => 'simple-images-gallery__image'],
                    [
                        'reference' => $image_id,
                        'lazy'      => true,
                        'size'      => 'large'
                    ]
                ); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>