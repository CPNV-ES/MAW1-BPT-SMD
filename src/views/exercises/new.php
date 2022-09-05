<?php
$title = 'New exercise';
$headerColor = 'managing'
?>
<h1><?= $title ?></h1>

<form action="/exercises/new" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓">
    <div class="field">
        <label for="exercise_title">Title</label>
        <input type="text" name="exercise_title" id="exercise_title">
    </div>

    <div class="actions">
        <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise">
    </div>
</form>