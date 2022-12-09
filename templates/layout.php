<!doctype html>
<html lang="fr">

<head>
    <title>ExerciseLooper</title>
    <link rel="stylesheet" media="all" href="/assets/application-264507a893987846393b8514969b89293817c54265354e63e6ab61fb46193f89.css">
    <script src="/assets/application-212289bcba525f2374cdbd70755ea38f2cfdd35d479e9638fae0b2832fac5dac.js"></script>
    <script src="/assets/views.js" defer></script>
</head>

<body>
<?php
if (isset($params['isHome']) and $params['isHome']): ?>
    <header class="dashboard">
        <section class="container">
            <p><img src="/assets/logo-84d7d70645fbe179ce04c983a5fae1e6cba523d7cd28e0cd49a04707ccbef56e.png"></p>
            <h1>Exercise<br>Looper</h1>
        </section>
    </header>
<?php
else: ?>
    <header class="heading <?= $headerColor ?? null ?>">
        <section class="container">
            <a href="/">
                <img src="/assets/logo-84d7d70645fbe179ce04c983a5fae1e6cba523d7cd28e0cd49a04707ccbef56e.png"></a>
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