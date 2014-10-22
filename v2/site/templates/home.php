<?php snippet('header') ?>

  <main class="main-main" role="main">

  	<div class="main-main-in">

    <?php foreach(page('articles')->children()->visible()->limit(3) as $project): ?>
    <article class="tip">
      <h1 class="tip-title"><a href="<?php echo $project->url() ?>"><?php echo html($project->title()) ?></a></h1>
      <div class="tip-text">
        <?php echo excerpt($project->text(), 350) ?> <a href="<?php echo $project->url() ?>">read&nbsp;more&nbsp;→</a>
      </div>
      <div class="tip-separator"><span>oOo</span></div>
    </article>
    <?php endforeach ?>

	</div>

  </main>

<?php snippet('footer') ?>