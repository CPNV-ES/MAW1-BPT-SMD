<div class="container dashboard">
    <section class="row">
        <div class="column">
            <a class="button answering column"
               href="<?= $params['router']->generateUrl('exercises_answering') ?>">Take an exercise</a>
        </div>
        <div class="column">
            <a class="button managing column"
               href="<?= $params['router']->generateUrl('exercises_new') ?>">Create an exercise</a>
        </div>
        <div class="column">
            <a class="button results column"
               href="<?= $params['router']->generateUrl('exercises_index') ?>">Manage an exercise</a>
        </div>
    </section>
</div>
<div style="position: static !important;"></div>