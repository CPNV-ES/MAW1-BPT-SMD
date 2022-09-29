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
                <tr>
                    <td><?= $exercise->getTitle() ?></td>
                    <td>
                        <a title="Manage fields" href="/exercises/<?= $exercise->getId() ?>/fields"><i
                                    class="fa fa-edit"></i></a>
                        <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                           href="/exercises/<?= $exercise->getId() ?>"<i class=" fa fa-trash"></i></a>
                    </td>
                </tr>
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
            </tbody>
        </table>
    </section>
</div>
</main>
