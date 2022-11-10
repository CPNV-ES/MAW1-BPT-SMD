<?php

$headerColor = 'managing';
$title = "Exercise: {$params['exercise']->getTitle()}";
?>

<h1>Editing Field</h1>

<form action="<?= $params['router']->generateUrl('fields_edit', ['id1' => $params['exercise']->getId(), 'id2' => $params['field']->getId()]); ?>" accept-charset="UTF-8" method="post">
    <div class="field">
        <label for="field_label">Label</label>
        <input type="text" value="<?= $params['field']->getLabel() ?>" name="field[label]" id="field_label">
    </div>
    <div class="field">
        <label for="field_value_kind">Value kind</label>
        <select name="field[value_kind]" id="field_value_kind">
            <option
                <?php
                if ($params['field']->getValueKind() == 'single_line'): ?>
                    selected="selected"
                <?php
                endif; ?>
                    value="single_line">
                Single line text
            </option>
            <option
                <?php
                if ($params['field']->getValueKind() == 'single_line_list'): ?>
                    selected="selected"
                <?php
                endif; ?>
                    value="single_line_list">
                List of single lines
            </option>
            <option
                <?php
                if ($params['field']->getValueKind() == 'multi_line'): ?>
                    selected="selected"
                <?php
                endif; ?>
                    value="multi_line">
                Multi-line text
            </option>
        </select>
    </div>
    <div style="color: orangered"><?= $params['error'] ?? '' ?></div>
    <div class="actions">
        <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field">
    </div>
</form>