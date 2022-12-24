<?php

$title = 'Exercise: <a href="' . $params['router']->generateUrl(
        'exercises_results',
        ['exercise' => $params['exercise']->getId()]
    ) . '">' . $params['exercise']->getTitle() . '</a>';
$headerColor = 'results';
?>

<h1><?= $params['fulfillment']->getDate() ?></h1>
<dl class="answer">
    <?php
    foreach ($params['fields'] as $field) : ?>
        <dt><?= $field->getLabel() ?></dt>
        <dd><?= $params['fulfillment']->getValue($field) ?></dd>
    <?php
    endforeach; ?>
</dl>