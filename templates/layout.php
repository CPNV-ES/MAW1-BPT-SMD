<!doctype html>
<html lang="fr">

<head>
    <title>ExerciseLooper</title>
    <link rel="stylesheet" media="all" href="/assets/app.css">
    <script src="/assets/app.js"></script>
    <script src="/assets/views.js" defer></script>
</head>

<body>
<?php
if (isset($params['isHome']) and $params['isHome']): ?>
    <header class="dashboard">
        <section class="container">
            <p><img src="/assets/logo.png"></p>
            <h1>Exercise<br>Looper</h1>
        </section>
    </header>
<?php
else: ?>
    <header class="heading <?= $headerColor ?? null ?>">
        <section class="container">
            <a href="/">
                <img src="/assets/logo.png"></a>
            <span class="exercise-label"><?= $title ?? 'ExerciseLooper' ?></span>
        </section>
    </header>
<?php
endif; ?>

<main class="container">
    <title>ExerciseLooper</title>
    <?= $content ?? null ?>
</main>
<div style="position: static !important;"></div>
</body>
</html>