<main class="container">

    <body>
        <h1><?= $data['fulfillment']->getDate() ?></h1>
        <dl class="answer">
            <?php foreach ($data['fulfillment']->getFieldsValues() as $value) : ?>
                <dt><?= $value['field']->getTitle() ?></dt>
                <dd><?= $value['value'] ?></dd>
            <?php endforeach; ?>
        </dl>
    </body>
</main>