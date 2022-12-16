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
            <?php foreach ($params['exercises'] as $exercise) : ?>
                <?php if ($exercise->getState() == 'building'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <?php if ($exercise->getFields()): ?>
                                <a title="Be ready for answers" rel="nofollow" data-method="put"
                                   href="<?= $params['router']->generateUrl(
                                       'exercises_state',
                                       ['exercise' => $exercise->getId()],
                                       'state=answering'
                                   ); ?>">
                                    <i class="fa fa-comment"></i>
                                </a>
                            <?php endif; ?>
                            <a title="Manage fields" href="<?= $params['router']->generateUrl(
                                'fields_index',
                                ['exercise' => $exercise->getId()]
                            ); ?>">
                                <i class=" fa fa-edit"></i>
                            </a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                               href="<?= $params['router']->generateUrl(
                                   'exercises_delete',
                                   ['exercise' => $exercise->getId()]
                               ); ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
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
            <?php foreach ($params['exercises'] as $exercise) : ?>
                <?php if ($exercise->getState() == 'answering'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <a title="Show results" href="<?= $params['router']->generateUrl(
                                'exercises_results',
                                ['exercise' => $exercise->getId(),]
                            ) ?>">
                                <i class="fa fa-chart-bar"></i>
                            </a>
                            <a title="Close" rel="nofollow" data-method="put"
                               href="<?= $params['router']->generateUrl(
                                   'exercises_state',
                                   ['exercise' => $exercise->getId()],
                                   'state=closed'
                               ); ?>">
                                <i class="fa fa-minus-circle"></i>
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
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
            <?php foreach ($params['exercises'] as $exercise) : ?>
                <?php if ($exercise->getState() == 'closed'): ?>
                    <tr>
                        <td><?= $exercise->getTitle() ?></td>
                        <td>
                            <a title="Show results" href="<?= $params['router']->generateUrl(
                                'exercises_results',
                                ['exercise' => $exercise->getId(),]
                            ) ?>">
                                <i class="fa fa-chart-bar"></i>
                            </a>
                            <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                               href="<?= $params['router']->generateUrl(
                                   'exercises_delete',
                                   ['exercise' => $exercise->getId()]
                               ); ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
</main>