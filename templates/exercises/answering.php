<?php

$headerColor = 'answering';
?>

<ul class="ansering-list">
    <?php
    foreach ($params['exercises'] as $exercise) : ?>
        <?php
        if ($exercise->getState() == 'answering'): ?>
            <li class="row">
                <div class="column card">
                    <div class="title"><?= $exercise->getTitle() ?></div>
                    <a class="button"
                       href="<?= $params['router']->generateUrl('fulfillments_new', ['exercise' => $exercise->getId()]
                       ); ?>">Take it</a>
                </div>
            </li>
        <?php
        endif; ?>
    <?php
    endforeach; ?>
</ul>