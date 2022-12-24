<?php

$title = 'Exercise: <a href="' . $params['router']->generateUrl(
        'exercises_results',
        ['exercise' => $params['exercise']->getId(),]
    ) . '">' . $params['exercise']->getTitle() . '</a>';
$headerColor = 'results';
?>
<table>
    <thead>
    <tr>
        <th>Take</th>
        <?php
        foreach ($params['fields'] as $field) : ?>
            <th><a href="<?= $params['router']->generateUrl(
                    'fields_results',
                    ["exercise" => $params['exercise']->getId(), "field" => $field->getId()]
                ) ?>"><?= $field->getLabel()
                    ?></a></th>
        <?php
        endforeach; ?>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($params['fulfillments'] as $fulfillment) : ?>
        <tr>
            <td>
                <a href="<?= $params['router']->generateUrl(
                    'fulfillments_results',
                    ['exercise' => $params['exercise']->getId(), "fulfillment" => $fulfillment->getId()]
                ) ?>">
                    <?= $fulfillment->getDate() ?> UTC
                </a>
            </td>
            <?php
            foreach ($params['fields'] as $field) : ?>
                <?php
                $response = $fulfillment->getValue($field); ?>
                <td class="answer">
                    <?php
                    if (strlen($response) == 0) : ?>
                        <i class="fa fa-times empty"></i>
                    <?php
                    elseif (strlen($response) < 10) : ?>
                        <i class="fa fa-check short"></i>
                    <?php
                    else : ?>
                        <i class="fa fa-check-double filled"></i>
                    <?php
                    endif; ?>
                </td>
            <?php
            endforeach; ?>
        </tr>
    <?php
    endforeach; ?>
    </tbody>
</table>