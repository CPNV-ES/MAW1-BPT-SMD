<?php

$title = 'Exercise: <a href="' . $params['router']->generateUrl(
        'exercises_results',
        ['exercise' => $params['exercise']->getId()]
    ) . '">' . $params['exercise']->getTitle() . '</a>';
$headerColor = 'results';
?>
<h1><?= $params['field']->getLabel() ?></h1>
<table>
    <thead>
    <tr>
        <th>Take</th>
        <th>Content</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($params['fulfillments'] as $fulfillment) : ?>
        <tr>
            <td>
                <a href="<?= $params['router']->generateUrl(
                    'fulfillments_results',
                    ["exercise" => $params['exercise']->getId(), "fulfillment" => $fulfillment->getId(),]
                ) ?>">
                    <?= $fulfillment->getDate() ?> UTC
                </a>
            </td>
            <td>
                <?= $fulfillment->getValue($params['field']); ?>
            </td>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>