<?php

$title = 'New exercise';
$headerColor = 'managing'
?>
<h1><?= $title ?></h1>

<form action="<?= $params['router']->generateUrl('exercises_create'); ?>" accept-charset="UTF-8" method="post">
    <div class="field">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required="required">
        <div style="color: orangered"><?= $params['error'] ?? '' ?></div>
    </div>
    <div class="actions">
        <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise">
    </div>
</form>