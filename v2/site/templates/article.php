<?php snippet('header') ?>

  <main class="main" role="main">

    <div class="text">
      <h1><?php echo $page->title()->html() ?></h1>
      <?php if(!$page->shortcut()->empty()): ?><div class="tip-text-shortcut"><em>Shortcut:</em> <?php echo $page->shortcut() ?></div><?php endif ?>
      <?php if(!$page->menubar()->empty()): ?><div class="tip-text-menu"><strong><?php echo $page->menubar() ?></strong></div><?php endif ?>
      <?php echo $page->text()->kirbytext() ?>
    </div>

  </main>

<?php snippet('footer') ?>