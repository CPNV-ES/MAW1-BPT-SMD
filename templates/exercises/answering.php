<main class="container">
  <ul class="ansering-list">
    <?php foreach ($params['exercises'] as $exercise) : ?>
      <li class="row">
        <div class="column card">
          <div class="title"><?= $exercise->getTitle() ?></div>
          <a class="button" href="/<?= ''?>">Take it</a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</main>