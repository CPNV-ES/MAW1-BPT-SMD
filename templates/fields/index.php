<?php

$headerColor = 'managing';
$title = "Exercise: {$params['exercise']->getTitle()}";
?>

<div class="row">
    <section class="column">
        <h1>Fields</h1>
        <table class="records">
            <thead>
            <tr>
                <th>Label</th>
                <th>Value kind</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($params['exercise']->getFields() as $field) : ?>
                <tr>
                    <td><?= $field->getLabel() ?></td>
                    <td><?= $field->getValueKind() ?></td>
                    <td>
                        <a title="Edit" href="<?= $params['router']->generateUrl(
                            'fields_edit',
                            ['exercise' => $params['exercise']->getId(), 'field' => $field->getId()]
                        ); ?>">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete"
                           href="<?= $params['router']->generateUrl(
                               'fields_delete',
                               ['exercise' => $params['exercise']->getId(), 'field' => $field->getId()]
                           ); ?>">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>

        </table>
        <?php
        if ($params['exercise']->getFields()): ?>
            <a data-confirm="Are you sure? You won't be able to further edit this exercise" class="button"
               rel="nofollow"
               data-method="put" href="<?= $params['router']->generateUrl(
                'exercises_state',
                ['exercise' => $params['exercise']->getId()],
                'state=answering'
            ); ?>">
                <i class="fa fa-comment"></i> Complete and be ready for answers
            </a>
        <?php
        endif; ?>
    </section>
    <section class="column">
        <h1>New Field</h1>
        <form action="<?= $params['router']->generateUrl('fields_index', ['exercise' => $params['exercise']->getId()]
        ); ?>" accept-charset="UTF-8" method="post">
            <div class="field">
                <label for="field_label">Label</label>
                <input type="text" name="field[label]" id="field_label" required>
            </div>
            <div class="field">
                <label for="field_value_kind">Value kind</label>
                <select name="field[value_kind]" id="field_value_kind">
                    <option selected="selected" value="single_line">Single line text</option>
                    <option value="single_line_list">List of single lines</option>
                    <option value="multi_line">Multi-line text</option>
                </select>
            </div>
            <div style="color: orangered"><?= $params['error'] ?? '' ?></div>
            <div class="actions">
                <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field">
            </div>
        </form>
    </section>
</div>