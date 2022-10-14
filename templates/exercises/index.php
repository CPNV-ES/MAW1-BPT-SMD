<?php

$headerColor = 'results';
?>

<div class="row">
    <section class="column">
        <h1>Building</h1>
        <table class="records">
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($params['exercises'] as $exercise) : ?>
                <?php
                if ($exercise->getState() == 'Building'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <a title="Manage fields" href="/exercises/<?= $exercise->getId() ?>/fields"><i class="fa fa-edit"></i></a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise->getId() ?>"<i class=" fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="column">
        <h1>Answering</h1>
        <table class="records">
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($params['exercises'] as $exercise) : ?>
                <?php
                if ($exercise->getState() == 'Answering'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <a title="Show results" href="/exercises/<?= $exercise->getId() ?>/results"><i class="fa fa-chart-bar"></i></a>
                            <a title="Close" rel="nofollow" data-method="put" href="/exercises/<?= $exercise->getId() ?>?exercise%5Bstatus%5D=closed"><i class="fa fa-minus-circle"></i></a>
                        </td>
                    </tr>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="column">
        <h1>Closed</h1>
        <table class="records">
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($params['exercises'] as $exercise) : ?>
                <?php
                if ($exercise->getState() == 'Closed'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <a title="Show results" href="/exercises/<?= $exercise->getId() ?>/results"><i class="fa fa-chart-bar"></i></a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exercise->getId() ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                endif; ?>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
</main>
