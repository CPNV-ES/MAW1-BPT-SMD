<?php
$headerColor = 'results';
?>

<h1><?= $title ?></h1>

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
            <?php foreach ($data['exercises'] as $exercise) : ?>
                <tr>
                    <td><?= $exercise[1] ?></td>
                    <td>
                        <a title="Manage fields" href="/exercises/<?= $exercise[0] ?>/fields"><i class="fa fa-edit"></i></a>
                        <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                           href="/exercises/<?= $exercise[0] ?>"<i class=" fa fa-trash"></i></a>
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
